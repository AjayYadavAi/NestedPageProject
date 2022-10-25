<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        Page::create(['title'=> 'home page','content' => 'home page']);
        // Page::factory(10)->create();
    }
}
