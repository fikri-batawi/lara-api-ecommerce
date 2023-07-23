<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {

    public function store($data){
        try {
            return User::create($data);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function show($id){
        try {
            return User::find($id);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function findByEmail($email){
        try {
            return User::where('email', $email)->first();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function update($data, $id){
        try {
            $user = $this->show($id);
            $user->update($data);
    
            return $user;
        } catch (\Throwable $th) {
            return false;
        }
    }

}