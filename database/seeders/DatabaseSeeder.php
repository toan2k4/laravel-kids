<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {

        Schema::disableForeignKeyConstraints();
        Supplier::truncate();
        Product::truncate();
        Customer::truncate();
        Order::truncate();
        DB::table('order_details')->truncate();

        for ($i = 0; $i < 10; $i++) {
            Supplier::create([
                'name' => fake()->name,
                'address' => fake()->address,
                'phone' => fake()->phoneNumber,
                'email' => fake()->email,
            ]);

        }
        for ($i = 0; $i < 10; $i++) {
            Product::create([
                'supplier_id' => rand(1, 9),
                'name' => fake()->unique()->words(3,true),
                'description' => fake()->realText(),
                'price' => fake()->numberBetween(300, 600),
                'stock_qty' => fake()->numberBetween(30, 100),
            ]);

            Customer::create([
                'name' => fake()->name,
                'address' => fake()->address,
                'phone' => fake()->phoneNumber,
                'email' => fake()->email,
            ]);

        }

        for ($i = 0; $i < 10; $i++) {
            Order::create([
                'customer_id' => rand(1, 10),
                'total_amount' => rand(10000, 20000),
            ]);
        }


        for ($i = 1; $i < 11; $i++) {
            DB::table('order_details')->insert([
                [
                    'product_id' => rand(1, 5),
                    'order_id' => $i,
                    'qty' => rand(3, 5),
                    'price' => rand(200, 300),
                ],
                [
                    'product_id' => rand(6, 10),
                    'order_id' => $i,
                    'qty' => rand(3, 5),
                    'price' => rand(200, 300),
                ],
            ]);
        }
    }

}
