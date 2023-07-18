<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Books;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
            // $max = DB::table('books')->max('id') + 1; 
            // DB::statement("ALTER TABLE books AUTO_INCREMENT =  $max");

            DB::statement("SET @count = 0;");
            DB::statement("UPDATE `books` SET `books`.`id` = @count:= @count + 1;");
            DB::statement("ALTER TABLE `books` AUTO_INCREMENT = 1;");

            DB::table('books')->insert([
            'name'=> 'The Underground Railroad ',
        ]);

        
    }
}
