<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Entrie;
use App\Models\Padlet;
use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DateTime;

class PadletsTableSeeder extends Seeder
{
    /** Testdaten   */
    public function run()
    {
        $padlet = new Padlet();
        $padlet->name = 'Content_Strategie';
        $padlet->is_public = true;
        $padlet->user_id = 1;
        $padlet->save();

        //Einträge zum Padlet hinzufügen
        $entrie = new Entrie;
        $entrie->user_id = 1;
        $entrie->title = "Priaten-Bay";
        $entrie->content ="Südlich vom Rechtskapp";

        $entrie1 = new Entrie;
        $entrie1->user_id = 2;
        $entrie1->title = "Landstreich";
        $entrie1->content ="Eine Landzunge zwischen den zwei Bergen";
        $padlet->entries()->saveMany([$entrie, $entrie1]);
        $padlet->save();

        $padlet2 = new Padlet;
        $padlet2->name="Design_Thinking";
        $padlet2->is_public=true;
        $padlet2->user_id=2;
        $padlet2->save();

        $padlet3 = new Padlet;
        $padlet3->name="UX_Basics";
        $padlet3->is_public=true;
        $padlet3->user_id=3;
        $padlet3->save();

        $comment1 = new Comment();
        $comment1->user_id = 1;
        $comment1->entrie_id = 1;
        $comment1->comment = 'Interessant!';
        $comment1->save();

        $rating1 = new Rating();
        $rating1->user_id = 1;
        $rating1->entrie_id = 1;
        $rating1->rating = 4;
        $rating1->save();
    }
}
