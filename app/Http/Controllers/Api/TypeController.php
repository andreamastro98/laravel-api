<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index(){
        $types = Type::all();

        return response()->json(
            [
                'success' => true,
                'types' => $types
            ]
        );
    }
}
