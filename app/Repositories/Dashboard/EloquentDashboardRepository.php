<?php
namespace App\Repositories\Dashboard;


use App\Models\User;

class EloquentDashboardRepository implements DashboardContract{
    public function display(){
        
         // identifying posts by its user
        $user_id = auth()->user()->id;      // get user id
        $user = User::find($user_id);       // find user

        return $user;
    }
}