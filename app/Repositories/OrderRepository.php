<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository {

    public function index(){
        try {
            return Order::paginate(config('constants.pagination'));
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function store($request){
        try {
            $order = Order::create([
                'user_id'       => $request->user_id,
                'total_price'   => $request->total_price,
            ]);
            
            return $order;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function show($id){
        try {
            return Order::find($id);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function update($request, $id){
        try {
            $order = $this->show($id);
            $order->update($request->only('status'));
    
            return $order;
        } catch (\Throwable $th) {
            return false;
        }
    }

}