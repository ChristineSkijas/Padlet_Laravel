<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Userright;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        /**  Die Seeder werden immer der Reihe nach aufgerufen. Also wird zuerst der User aufgerufen
         * Dann wird das Padlet aufgerufen, welchem ein Benutzer zugewiesen werden kann.
         * Die Reihenfolge ist hier wichtig! */
        $this->call(UsersTableSeeder::class);
        $this->call(PadletsTableSeeder::class);
        $this->call(UserrightsTableSeeder::class);
    }
}
