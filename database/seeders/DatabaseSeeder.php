<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call(UsersTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(ChatsTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(InterestsTableSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
