<?php

namespace App\Contract\Repositories;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

interface ItemRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllItem(?int $limit = 3): Collection|Paginator;
}
