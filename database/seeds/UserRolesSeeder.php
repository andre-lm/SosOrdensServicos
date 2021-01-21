<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
		$objects = array(

			// ROOT

			array(
				'user_id' => 1, 
				'role_id' => 1
			), 
			array(
				'user_id' => 1, 
				'role_id' => 2
			), 
			array(
				'user_id' => 1, 
				'role_id' => 3
			), 
			array(
				'user_id' => 1, 
				'role_id' => 4
			), 
			
			// ADMIN
			array(
				'user_id' => 2, 
				'role_id' => 2
			), 
			array(
				'user_id' => 2, 
				'role_id' => 3
			), 
			array(
				'user_id' => 2, 
				'role_id' => 4
			), 

			//TECNICOS
			array(
				'user_id' => 3, 
				'role_id' => 3
			), 
			array(
				'user_id' => 3, 
				'role_id' => 4
			), 

			array(
				'user_id' => 4, 
				'role_id' => 3
			), 
			array(
				'user_id' => 4, 
				'role_id' => 4
			), 
			
		);

		// Uncomment the below to run the seeder
		DB::table('user_roles')->insert($objects);
    }
}
