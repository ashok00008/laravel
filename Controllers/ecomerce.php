<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;


class ecomerce extends Controller
{

     



    function index(){
    	return view("index");

    }


    function about(){
        return view("about");

    }
    
    
    
    function fetchAll(){
    	$userData=contact::all();
    	return view("fetch",compact('userData'));
    }
    function delete($id){
         $data=contact::find($id); //(deletedata=variable kuch bhi)
        $data->delete();
        return redirect("/fetch");
    }
    function update($id){
        $userData=contact::find($id);
        //echo "<pre>";
        //echo  $user->name;
        //exit;
        return view("update",compact('userData'));
    }
    function updatePost(Request $request,$id){
         $request->validate([
        'n1' => 'required|max:20',
        'm1' => 'required|max:50',
        'e1' => 'required|unique:contacts,email',
        'ind' => 'required|max:50',
        's1' => 'required|max:30',
        'c1' => 'required|max:20',

        

      ], [
        "n1.required" => "Name is required",
        "m1.required" => "Mobile is required",
        "e1.required" => "Email is required",
        "ind.required" => "country is required",
        "s1.required" => "state is required",
        "c1.required" => "city is required",
        
      ]);

         
        
      
       

        $obj=contact::find($id);
        $obj->name=$request->n1;
        $obj->mobile=$request->m1;
        $obj->email=$request->e1;
        $obj->country=$request->ind;
        $obj->state=$request->s1;
        $obj->city=$request->c1;
       
    
        
        
        
        $obj->save();
        $request->session()->flash('msg','update sucess');

        return redirect("/fetch");


    

        

        

        
        }





    function contact(){
    	return view("contact");
    }
    function contactPost(Request $request){
    	 $request->validate([
        'n1' => 'required|max:20',
        'm1' => 'required|max:50',
        'e1' => 'required|unique:contacts,email',
        'ind' => 'required|max:50',
        's1' => 'required|max:30',
        'c1' => 'required|max:20',



      ], [
        "n1.required" => "Name is required",
        "m1.required" => "Mobile is required",
        "e1.required" => "Email is required",
        "ind.required" => "country is required",
        "s1.required" => "state is required",
        "c1.required" => "city is required",
        
        
        
      ]);

        
        
    	


    	$obj=new contact();
    	$obj->name=$request->n1;
    	$obj->mobile=$request->m1;
    	$obj->email=$request->e1;
    	
    	$obj->country=$request->ind;
        $obj->state=$request->s1;
        $obj->city=$request->c1;
       
    
    	
    	$obj->save();
    	$request->session()->flash('msg','register sucess');

    	return redirect("/contact");

    	

    	

        
    	 
      
    	

    	
    }
}
