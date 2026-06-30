<?php

namespace JeffersonGoncalves\Commerce\Inventory\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\Inventory\Models\InventoryItem;
use JeffersonGoncalves\Commerce\Inventory\Models\InventoryLevel;

class InventoryService extends Service
{
    protected function model(): string
    {
        return InventoryItem::class;
    }

    /**
     * Adjust the reserved quantity of an item at a location, returning the
     * updated level. Throws if the reservation would exceed available stock.
     */
    public function reserve(string $inventoryItemId, string $locationId, int $quantity): InventoryLevel
    {
        /** @var InventoryLevel $level */
        $level = InventoryLevel::query()
            ->where('inventory_item_id', $inventoryItemId)
            ->where('location_id', $locationId)
            ->firstOrFail();

        if ($quantity > $level->availableQuantity()) {
            throw new \RuntimeException('Not enough available stock to reserve.');
        }

        $level->update(['reserved_quantity' => $level->reserved_quantity + $quantity]);

        return $level;
    }
}
