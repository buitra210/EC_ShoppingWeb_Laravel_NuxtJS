<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa dữ liệu cũ nếu có
        Product::truncate();

        // Đọc file db.json
        $jsonPath = database_path('../db.json');

        if (File::exists($jsonPath)) {
            $jsonContent = File::get($jsonPath);
            $products = json_decode($jsonContent, true);

            foreach ($products as $productData) {
                Product::create([
                    'sku' => $productData['sku'],
                    'name' => $productData['name'],
                    'description' => $productData['description'],
                    'price' => $productData['price'] ?? 100000,
                    'old_price' => $productData['old_price'] ?? null,
                    'discount' => $productData['discount'] ?? null,
                    'color' => $productData['color'],
                    'brand' => $productData['brand'],
                    'collection' => $productData['collection'],
                    'size' => $productData['size'],
                    'stock' => $productData['stock'] ?? 50,
                    'image' => $productData['image'],
                ]);
            }

            $this->command->info('Đã import ' . count($products) . ' sản phẩm thành công!');
        } else {
            $this->command->error('Không tìm thấy file db.json!');
        }
    }
}
