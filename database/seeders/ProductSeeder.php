<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $solarPanelsCategory = Category::where('slug', 'solar-panels')->first();
        $invertersCategory = Category::where('slug', 'inverters')->first();
        $batteriesCategory = Category::where('slug', 'batteries')->first();

        $products = [
            // Solar Panels
            [
                'category_id' => $solarPanelsCategory->id,
                'name' => 'Premium Solar Panel 400W',
                'slug' => 'premium-solar-panel-400w',
                'description' => 'High-efficiency monocrystalline solar panel with 22% efficiency rating. Perfect for residential installations.',
                'short_description' => '400W monocrystalline solar panel with high efficiency',
                'sku' => 'SP-400-001',
                'price' => 299.99,
                'sale_price' => 279.99,
                'stock_quantity' => 50,
                'min_stock_level' => 5,
                'weight' => 22.5,
                'dimensions' => '2000x1000x40mm',
                'specifications' => [
                    'Power' => '400W',
                    'Efficiency' => '22%',
                    'Type' => 'Monocrystalline',
                    'Warranty' => '25 years'
                ],
                'features' => [
                    'High efficiency',
                    'Weather resistant',
                    'Easy installation',
                    '25-year warranty'
                ],
                'images' => ['https://via.placeholder.com/400x300/1B5E20/FFFFFF?text=Solar+Panel+400W'],
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => $solarPanelsCategory->id,
                'name' => 'Standard Solar Panel 350W',
                'slug' => 'standard-solar-panel-350w',
                'description' => 'Reliable polycrystalline solar panel with 18% efficiency. Great value for money.',
                'short_description' => '350W polycrystalline solar panel',
                'sku' => 'SP-350-001',
                'price' => 199.99,
                'stock_quantity' => 75,
                'min_stock_level' => 10,
                'weight' => 20.0,
                'dimensions' => '1950x990x40mm',
                'specifications' => [
                    'Power' => '350W',
                    'Efficiency' => '18%',
                    'Type' => 'Polycrystalline',
                    'Warranty' => '20 years'
                ],
                'features' => [
                    'Cost effective',
                    'Reliable performance',
                    'Easy maintenance',
                    '20-year warranty'
                ],
                'images' => ['https://via.placeholder.com/400x300/2E7D32/FFFFFF?text=Solar+Panel+350W'],
                'is_active' => true,
                'is_featured' => false,
            ],
            // Inverters
            [
                'category_id' => $invertersCategory->id,
                'name' => 'Solar Inverter 5kW',
                'slug' => 'solar-inverter-5kw',
                'description' => 'High-efficiency string inverter with MPPT technology and WiFi monitoring.',
                'short_description' => '5kW string inverter with MPPT',
                'sku' => 'SI-5K-001',
                'price' => 899.99,
                'stock_quantity' => 25,
                'min_stock_level' => 3,
                'weight' => 15.0,
                'dimensions' => '400x300x150mm',
                'specifications' => [
                    'Power' => '5000W',
                    'Efficiency' => '97.5%',
                    'Type' => 'String Inverter',
                    'MPPT' => '2 channels'
                ],
                'features' => [
                    'MPPT technology',
                    'WiFi monitoring',
                    'Grid-tie ready',
                    '10-year warranty'
                ],
                'images' => ['https://via.placeholder.com/400x300/0D47A1/FFFFFF?text=Inverter+5kW'],
                'is_active' => true,
                'is_featured' => true,
            ],
            // Batteries
            [
                'category_id' => $batteriesCategory->id,
                'name' => 'Lithium Battery 10kWh',
                'slug' => 'lithium-battery-10kwh',
                'description' => 'High-capacity lithium-ion battery for energy storage with smart BMS.',
                'short_description' => '10kWh lithium-ion battery pack',
                'sku' => 'LB-10K-001',
                'price' => 4999.99,
                'stock_quantity' => 15,
                'min_stock_level' => 2,
                'weight' => 85.0,
                'dimensions' => '600x800x200mm',
                'specifications' => [
                    'Capacity' => '10kWh',
                    'Voltage' => '48V',
                    'Chemistry' => 'LiFePO4',
                    'Cycle Life' => '6000 cycles'
                ],
                'features' => [
                    'Smart BMS',
                    'Long cycle life',
                    'Fast charging',
                    '15-year warranty'
                ],
                'images' => ['https://via.placeholder.com/400x300/FFD700/000000?text=Battery+10kWh'],
                'is_active' => true,
                'is_featured' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}