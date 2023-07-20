<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository {

    public function index(){
        try {
            return Product::paginate(config('constants.pagination'));
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function store($request){
        try {
            $product = Product::create([
                'name'          => $request->name,
                'description'   => $request->description,
                'price'         => $request->price,
                'stock'         => $request->stock,
            ]);
    
            return $product;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function show($id){
        try {
            return Product::find($id);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function update($request, $id){
        try {
            $product = $this->show($id);
            $product->update($request->all());
    
            return $product;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id){
        try {
            $product = $this->show($id);
            $product->delete();
    
            return $product;
        } catch (\Throwable $th) {
            return false;
        }
    }
}