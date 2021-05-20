<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');
        $data = [
            ['name' => 'Cây cảnh', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Cây văn phòng', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Tiểu cảnh Terrarium', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Phụ kiện trang trí', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Chậu cây', 'created_at' => $date, 'updated_at' => $date],
        ];

        DB::table('categories')->insert($data);
    }
}