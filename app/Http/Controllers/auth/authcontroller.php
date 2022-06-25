<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use finfo;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\MessageBag;
class authcontroller extends Controller
{
    public function login(){

        return view('dashboard.admin.login');
    }

    public function hadlelogin(Request $request){
        $data=$request->validate([
            'email'=>'required|email|max:100',
            'password'=>'required|string|max:10'
        ]);
            

        
        if(!auth()->guard('admins')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
            return back();
        }else{
            return redirect(route('admin.country.create'));
        }
    }



    public function logout(){
        auth()->guard('admins')->logout();
        return redirect(route('admin.login'));

    }
}