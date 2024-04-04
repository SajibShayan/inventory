<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Contract\Repositories\InventoryRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\CreateInventoryRequest;
use App\Models\Inventory;
use Illuminate\Http\Request;

class UpdateInventoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateInventoryRequest $request,
        Inventory $inventory,
        InventoryRepositoryInterface $inventoryRepository
    ) {
        $inventoryRepository->update($inventory->id, $request->validated());

        return back();
    }
}
