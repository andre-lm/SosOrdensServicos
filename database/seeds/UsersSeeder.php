<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objects = array(
			array(
				'name' => 'ANDRE', 
				'email' => 'andre-lm@outlook.com.br', 
				'password' => Hash::make('12345678'),
				'created_at' => Carbon::parse(date('Y-m-d'))
			),
			array(
				'name' => 'ADMIN', 
				'email' => 'admin@admin.com', 
				'password' => Hash::make('12345678'),
				'created_at' => Carbon::parse(date('Y-m-d'))
			),
			array(
				'name' => 'EDILSON (BÁ)', 
				'email' => 'edilson@gmail.com', 
				'password' => Hash::make('12345678'),
				'created_at' => Carbon::parse(date('Y-m-d'))
			),
			array(
				'name' => 'GIBA', 
				'email' => 'giba@gmail.com', 
				'password' => Hash::make('12345678'),
				'created_at' => Carbon::parse(date('Y-m-d'))
			)
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($objects);
    }
}
