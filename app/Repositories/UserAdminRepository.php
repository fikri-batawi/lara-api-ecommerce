<?php

namespace App\Repositories;

use App\Models\UserAdmin;

class UserAdminRepository {
    public function findByUser($id){
        try {
            return UserAdmin::where('user_id', $id)->first();
        } catch (\Throwable $th) {
            return false;
        }
    }
}