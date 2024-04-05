<?php

namespace App\Http\Controllers\Admin\Item;

use App\Contract\Repositories\ItemRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;

class UpdateItemController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        UpdateItemRequest $request,
        Item $item,
        ItemRepositoryInterface $itemRepository
    ) {
        $payload = $request->validated();
        $itemRepository->update($item->id, $payload);

        return back();
    }
}
