<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    private $orderRepository;
    public function __construct(){
        $this->orderRepository = new OrderRepository();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get orders
        $orders = $this->orderRepository->index();

        //return response JSON list of orders
        return response()->json([
            'success' => true,
            'orders' => $orders,  
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        //create order
        $order = $this->orderRepository->store($request);

        //return response JSON order is created
        if($order) {
            return response()->json([
                'success' => true,
                'order'    => $order,  
            ], 201);
        }

        //return JSON process insert failed 
        return response()->json([
            'success' => false,
            'message' => config('constants.failed_messages.insert'),
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show order
        $order = $this->orderRepository->show($id);

        //return response JSON order
        if($order) {
            return response()->json([
                'success' => true,
                'order'    => $order,  
            ], 200);
        }

        //return JSON process show failed 
        return response()->json([
            'success' => false,
            'message' => config('constants.failed_messages.not_found')
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, $id)
    {
        //show order
        $order = $this->orderRepository->show($id);
        
        //return response JSON order is not found
        if(!$order) {
            return response()->json([
                'success' => false,
                'order' => config('constants.failed_messages.not_found'),  
            ], 404);
        }

        //Update order
        $order = $this->orderRepository->update($request, $id);

        //return response JSON order is updated
        if($order) {
            return response()->json([
                'success' => true,
                'order'    => $order,  
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
