<?php

namespace JeffersonGoncalves\Commerce\Inventory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Inventory\Models\InventoryItem;
use JeffersonGoncalves\Commerce\Inventory\Models\ReservationItem;

/**
 * @extends Factory<ReservationItem>
 */
class ReservationItemFactory extends Factory
{
    protected $model = ReservationItem::class;

    public function definition(): array
    {
        return [
            'inventory_item_id' => InventoryItem::factory(),
            'location_id' => 'sloc_'.$this->faker->lexify('??????'),
            'quantity' => $this->faker->numberBetween(1, 10),
            'line_item_id' => null,
            'description' => null,
            'metadata' => null,
        ];
    }
}
