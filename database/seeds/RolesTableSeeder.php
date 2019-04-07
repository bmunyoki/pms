<?php

use Illuminate\Database\Seeder;

use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        if(Role::get()->count() == 0){
        	Role::insert([
        		[
        			'name' => 'Patient',
        			'description' => 'Patient user.'
        		],
                [
                    'name' => 'Doctor',
                    'description' => 'Doctor user.'
                ],
        		[
        			'name' => 'Lab',
        			'description' => 'Lad technician user.'
        		],
        		[
        			'name' => 'Admin',
        			'description' => 'Admin super user'
        		]
        	]);
        }
    }
}
