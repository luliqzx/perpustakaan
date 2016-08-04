<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        $this->call(BooksSeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(UsersSeeder::class);
        // $this->call(BooksSeeder::class);
    }
}
