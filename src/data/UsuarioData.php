<?php

namespace app\Data;

use PDO;
use app\Data\BaseData;
use app\Models\Usuario;
use app\Interfaces\UsuarioInterface;

class UsuarioData extends BaseData implements UsuarioInterface
{
    const TABLE = 'tb_usuarios'; // Asegúrate de que este sea el nombre correcto de la tabla en tu base de datos

    public function get(): array
    {
        try {
            $sql = "SELECT id_usuario, nombre, apellido, email, celular, contraseña, fecha_registro, id_usuario_rol FROM " . self::TABLE;
            $stmt = $this->pdo->query($sql);
            $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $usuarios = [];
            foreach ($filas as $fila) {
                $usuarios[] = new Usuario(
                    $fila['id_usuario'],
                    $fila['nombre'],
                    $fila['apellido'],
                    $fila['email'],
                    (int)$fila['celular'],
                    $fila['contraseña'], // Considera encriptar la contraseña al guardarla
                    $fila['fecha_registro'],
                    $fila['id_usuario_rol']
                );
            }
            return $usuarios;
        } catch (\Exception $e) {
            error_log("Error al obtener los usuarios: " . $e->getMessage());
            return [];
        }
    }

    public function create(Usuario $usuario): bool
    {
        try {
            $sql = "INSERT INTO " . self::TABLE . " (id_usuario, nombre, apellido, email, celular, contraseña, fecha_registro, id_usuario_rol)
                    VALUES (:id_usuario, :nombre, :apellido, :email, :celular, :contraseña, :fecha_registro, :id_usuario_rol)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_usuario', $usuario->getIdUsuario());
            $stmt->bindParam(':nombre', $usuario->getNombre());
            $stmt->bindParam(':apellido', $usuario->getApellido());
            $stmt->bindParam(':email', $usuario->getEmail());
            $stmt->bindParam(':celular', $usuario->getCelular());
            $stmt->bindParam(':contraseña', $usuario->getContraseña());
            $stmt->bindParam(':fecha_registro', $usuario->getFechaRegistro());
            $stmt->bindParam(':id_usuario_rol', $usuario->getIdUsuarioRol());

            return $stmt->execute();
        } catch (\Exception $e) {
            error_log("Error al crear el usuario: " . $e->getMessage());
            return false;
        }
    }

    public function update(Usuario $usuario): bool
    {
        try {
            $sql = "UPDATE " . self::TABLE . " SET 
                    nombre = :nombre, 
                    apellido = :apellido, 
                    email = :email, 
                    celular = :celular, 
                    contraseña = :contraseña, 
                    id_usuario_rol = :id_usuario_rol 
                    WHERE id_usuario = :id_usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_usuario', $usuario->getIdUsuario());
            $stmt->bindParam(':nombre', $usuario->getNombre());
            $stmt->bindParam(':apellido', $usuario->getApellido());
            $stmt->bindParam(':email', $usuario->getEmail());
            $stmt->bindParam(':celular', $usuario->getCelular());
            $stmt->bindParam(':contraseña', $usuario->getContraseña());
            $stmt->bindParam(':id_usuario_rol', $usuario->getIdUsuarioRol());

            return $stmt->execute();
        } catch (\Exception $e) {
            error_log("Error al actualizar el usuario: " . $e->getMessage());
            return false;
        }
    }

    public function delete(string $id_usuario): bool
    {
        try {
            $sql = "DELETE FROM " . self::TABLE . " WHERE id_usuario = :id_usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_usuario', $id_usuario);
            return $stmt->execute();
        } catch (\Exception $e) {
            error_log("Error al eliminar el usuario: " . $e->getMessage());
            return false;
        }
    }

    public function getById(string $id_usuario): ?Usuario
    {
        try {
            $sql = "SELECT nombre, apellido, email, celular, contraseña, fecha_registro, id_usuario_rol
                    FROM " . self::TABLE . " WHERE id_usuario = :id_usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->execute();

            $fila = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($fila) {
                return new Usuario(
                    $id_usuario,
                    $fila['nombre'],
                    $fila['apellido'],
                    $fila['email'],
                    (int)$fila['celular'],
                    $fila['contraseña'],
                    $fila['fecha_registro'],
                    $fila['id_usuario_rol']
                );
            } else {
                return null;
            }
        } catch (\Exception $e) {
            error_log("Error al obtener el usuario por ID: " . $e->getMessage());
            return null;
        }
    }
}
