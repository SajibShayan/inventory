<?php

namespace App\Http\Controllers\Admin\Item;

use App\Contract\Repositories\ItemRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class DestroyItemController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,
        Item $item,
        ItemRepositoryInterface $itemRepository
    ) {
        $itemRepository->delete($item->id);

        return back();

    }
}
