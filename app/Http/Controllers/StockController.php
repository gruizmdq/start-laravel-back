<?php

namespace App\Http\Controllers;

use App\Enums\StockConstants;
use Illuminate\Http\Request;
use App\Models\stock\Shoe;
use Illuminate\Support\Facades\Log;

class StockController extends Controller
{

    public function findShoes(Request $request) {
        Log::info(StockConstants::STOCK_LOG_LABEL." ".json_encode($request->all()));
        $fields = $request->validate([
            "id_shoe_brand" => "required|integer",
            "id_shoe" => "nullable|integer",
            "code" => "nullable|string",
            "filters" => "nullable|array"
        ]);
        return Shoe::paginate();
    }
}
