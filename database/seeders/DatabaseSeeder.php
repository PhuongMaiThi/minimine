<?php

namespace Database\Seeders;

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
        \App\Models\Admin::factory(10)->create();
        $this->call(CategorySeeder::class);
       
        \App\Models\User::factory(10)->create();
        $this->call(ProductSeeder::class);
        $this->call(PriceSeeder::class);
        $this->call(PromotionSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
