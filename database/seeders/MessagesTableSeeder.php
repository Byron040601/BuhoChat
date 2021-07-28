<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla
        Message::truncate();
        $faker = \Faker\Factory::create();
        // Obtenemos todos los chats
        $chats = Chat::all();
        // Obtenemos todos los usuarios
        $users = User::all();
        foreach ($users as $user) {
            // iniciamos sesión con cada uno
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            // Creamos un mensaje para cada chat con este usuario
            foreach ($chats as $chat) {
                Message::create([
                    'text' => $faker->paragraph,
                    'chat_id' => $chat->id,
                ]);
            }
        }
    }
}
