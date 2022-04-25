<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSideers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'last_name' => 'system',
            'second_last_name'=> 'system2',
        ]);
    }
}
