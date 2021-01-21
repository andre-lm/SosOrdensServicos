<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('status')->insert([
            ['status'=>'Aberto'],
            ['status'=>'Em Atendimento'],
            ['status'=>'Encerrado']
        ]);
        //
    }
}
