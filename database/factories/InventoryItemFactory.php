<?php

namespace JeffersonGoncalves\Commerce\Inventory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Inventory\Models\InventoryItem;

/**
 * @extends Factory<InventoryItem>
 */
class InventoryItemFactory extends Factory
{
    protected $model = InventoryItem::class;

    public function definition(): array
    {
        return [
            'sku' => $this->faker->unique()->bothify('INV-####-???'),
            'title' => $this->faker->words(2, true),
            'requires_shipping' => true,
            'metadata' => null,
        ];
    }
}
