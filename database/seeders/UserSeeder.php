<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = new User();
        $usuario->name = 'Usuário Inicial';
        $usuario->email = 'userinicial@gmail.com';
        $usuario->cargo = 'normal';
        $usuario->departamento_id = 1;
        $usuario->password = bcrypt('123456');
        $usuario->save();
    }
}
