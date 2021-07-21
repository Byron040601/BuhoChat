<?php

namespace Database\Seeders;


use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Seeder;
use JWTAuth;

class ChatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chat::truncate();
        $faker = \Faker\Factory::create();
        // Obtenemos la lista de todos los usuarios creados e
        // iteramos sobre cada uno y simulamos un inicio de
        // sesión con cada uno para crear artículos en su nombre
        $users = User::all();
        $idsList=User::where('id','>=',0)->get();

        $idsCount=$idsList->count();
        print($idsCount);
        foreach ($users as $user) {
            // iniciamos sesión con este usuario
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            // Y ahora con este usuario creamos algunos chats
            $num_chats = 3;

            for ($j = 0; $j < $num_chats; $j++) {
                Chat::create([
                    'lastMessage' => $faker->sentence,
                    'user_id_1' =>  $user->id,
                    'user_id_2' =>  $faker->numberBetween(1,$idsCount),

                ]);
            }
        }
    }
}
