<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SetUserAdmin extends Command
{
    protected $signature = 'user:admin {email : Email del usuario a convertir en admin}';

    protected $description = 'Asigna permisos de administrador a un usuario';

    public function handle()
    {
        $email = $this->argument('email');

        $user = User::where('email', $email)->first();

        if (! $user) {
            $this->error("No se encontró un usuario con email: {$email}");
            return 1;
        }

        $user->is_admin = true;
        $user->save();

        $this->info("Usuario {$user->name} ({$email}) ahora es administrador.");
        return 0;
    }
}
