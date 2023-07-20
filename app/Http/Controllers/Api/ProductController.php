<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    private $productRepository;
    public function __construct(){
        $this->productRepository = new ProductRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get products
        $products = $this->productRepository->index();

        //return response JSON list of products
        return response()->json([
            'success' => true,
            'products' => $products,  
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
    public function store(StoreProductRequest $request)
    {
        //create Product
        $product = $this->productRepository->store($request);

        //return response JSON product is created
        if($product) {
            return response()->json([
                'success' => true,
                'product'    => $product,  
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
        //show Product
        $product = $this->productRepository->show($id);

        //return response JSON product
        if($product) {
            return response()->json([
                'success' => true,
                'product'    => $product,  
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
    public function update(UpdateProductRequest $request, $id)
    {
        //show Product
        $product = $this->productRepository->show($id);
        
        //return response JSON product is not found
        if(!$product) {
            return response()->json([
                'success' => false,
                'product' => config('constants.failed_messages.not_found'),  
            ], 404);
        }

        //Update product
        $product = $this->productRepository->update($request, $id);

        //return response JSON product is updated
        if($product) {
            return response()->json([
                'success' => true,
                'product'    => $product,  
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
        //show Product
        $product = $this->productRepository->show($id);
        
        //return response JSON product is not found
        if(!$product) {
            return response()->json([
                'success' => false,
                'product' => config('constants.failed_messages.not_found'),  
            ], 404);
        }
        
        // delete product
        $product = $this->productRepository->delete($id);

        //return response JSON product is deleted
        if($product) {
            return response()->json([
                'success' => true,
                'product' => config('constants.success_messages.delete'),  
            ], 200);
        }
    }
}
