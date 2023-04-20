<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\country;
use App\Models\state;

//use Illuminate\Support\Facades\DB;


class worldcontroller extends Controller

{
    function india(){
        $user=country::all();
        return view('india',compact('user'));
    }

    function goa(){
        $userdata=state::all();
        return view('india',compact('userdata'));
    }




    function index(Request $request)
    {
    	$data['country']=db::table('country')->get();

    
        	return view('country/index',$data);
    }

    function getstate(Request $request)
    {
    	$ct_id=$request->post('ct_id');
    	$state=db::table('state')->where('country',$ct_id)->get();

    
        	$html='<option value="">select state:</option>';
        	foreach ($state as $list) {
        	$html.='<option value="'.$list->id.'">'.$list->state.'</option>';
        	}
        	echo $html;
        		
        	
		
    }

     function getcity(Request $request)
    {
    	$st_id=$request->post('st_id');
    	$city=db::table('state')->where('state',$st_id)->get();

    
        	$html='<option value="">select city:</option>';
        	foreach ($city as $list) {
        	$html.='<option value="'.$list->id.'">'.$list->city.'</option>';
        	}
        	echo $html;
        		
        	
		
    }



}
