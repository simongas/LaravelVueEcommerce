<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
            $data = $request->all();
            $data['slug'] = Str::slug($data['name']);
            Product::create($data);
        }
        return Product::all();
    }

    public function update(ProductCreateRequest $request){
        if($request->validated()){
            $data = $request->all();
            $data['slug'] = Str::slug($data['name']);
            Product::find($request->id)->fill($data)->save();
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
