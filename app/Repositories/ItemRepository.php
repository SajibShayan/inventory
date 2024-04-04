<?php

namespace App\Repositories;

use App\Action\UploadImageAction;
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
        return $this->model->with('inventory')->orderByDesc('id')->paginate($limit);
    }

    public function create(array $payload): Item
    {

        $payload['image'] = (new UploadImageAction())
        ->execute(file: $payload['image']) ?: throw new \Exception('Unable to upload image!');

        $this->model->create($payload);

        return $this->model->refresh();

    }

}
