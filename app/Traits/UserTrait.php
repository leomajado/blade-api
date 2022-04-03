<?php

namespace App\Traits;

use Illuminate\Support\Facades\Session;

trait UserTrait
{

    public function sessionStatus(){

        if(!empty(Session::get('access_token')))
            return Session::get('user');

        return false;
    }

    public function killSession(){
        if(!empty(Session::get('access_token'))){
            Session::forget('access_token');
            Session::forget('user');
            Session::flush();
        }
    }
}

