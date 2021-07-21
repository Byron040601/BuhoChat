<?php

namespace Database\Seeders;

use App\Models\Interest;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class InterestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //vaciar tabla
        Interest::truncate();

        $faker = \Faker\Factory::create();

        $users = User::all();

        //crear intereses ficticios en la tabla
        foreach ($users as $user) {
            // iniciamos sesión con este usuario
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            // Y ahora con este usuario creamos un interes
            $num_interest = 1;
            for ($j = 0; $j < $num_interest; $j++) {
                Interest::create([
                    'text' => $faker->paragraph,
                ]);
            }
        }



    }
}
