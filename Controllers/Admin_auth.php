<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class Admin_auth extends Controller
{
    function registration(){
    	return view("admin/registration");
    }
    function dashboard(){
        return view("admin/dashboard");
    }
    function logout(){
        //only for middle ware
        session()->forget('userEmail');
        session()->flash('error','logout sucess');
        //only middleware
        
        return redirect("admin/login");
    }
     function login(){
    	return view("admin/login");
    }




     function loginPost(Request $request){
        $email=$request->input('email');
         $password=$request->input('password');
         $result=DB::table('admin')->where(['email'=>$email])->first();
         if(isset($result->email))
         {
            if(Hash::check($request->post('password'),$result->password))
            {
                //logout me session ke liye
                $request->session()->put('userEmail',$result->email);
                //only logout session ke liye
                return redirect('/admin/dashboard');
            }
            else{
                $request->session()->flash('msg','enter correct password');
                return redirect('admin/login');
            }
        }
        else{
            $request->session()->flash('msg','enter correct login details');
                return redirect('admin/login');

        }

        

    }
    



    function registrationPost(Request $request){
    	$request->validate([
    		'username' => 'required|max:10',
    		'email' => 'required|unique:admin',
    		'password' => 'required|max:20',


    	]);
    	$data=[
    		'username'=>$request->input('username'),
    		'email'=> $request->input('email'),
    		'password'=>Hash::make($request->input('password')),
    		'added_on'=> date('y-m-d h:i:s')

    	];
    	DB::table('admin')->insert($data);


    	$request->session()->flash('msg','register sucess');

    	return redirect("admin/login");




    	
    }
}
