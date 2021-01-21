<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name'       => 'ROOT', 
            'description' => 'Desenvolvedor'],
            ['name'       => 'ADMIN', 
            'description' => 'Responsavel pelos usuarios'],
            ['name'        => 'TECNICO', 
            'description' => 'Tecnico responsavel'],
            ['name'        => 'USER', 
            'description' => 'Usuario normal']
        ]);
    }
}
