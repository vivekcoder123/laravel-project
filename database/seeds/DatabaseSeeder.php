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
	    //     	'type' => $faker->randomElement(['Failed', 'System Error', 'Space not available']),
		   //      'details' => $faker->sentence(8,12),
		   //      'description' => $faker->sentence(8,12),
		   //      'server_id' => $faker->numberBetween(1,100),
		   //      'user_id' => $faker->randomElement([1,2,7,8])
	    //     ]);
	    // }

     //    for($i = 0; $i < 40; $i++) {
     //        App\Operation::create([
     //            'type' => $faker->randomElement(['Run Successfully', 'Did Not Run', 'Errors']),
     //            'server_id' => $faker->numberBetween(1,10),
     //            'user_id' => $faker->randomElement([1,2,7,8])
     //        ]);
     //    }
    }
}
