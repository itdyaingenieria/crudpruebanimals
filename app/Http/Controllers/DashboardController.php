<?php

namespace App\Http\Controllers;

use App\Models\Corral;
use App\Models\Animal;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $animal = Animal::count();
        $corral = Corral::count();
        return response()->json(compact('animal', 'corral'));
    }
}
