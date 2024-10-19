<?php

namespace app\Interfaces;

use app\Models\Usuario; // Asegúrate de que el nombre de la clase es correcto

interface UsuarioInterface
{
    public function create(Usuario $usuario): bool; // Método para crear un usuario
    public function get(): array; // Método para obtener una lista de usuarios
    public function update(Usuario $usuario): bool; // Método para actualizar un usuario
    public function delete(string $id_usuario): bool; // Método para eliminar un usuario
    public function getById(string $id_usuario): ?Usuario; // Método para obtener un usuario por ID
}
