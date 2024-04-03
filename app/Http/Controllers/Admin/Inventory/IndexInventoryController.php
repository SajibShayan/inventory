<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Contract\Repositories\InventoryRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexInventoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, InventoryRepositoryInterface $inventoryRepository)
    {
       
        return Inertia::render('Dashboard', [
            'categories' => $inventoryRepository->getAllInventory(),
        ]);
    }
}
