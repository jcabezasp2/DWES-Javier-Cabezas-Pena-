<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Macbook Pro',
            'slug' => 'macbook-pro',
            'details' => '15 pulgadas, 1TB HDD, 32GB RAM',
            'price' => 2499.99,
            'shipping_cost' => 29.99,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.',
            'category_id' => 1,
            'image_path' => 'macbook-pro.png',
        ]);
        Product::create([
            'name' => 'Dell Vostro 3557',
            'slug' => 'vostro-3557',
            'details' => '15 pulgadas, 1TB HDD, 8GB RAM',
            'price' => 1499.99,
            'shipping_cost' => 19.99,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.',
            'category_id' => 1,
            'image_path' => 'dell-vostro-3557.png',
        ]);
        Product::create([
            'name' => 'iphone 11 Pro',
            'slug' => 'iphone-11-Pro',
            'details' => '6.1 pulgadas, 64GB, 4GB RAM',
            'price' => 640.99,
            'shipping_cost' => 14.99,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.',
            'category_id' => 2,
            'image_path' => 'iphone_11_pro.png',
        ]);
        Product::create([
            'name' => 'Remax 610D Headset',
            'slug' => 'remax-610d',
            'details' => 'Bluetooth, 10m de alcance',
            'price' => 8.99,
            'shipping_cost' => 1.89,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.',
            'category_id' => 3,
            'image_path' => 'remax-610d.png',
        ]);
        Product::create([
            'name' => 'Samsung Led TV',
            'slug' => 'samsung-led-24',
            'details' => '24 pulgadas, LED Display, Resolución 1366 x 768',
            'price' => 41.99,
            'shipping_cost' => 12.59,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.',
            'category_id' => 4,
            'image_path' => 'samsung-led-24.png',
        ]);
        Product::create([
            'name' => 'Samsung Camara Digital',
            'slug' => 'samsung-mv800',
            'details' => '16.1MP, 5x Optical Zoom',
            'price' => 144.99,
            'shipping_cost' => 13.39,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.',
            'category_id' => 5,
            'image_path' => 'samsung-mv800.jpg',
        ]);
        Product::create([
            'name' => 'Huawei GR 5 2017',
            'slug' => 'gr5-2017',
            'details' => '5.5 pulgadas, 32GB 4GB RAM',
            'price' => 148.99,
            'shipping_cost' => 6.79,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.',
            'category_id' => 2,
            'image_path' => 'gr5-2017.jpg',
        ]);


    }
}
