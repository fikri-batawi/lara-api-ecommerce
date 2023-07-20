<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository {

    public function index(){
        try {
            return Cart::paginate(config('constants.pagination'));
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function store($request){
        try {
            $cart = Cart::create([
                'user_id'       => $request->user_id,
                'product_id'    => $request->product_id,
                'quantity'      => $request->quantity,
            ]);
            
            return $cart;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function show($id){
        try {
            return Cart::find($id);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function update($request, $id){
        try {
            $cart = $this->show($id);
            $cart->update($request->all());
    
            return $cart;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id){
        try {
            $cart = $this->show($id);
            $cart->delete();
            
            return $cart;
        } catch (\Throwable $th) {
            return false;
        }
    }

}