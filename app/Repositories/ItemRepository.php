<?php

namespace App\Repositories;

use App\Contract\Repositories\ItemRepositoryInterface;
use App\Models\Item;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

class ItemRepository extends BaseRepository implements ItemRepositoryInterface
{
    public function __construct(Item $model)
    {
        parent::__construct($model);
    }

    public function getAllItem(?int $limit = 3): Collection|Paginator
    {
        return $this->model->orderByDesc('id')->paginate($limit);
    }
}
