<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $units = [
            'Piece' => 'pcs',
            'Kilogram' => 'kg',
            'Liter' => 'L',
            'Box' => 'box',
        ];

        $products = [
            ['Unga wa Dola Maize Meal 2kg', 'KE-MEAL-001', 'Staple Foods', 'Unga Limited', 'Kilogram', 175, 145, 48],
            ['Pembe Maize Meal 2kg', 'KE-MEAL-002', 'Staple Foods', 'Pembe Flour Mills', 'Kilogram', 180, 150, 42],
            ['Ajab Wheat Flour 2kg', 'KE-FLOUR-001', 'Staple Foods', 'Ajab', 'Kilogram', 220, 185, 35],
            ['Mumias Sugar 2kg', 'KE-SUGAR-001', 'Staple Foods', 'Mumias', 'Kilogram', 360, 315, 30],
            ['Kensalt Iodized Salt 1kg', 'KE-SALT-001', 'Staple Foods', 'Kensalt', 'Kilogram', 75, 58, 60],
            ['Blue Band Margarine 500g', 'KE-SPREAD-001', 'Breakfast & Spreads', 'Blue Band', 'Piece', 280, 235, 32],
            ['Ketepa Pride Tea Bags 100s', 'KE-TEA-001', 'Beverages', 'Ketepa', 'Box', 330, 280, 25],
            ['Kericho Gold Tea Bags 100s', 'KE-TEA-002', 'Beverages', 'Kericho Gold', 'Box', 350, 295, 22],
            ['Nescafé Classic Coffee 50g', 'KE-COFFEE-001', 'Beverages', 'Nescafé', 'Piece', 340, 290, 20],
            ['Brookside Fresh Milk 500ml', 'KE-MILK-001', 'Dairy', 'Brookside', 'Liter', 70, 55, 50],
            ['KCC Gold Crown Butter 500g', 'KE-BUTTER-001', 'Dairy', 'KCC', 'Piece', 330, 280, 18],
            ['Del Monte Mango Juice 1L', 'KE-JUICE-001', 'Beverages', 'Del Monte', 'Liter', 230, 190, 28],
            ['Coca-Cola Original 500ml', 'KE-SODA-001', 'Beverages', 'Coca-Cola', 'Piece', 80, 55, 72],
            ['Fanta Orange 500ml', 'KE-SODA-002', 'Beverages', 'Coca-Cola', 'Piece', 80, 55, 60],
            ['Keringet Mineral Water 500ml', 'KE-WATER-001', 'Beverages', 'Keringet', 'Piece', 55, 35, 96],
            ['Indomie Chicken Noodles 70g', 'KE-NOODLES-001', 'Quick Meals', 'Indomie', 'Piece', 45, 30, 80],
            ['Royco Mchuzi Mix 200g', 'KE-SPICE-001', 'Cooking Essentials', 'Royco', 'Piece', 110, 85, 34],
            ['Tropical Heat Curry Powder 100g', 'KE-SPICE-002', 'Cooking Essentials', 'Tropical Heat', 'Piece', 130, 100, 28],
            ['Omo Fast Action Detergent 1kg', 'KE-LAUNDRY-001', 'Home Care', 'Omo', 'Kilogram', 255, 210, 30],
            ['Sunlight Bar Soap 500g', 'KE-LAUNDRY-002', 'Home Care', 'Sunlight', 'Piece', 125, 95, 45],
            ['Harpic Toilet Cleaner 500ml', 'KE-CLEAN-001', 'Home Care', 'Harpic', 'Piece', 190, 150, 24],
            ['Dettol Original Soap 175g', 'KE-SOAP-001', 'Personal Care', 'Dettol', 'Piece', 115, 85, 40],
            ['Geisha Black Soap 225g', 'KE-SOAP-002', 'Personal Care', 'Geisha', 'Piece', 95, 70, 42],
            ['Colgate Maximum Cavity Protection 100ml', 'KE-ORAL-001', 'Personal Care', 'Colgate', 'Piece', 165, 130, 35],
            ['Vaseline Blue Seal Petroleum Jelly 250ml', 'KE-SKIN-001', 'Personal Care', 'Vaseline', 'Piece', 240, 195, 26],
            ['Kleenex Facial Tissues 100s', 'KE-TISSUE-001', 'Home Care', 'Kleenex', 'Box', 150, 115, 30],
            ['Fresh Eggs Tray 30s', 'KE-EGGS-001', 'Dairy', 'Local Farm', 'Box', 520, 450, 16],
            ['Kipepeo Rice 2kg', 'KE-RICE-001', 'Staple Foods', 'Kipepeo', 'Kilogram', 390, 330, 24],
        ];

        foreach ($products as [$name, $sku, $categoryName, $brandName, $unitName, $price, $purchasePrice, $quantity]) {
            $category = Category::firstOrCreate(['name' => $categoryName]);
            $brand = Brand::firstOrCreate(['name' => $brandName]);
            $unit = Unit::firstOrCreate(['title' => $unitName], ['short_name' => $units[$unitName]]);

            Product::updateOrCreate(
                ['sku' => $sku],
                [
                    'image' => '',
                    'name' => $name,
                    'description' => 'Kenyan supermarket demo product.',
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
                    'unit_id' => $unit->id,
                    'price' => $price,
                    'discount' => 0,
                    'discount_type' => 'fixed',
                    'purchase_price' => $purchasePrice,
                    'quantity' => $quantity,
                    'expire_date' => now()->addMonths(6)->toDateString(),
                    'status' => true,
                ]
            );
        }
    }
}
