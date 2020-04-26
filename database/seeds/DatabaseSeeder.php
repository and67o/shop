<?php

use App\Category;
use App\Product;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 4)->create();
        factory(Product::class, 10)->create();
        factory(Category::class, 3)->create();
    }
}
