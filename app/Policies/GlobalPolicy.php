<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GlobalPolicy
{
    use HandlesAuthorization;

    /**
     * Filtro global: Verifica que SOLO el administrador tenga permisos
     * para hacer cualquier tipo de CRUD en el software.
     *
     * @param User $user El usuario autenticado que intenta hacer la acción
     * @param string $ability La acción que se intenta ejecutar (index, create, update, delete, etc.)
     * @return bool|null
     */
    public function before(User $user, $ability)
    {
        // Si el usuario es administrador (is_admin == 1), le damos permiso absoluto.
        // Retornar 'true' aquí aprueba automáticamente cualquier acción en todo el sistema.
        if ($user->is_admin == 1) {
            return true;
        }

        // Si el usuario NO es administrador, bloqueamos el acceso.
        // Retornar 'false' aquí rechaza la acción inmediatamente con un error 403,
        // sin importar qué CRUD intente hacer.
        return false;
    }
}