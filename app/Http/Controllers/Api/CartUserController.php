<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;

class CartUserController extends Controller
{
    private $userRepository, $cartRepository, $productRepository;
    public function __construct(){
        $this->userRepository = new UserRepository();
        $this->cartRepository = new CartRepository();
        $this->productRepository = new ProductRepository();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carts = $this->cartRepository->cartUser($id);
        $data = [];
        foreach($carts as $cart){
            array_push($data,[
                'id' => $cart->id,
                'product_id' => $cart->product->id,
                'name' => $cart->product->name,
                'price' => $cart->product->price,
                'quantity' => $cart->quantity,
            ]);
        }
        
        //return response JSON list of carts
        return response()->json([
            'success' => true,
            'carts' => $data,  
        ], 200);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carts = $this->cartRepository->cartUser($id);

        //return response JSON carts user is not found
        if(!count($carts)) {
            return response()->json([
                'success' => false,
                'message' => config('constants.failed_messages.not_found'),  
            ], 404);
        }

        // Delete
        foreach($carts as $cart){
            // Delete
            $this->cartRepository->delete($cart->id);

            // Update stock product
            $product = $this->productRepository->show($cart->product_id);
            $updateStock = $product->stock - $cart->quantity;
            $request = new Request(['stock' => $updateStock]);
            $this->productRepository->update($request, $product->id);
        }

        //return response JSON carts user is deleted
        return response()->json([
            'success' => true,
            'message' => config('constants.success_messages.delete'),  
        ], 200);
    }
}
