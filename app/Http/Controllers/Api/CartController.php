<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Repositories\CartRepository;


class CartController extends Controller
{
    private $cartRepository;
    public function __construct(){
        $this->cartRepository = new CartRepository();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get carts
        $carts = $this->cartRepository->index();

        //return response JSON list of carts
        return response()->json([
            'success' => true,
            'carts' => $carts,  
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
    public function store(StoreCartRequest $request)
    {
        //create cart
        $cart = $this->cartRepository->store($request);

        //return response JSON cart is created
        if($cart) {
            return response()->json([
                'success' => true,
                'cart'    => $cart,  
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
        //show cart
        $cart = $this->cartRepository->show($id);

        //return response JSON cart
        if($cart) {
            return response()->json([
                'success' => true,
                'cart'    => $cart,  
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
    public function update(Request $request, $id)
    {
        //show cart
        $cart = $this->cartRepository->show($id);
        
        //return response JSON cart is not found
        if(!$cart) {
            return response()->json([
                'success' => false,
                'cart' => config('constants.failed_messages.not_found'),  
            ], 404);
        }

        //Update cart
        $cart = $this->cartRepository->update($request, $id);

        //return response JSON cart is updated
        if($cart) {
            return response()->json([
                'success' => true,
                'cart'    => $cart,  
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
        //show cart
        $cart = $this->cartRepository->show($id);
        
        //return response JSON cart is not found
        if(!$cart) {
            return response()->json([
                'success' => false,
                'cart' => config('constants.failed_messages.not_found'),  
            ], 404);
        }
        
        // delete cart
        $cart = $this->cartRepository->delete($id);

        //return response JSON cart is deleted
        if($cart) {
            return response()->json([
                'success' => true,
                'cart' => config('constants.success_messages.delete'),  
            ], 200);
        }
    }
}
