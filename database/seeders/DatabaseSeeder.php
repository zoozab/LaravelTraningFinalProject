<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Products;
use App\Models\MultiImage;
use App\Models\Wallet;
use App\Models\Catagory;
use App\Models\Comments;
use App\Models\ProductsForSale;
use App\Models\SiteMultiImage;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //     User::factory(10)->has(
        //         Products::factory(3)->has(MultiImage::factory()->count(3)),
        //         Wallet::factory(2)
        //     )->create();
        //     Catagory::factory(6)->has(ProductsForSale::factory(5)->has(SiteMultiImage::factory()->count(3), Comments::factory()->count(3)), Products::factory(3))->create();
    }
}
