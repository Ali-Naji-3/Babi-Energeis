<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing categories (handle foreign key constraints)
        Category::whereNotNull('id')->delete();

        // Main parent categories
        $parentCategories = [
            [
                'name' => 'Solar Energy',
                'slug' => 'solar-energy',
                'description' => 'Complete solar energy solutions for homes and businesses',
                'is_active' => true,
                'sort_order' => 1,
                'parent_id' => null,
            ],
            [
                'name' => 'Energy Storage',
                'slug' => 'energy-storage',
                'description' => 'Battery storage systems and energy management solutions',
                'is_active' => true,
                'sort_order' => 2,
                'parent_id' => null,
            ],
            [
                'name' => 'Energy Efficiency',
                'slug' => 'energy-efficiency',
                'description' => 'Products to reduce energy consumption and improve efficiency',
                'is_active' => true,
                'sort_order' => 3,
                'parent_id' => null,
            ],
            [
                'name' => 'Green Technology',
                'slug' => 'green-technology',
                'description' => 'Advanced green technology and smart energy solutions',
                'is_active' => true,
                'sort_order' => 4,
                'parent_id' => null,
            ],
        ];

        // Create parent categories
        $createdParents = [];
        foreach ($parentCategories as $category) {
            $createdParents[] = Category::create($category);
        }

        // Child categories for Solar Energy
        $solarEnergyId = $createdParents[0]->id;
        $solarCategories = [
            [
                'name' => 'Solar Panels',
                'slug' => 'solar-panels',
                'description' => 'High-efficiency monocrystalline and polycrystalline solar panels',
                'is_active' => true,
                'sort_order' => 1,
                'parent_id' => $solarEnergyId,
            ],
            [
                'name' => 'Solar Inverters',
                'slug' => 'solar-inverters',
                'description' => 'String, micro, and hybrid inverters for solar systems',
                'is_active' => true,
                'sort_order' => 2,
                'parent_id' => $solarEnergyId,
            ],
            [
                'name' => 'Solar Mounting',
                'slug' => 'solar-mounting',
                'description' => 'Roof, ground, and carport mounting systems',
                'is_active' => true,
                'sort_order' => 3,
                'parent_id' => $solarEnergyId,
            ],
            [
                'name' => 'Solar Accessories',
                'slug' => 'solar-accessories',
                'description' => 'Cables, connectors, monitoring systems, and solar accessories',
                'is_active' => true,
                'sort_order' => 4,
                'parent_id' => $solarEnergyId,
            ],
        ];

        // Child categories for Energy Storage
        $energyStorageId = $createdParents[1]->id;
        $storageCategories = [
            [
                'name' => 'Lithium-ion Batteries',
                'slug' => 'lithium-ion-batteries',
                'description' => 'High-performance lithium-ion battery storage systems',
                'is_active' => true,
                'sort_order' => 1,
                'parent_id' => $energyStorageId,
            ],
            [
                'name' => 'Lead-acid Batteries',
                'slug' => 'lead-acid-batteries',
                'description' => 'Reliable lead-acid battery storage solutions',
                'is_active' => true,
                'sort_order' => 2,
                'parent_id' => $energyStorageId,
            ],
            [
                'name' => 'Saltwater Batteries',
                'slug' => 'saltwater-batteries',
                'description' => 'Eco-friendly saltwater battery storage systems',
                'is_active' => true,
                'sort_order' => 3,
                'parent_id' => $energyStorageId,
            ],
            [
                'name' => 'Battery Management',
                'slug' => 'battery-management',
                'description' => 'BMS systems, monitoring, and battery management solutions',
                'is_active' => true,
                'sort_order' => 4,
                'parent_id' => $energyStorageId,
            ],
        ];

        // Child categories for Energy Efficiency
        $energyEfficiencyId = $createdParents[2]->id;
        $efficiencyCategories = [
            [
                'name' => 'LED Lighting',
                'slug' => 'led-lighting',
                'description' => 'Energy-efficient LED lighting for residential and commercial use',
                'is_active' => true,
                'sort_order' => 1,
                'parent_id' => $energyEfficiencyId,
            ],
            [
                'name' => 'Smart Controls',
                'slug' => 'smart-controls',
                'description' => 'Smart thermostats, automation systems, and energy controls',
                'is_active' => true,
                'sort_order' => 2,
                'parent_id' => $energyEfficiencyId,
            ],
            [
                'name' => 'Insulation',
                'slug' => 'insulation',
                'description' => 'Energy-saving insulation materials and solutions',
                'is_active' => true,
                'sort_order' => 3,
                'parent_id' => $energyEfficiencyId,
            ],
            [
                'name' => 'Heat Pumps',
                'slug' => 'heat-pumps',
                'description' => 'Efficient heat pump systems for heating and cooling',
                'is_active' => true,
                'sort_order' => 4,
                'parent_id' => $energyEfficiencyId,
            ],
        ];

        // Child categories for Green Technology
        $greenTechId = $createdParents[3]->id;
        $greenTechCategories = [
            [
                'name' => 'Wind Energy',
                'slug' => 'wind-energy',
                'description' => 'Small wind turbines and wind energy accessories',
                'is_active' => true,
                'sort_order' => 1,
                'parent_id' => $greenTechId,
            ],
            [
                'name' => 'Water Heating',
                'slug' => 'water-heating',
                'description' => 'Solar water heaters and heat pump water systems',
                'is_active' => true,
                'sort_order' => 2,
                'parent_id' => $greenTechId,
            ],
            [
                'name' => 'Energy Monitoring',
                'slug' => 'energy-monitoring',
                'description' => 'Smart meters, energy monitoring systems, and analytics',
                'is_active' => true,
                'sort_order' => 3,
                'parent_id' => $greenTechId,
            ],
            [
                'name' => 'EV Charging',
                'slug' => 'ev-charging',
                'description' => 'Electric vehicle charging stations and accessories',
                'is_active' => true,
                'sort_order' => 4,
                'parent_id' => $greenTechId,
            ],
        ];

        // Create all categories
        $allCategories = array_merge(
            $solarCategories,
            $storageCategories,
            $efficiencyCategories,
            $greenTechCategories
        );

        foreach ($allCategories as $category) {
            Category::create($category);
        }
    }
}