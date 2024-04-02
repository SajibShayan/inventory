<?php

namespace App\Repositories;

use App\Contract\Repositories\InventoryRepositoryInterface;
use App\Models\Inventory;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

class InventoryRepository extends BaseRepository implements InventoryRepositoryInterface
{
    public function __construct(Inventory $model)
    {
        parent::__construct($model);
    }

    public function getAllInventory(?int $limit = 3): Collection|Paginator
    {
        return $this->model->orderByDesc('id')->paginate($limit);
    }
}
