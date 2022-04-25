<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        // Client::create([
        //     'name' => 'Cliente',
        //     'last_name' => 'en',
        //     'second_last_name' => 'general',
            
        // ]);
        // \App\Models\User::factory(10)->create();
        $this->call([  
            SeederTablaPermisos::class,
            UserSideers::class,
            
            ])
        ;
    }
}
