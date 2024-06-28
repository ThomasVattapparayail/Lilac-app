<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach(range(1, 30) as $index) {
            $user = new User();
            $user->name = $faker->name;
            $user->fk_department = $faker->numberBetween(1, 5); 
            $user->fk_designation = $faker->numberBetween(1, 3); 
            $user->phone_number = $faker->phoneNumber;
            $user->save();
        }
    }
}
