<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = new User();
        $usuario->cpf = '70859029069';
        $usuario->name = 'Juan';
        $usuario->email = 'juan@gmail.com';
        $usuario->cargo = 'admin';
        $usuario->departamento_id = 1;
        $usuario->password = bcrypt('123456');
        $usuario->save();
    }
}
