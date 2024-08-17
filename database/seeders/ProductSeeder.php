<?php

namespace Database\Seeders;

use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => "Chair", 'description' => "Ergonomically designed office chair with adjustable height and lumbar support, perfect for long hours of work or study.", 'price' => 200, 'image_url' => "chair.jpg", 'quantity' => 100],
            ['name' => "Table", 'description' => "Solid oak dining table with a natural finish, seats up to six people comfortably, ideal for family gatherings.", 'price' => 500, 'image_url' => "table.jpg", 'quantity' => 50],
            ['name' => "Lamp", 'description' => "Sleek and modern LED desk lamp with adjustable brightness and an energy-efficient design, perfect for late-night reading or study.", 'price' => 80, 'image_url' => "lamp.jpg", 'quantity' => 200],
            ['name' => "Bookshelf", 'description' => "Elegant 5-tier wooden bookshelf with a dark walnut finish, offering ample storage space for books, decor, and more.", 'price' => 150, 'image_url' => "bookshelf.jpg", 'quantity' => 70],
            ['name' => "Bed", 'description' => "Queen-sized bed frame with a high-quality mattress, featuring a sturdy wooden construction and a stylish headboard.", 'price' => 1200, 'image_url' => "bed.jpg", 'quantity' => 20],
            ['name' => "Rug", 'description' => "Handcrafted Persian rug, 8x10 feet, with intricate patterns and vibrant colors, adding warmth and elegance to any room.", 'price' => 300, 'image_url' => "rug.jpg", 'quantity' => 40],
            ['name' => "Dining Set", 'description' => "Sophisticated 6-seater dining set with a glass-top table and upholstered chairs, perfect for hosting dinner parties.", 'price' => 1500, 'image_url' => "dining_set.jpg", 'quantity' => 10],
            ['name' => "Coffee Table", 'description' => "Contemporary glass-top coffee table with a chrome frame, offering a chic centerpiece for your living room.", 'price' => 250, 'image_url' => "coffee_table.jpg", 'quantity' => 60],
            ['name' => "Wardrobe", 'description' => "Spacious 3-door wooden wardrobe with a classic design, featuring multiple shelves and hanging space to organize your clothing.", 'price' => 800, 'image_url' => "wardrobe.jpg", 'quantity' => 15]
        ];
        DB::table('products')->insert($products);
    }
}
