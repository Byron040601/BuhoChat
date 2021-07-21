<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciamos la tabla comments
        Contact::truncate();
        $faker = \Faker\Factory::create();

        // Obtenemos todos los usuarios
        $users = User::all();

        //obtenemos todos los contactos
        $contacts = Contact::all();

        $idsList=User::where('id', '>=', 0)->get();

        $idsCount=$idsList->count();

        foreach ($users as $user) {
            // iniciamos sesión con cada uno
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);

            // Creamos un contacto para cada usuario con este usuario
            foreach ($users as $user) {
                Contact::create([
                    'friend' => $faker->boolean,
                    'user_id_1' => $user->id,
                    'user_id_2' => $faker->numberBetween(1, $idsCount),
                ]);
            }
        }
    }
}
