<?php

namespace app\Business\UsuarioBusiness;

use app\Interfaces\UsuarioInterface;

class GetUsuario
{
    private UsuarioInterface $usuarioRepository; // Tipado de variable

    public function __construct(UsuarioInterface $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function get(): array
    {
        try {
            $usuarios = $this->usuarioRepository->get(); // Obtén la lista de usuarios

            // Verifica si la obtención fue exitosa y devuelve el resultado
            if (is_array($usuarios)) {
                return $usuarios; // Retorna el array de usuarios
            } else {
                // Si no es un array, lanza una excepción
                throw new \Exception('Error al obtener la lista de usuarios.'); // Mejora la información de la excepción
            }
        } catch (\Exception $e) {
            // Manejo de errores, loguea o muestra un mensaje según tu preferencia
            error_log("Error en GetUsuario: " . $e->getMessage());
            return []; // Devuelve un array vacío en caso de error
        }
    }
}
