<?php

namespace App\Http\Controllers\Admin\Item;

use App\Contract\Repositories\ItemRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\CreateItemRequest;
use Illuminate\Http\Request;

class StoreItemController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        CreateItemRequest $request,
        ItemRepositoryInterface $itemRepository
    )
    {
       $itemRepository->create($request->validated());
       
        return back();
    }
}
