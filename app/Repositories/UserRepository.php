<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {

    public function store($request){
        try {
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password)
            ]);
    
            return $user;
        } catch (\Throwable $th) {
            return false;
        }
    }

}