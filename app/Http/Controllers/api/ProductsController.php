<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductCreateRequest;
use App\Product;


class ProductsController extends Controller
{
    public function index(){
        return Product::all();
    }

    public function show($id){
        return Product::findOrFail($id);
    }

    public function store(ProductCreateRequest $request){
        if($request->validated()){
            Product::create($request->all());
        }
        return Product::all();
    }

    public function update(ProductCreateRequest $request){
        if($request->validated()){
            Product::find($request->id)->fill($request->all())->save();
        }
        return Product::all();
    }

    public function delete($id = 0){
        if($id > 0){
            Product::find($id)->delete();
        }
        return Product::all();
    }

    public function slug($slug = ''){
        if($slug != ''){
            $product = new Product();
            return $product->scopeSlug($slug)->first();
        }
    }
}
