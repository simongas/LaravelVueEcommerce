<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;


class ProductsController extends Controller
{
    public function index(){
        return Product::all();
    }

    public function show($id){
        return Product::findOrFail($id);
    }

}
