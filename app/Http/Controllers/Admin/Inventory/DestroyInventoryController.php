<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Contract\Repositories\InventoryRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class DestroyInventoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, 
    Inventory $inventory,
    InventoryRepositoryInterface $inventoryRepository
    )
    {
        $inventoryRepository->delete($inventory->id);
        return back();
    }

}
