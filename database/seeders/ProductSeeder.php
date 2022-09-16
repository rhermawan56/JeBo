<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    protected $stock = 100, $price = 12000;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'product' => 'Milky Regal',
            'stock' => $this->stock,
            'price' => 16000
        ]);

        Product::create([
            'product' => 'Jasmine Green Tea',
            'stock' => $this->stock,
            'price' => $this->price
        ]);

        Product::create([
            'product' => 'Milk Tea',
            'stock' => $this->stock,
            'price' => $this->price
        ]);

        Product::create([
            'product' => 'Vanilla',
            'stock' => $this->stock,
            'price' => $this->price
        ]);

        Product::create([
            'product' => 'Taro',
            'stock' => $this->stock,
            'price' => $this->price
        ]);

        Product::create([
            'product' => 'Yogurt Mango',
            'stock' => $this->stock,
            'price' => $this->price
        ]);
    }
}
