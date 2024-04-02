<?php

namespace App\Contract\Repositories;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

interface InventoryRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllInventory(?int $limit = 3): Collection|Paginator;
}
