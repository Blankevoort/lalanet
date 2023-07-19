<?php

namespace App\Http\Controllers;
use App\Models\Lalaey;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchLalaey(Request $request) {
        $search = $request->get('q');
        return Lalaey::where('Name', 'LIKE', '%'. $search .'%')->get();
    }
}
