<?php

namespace JeffersonGoncalves\Commerce\Inventory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Inventory\Models\InventoryItem;
use JeffersonGoncalves\Commerce\Inventory\Models\InventoryLevel;

/**
 * @extends Factory<InventoryLevel>
 */
class InventoryLevelFactory extends Factory
{
    protected $model = InventoryLevel::class;

    public function definition(): array
    {
        return [
            'inventory_item_id' => InventoryItem::factory(),
            'location_id' => 'sloc_'.$this->faker->unique()->lexify('??????'),
            'stocked_quantity' => 100,
            'reserved_quantity' => 0,
            'incoming_quantity' => 0,
            'metadata' => null,
        ];
    }
}
