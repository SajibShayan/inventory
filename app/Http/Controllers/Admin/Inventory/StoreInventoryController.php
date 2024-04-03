<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\CreateInventoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreInventoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateInventoryRequest $request)
    {
        $payload = $request->validated();
        $user = Auth::user();

        $user->inventories()->create($payload);
        return back();
    }
}
