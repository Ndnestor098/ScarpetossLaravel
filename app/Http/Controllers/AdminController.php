<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use App\Services\AdminServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{

    //======================================================Paginas Principales========================================================
    public function index()
    {
        return view("admin.admin");
    }
    
    public function showSell(Request $request)
    {
        return view("admin.admin-sell");
    }

    
}
