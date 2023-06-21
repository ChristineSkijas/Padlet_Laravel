<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DateTime;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** mit den folgenden Daten kann man sich dann im FE auch einloggen */
        //Admin Nummer 1
        $user = new User();
        $user->firstName = 'Christine';
        $user->lastName = 'Muster';
        $user->email = "test@test.at";
        $user->password = bcrypt("secret");
        $user->image = "https://m.media-amazon.com/images/I/51wJO3csdCL._SY264_BO1,204,203,200_QL40_ML2_.jpg";
        $user->save();

        //Admin 2
        $user = new User();
        $user->firstName = 'Mario';
        $user->lastName = 'Muster';
        $user->email = "mario@test.at";
        $user->password = bcrypt("secret");
        $user->image = "https://m.media-amazon.com/images/I/51wJO3csdCL._SY264_BO1,204,203,200_QL40_ML2_.jpg";
        $user->save();

        //Admin 3
        $user = new User();
        $user->firstName = 'Klaus';
        $user->lastName = 'Mitter';
        $user->email = "klausi@test.at";
        $user->password = bcrypt("secret");
        $user->image = "https://m.media-amazon.com/images/I/51wJO3csdCL._SY264_BO1,204,203,200_QL40_ML2_.jpg";
        $user->save();
    }
}
