<?php

namespace App\Http\Controllers\Admin\Item;

use App\Contract\Repositories\InventoryRepositoryInterface;
use App\Contract\Repositories\ItemRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexItemController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        Request $request,
        InventoryRepositoryInterface $inventoryRepository,
        ItemRepositoryInterface $itemRepository
    ) {

        return Inertia::render('Item/Index', [
            'categories' => $inventoryRepository->getAllInventory(),
            'items' => $itemRepository->getAllItem(limit: 10),
        ]);
    }
}
