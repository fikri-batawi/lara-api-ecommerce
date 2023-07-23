<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Hash;

class UserController extends Controller
{
    private $userRepository;
    public function __construct(){
        $this->userRepository = new UserRepository();
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
        //
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
        //show user
        $user = $this->userRepository->show($id);
        
        //return response JSON user is not found
        if(!$user) {
            return response()->json([
                'success' => false,
                'user' => config('constants.failed_messages.not_found'),  
            ], 404);
        }

        $isConflictEmail = $request->email !== $user->email ? $this->userRepository->findByEmail($request->email) : false;
        if($isConflictEmail) {
            return response()->json([
                'success' => false,
                'message' => config('constants.failed_messages.conflict'),  
            ], 409);
        }

        // Update password
        if($request->oldPassword){
            $oldPassword = $request->oldPassword;
            $isValidPassword = Hash::check($oldPassword, $user->password);

            if(!$isValidPassword){
                //if auth success
                return response()->json([
                    'success' => false, 
                    'message' => config('constants.failed_messages.login')   
                ], 401);
            }
            
            $data = [
                'password'  => bcrypt($request->newPassword),
            ];
        }else{
            //Update user
            $data = [
                'name'      => $request->name ?? $user->name,
                'email'     => $request->email ?? $user->email,
                'password'  => $request->password ? bcrypt($request->password) : $user->password,
            ];
        }

        $user = $this->userRepository->update($data, $id);

        //return response JSON user is updated
        if($user) {
            return response()->json([
                'success' => true,
                'user'    => $user,  
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
