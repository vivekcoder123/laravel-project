<?php

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
        // $this->call(UsersTableSeeder::class);
        $faker = Faker\Factory::create();
     //    for($i = 0; $i < 40; $i++) {
	    //     App\Error::create([
	    //     	'type' => $faker->randomElement(['Events', 'Missed','Failed','System Errors','Copy Errors','Api Errors','Email Errors']),
		   //      'name' => $faker->name,
		   //      'description' => $faker->sentence(8,12),
		   //      'server' => $faker->numberBetween(1,100),
     //        'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
		   //      'user_id' => $faker->randomElement([1,2,7,8])
	    //     ]);
	    // }

        // for($i = 0; $i < 40; $i++) {
        //     App\Operation::create([
        //         'type' => $faker->randomElement(['Run Successfully', 'Did Not Run', 'Errors']),
        //         'server_id' => $faker->numberBetween(1,10),
        //         'user_id' => $faker->randomElement([1,2,7,8])
        //     ]);
        // }

       for($i = 0; $i < 40; $i++) {
        App\License::create([
            'license_id' => $faker->numberBetween(1,1000),
            'start_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'end_date' =>$faker->date($format = 'Y-m-d',$min='2019-01-01', $max = 'now'),
            'number_of_licenses' =>$faker->numberBetween(1,1000),
            'software_name' =>$faker->name,
            'type_of_license' =>$faker->randomElement(['server','agent']),
            'operation_type' =>$faker->randomElement(['failed','errors','missed','successful']),
            'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'user_id' => $faker->randomElement([1,2,7,8])
        ]);
        }
    }
}
