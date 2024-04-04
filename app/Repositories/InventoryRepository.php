<?php

namespace App\Repositories;

use App\Contract\Repositories\InventoryRepositoryInterface;
use App\Models\Inventory;
use Illuminate\Database\Eloquent\Collection;

class InventoryRepository extends BaseRepository implements InventoryRepositoryInterface
{
    public function __construct(Inventory $model)
    {
        parent::__construct($model);
    }

    public function getAllInventory(): Collection
    {
        return $this->model->all();
    }
}
