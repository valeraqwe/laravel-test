<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function find(Request $request): JsonResponse
    {
        $query = Data::query();

        if ($shipToName = $request->input('ship_to_name')) {
            $query->where('ship_to_name', $shipToName);
        }

        if ($customerEmail = $request->input('customer_email')) {
            $query->where('customer_email', $customerEmail);
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $limit = $request->input('limit', 5);
        $data = $query->paginate($limit);

        return response()->json($data);
    }
}
