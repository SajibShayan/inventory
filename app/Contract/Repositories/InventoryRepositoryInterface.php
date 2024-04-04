<?php

namespace App\Contract\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface InventoryRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllInventory(): Collection;
}
