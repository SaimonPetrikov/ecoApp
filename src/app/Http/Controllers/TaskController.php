<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
     /**
     * get all task
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json([], 200);
    }
}