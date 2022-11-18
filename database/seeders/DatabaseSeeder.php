<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Carbon;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        $release = ['2001/01/20',
        '2007/10/03',
        '1750/09/01',
        '1670/04/28',
        '2002/05/15',
        '1991/07/02',
        '1901/02/10',
        '1871/02/20',
        '2001/01/20'];
        $time = Carbon::now();
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123'),
            'created_at' => $time,
            'updated_at' => $time,
            'role' => 1
        ]);
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'created_at' => $time,
            'updated_at' => $time,
            'role' => 10
        ]);
       
        foreach(['Charles Dickens',
        'Adam Mickiewicz',
        'Grzegorz Brzeszczyszkiewicz',
        'Briedis Miskelis', 
        'Bram Stocker']as $cat){
            DB::table('authors')->insert([
            'title' => $cat,
            'created_at' => $time->addSeconds(1),
            'updated_at' => $time
            ]);
        }
        foreach([
            'Black', 
            'Transformers',
            'Lord of Rings', 
            'True Story',
            'Little Nancy', 
            'Chrismas Carol',
            'Law and Order', 
            'Oblivion',
            'Witcher', 
            'Home of Dragon',
            'The Story of Benjamin Button', 
            'Moon'
            ]as $book){
            DB::table('books')->insert([
            'title' => $book,
            'release' => Arr::random($release),
            'Price' => rand(100, 1000)/100,
            'author_id' => rand(1, 5),
            'created_at' => $time->addSeconds(1),
            'updated_at' => $time
            ]);
    }
}
}
