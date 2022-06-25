<?php

namespace App\Http\Controllers\admin;

use App\Models\safe;
use App\Models\weight;
use App\Models\goldbar;
use App\Models\safetype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class goldbarcontroller extends Controller
{
   public function create(){

     $safetypes=safetype::get();
     $weights=weight::get();


     return view('dashboard.admin.goldbar',compact('safetypes','weights'));
   }

              //////////////////////////end create gold bar///////////////////

   public function catchsafe(Request $request){
    $data=safe::select('name','id')->where('safetype_id',$request->id)->take(20)->get();
    return response()->json($data);
}
              /////////////////////////   fetch gold bar//////////////////
public function fetchgoldbar(){
  // $safe=safe::get();
  $goldbar=goldbar::with('safetype','weight','safe')->get();

 if($goldbar){
  return response()->json([
      'goldbar'=>$goldbar,
  ]); 
 }else{
  return response()->json([
      'status'=>500,
      'errors'=>'fail',
  ]);
 }

}

/////////////////////////////store new gold bar//////////////////////////////
public function store( Request $request){
  $validator=Validator::make($request->all(),[
      'name'=>'required|string|max:10',
      'weight'=>'required', //weight
      'safetype_id'=>'required',
      'safename'=>'required'
  ]);
  if($validator->fails())
      {
          return response()->json([
              'status'=>400,
              'errors'=>$validator->errors()
          ]);
      }
      else
      {
            $goldbar= new goldbar;
            if($goldbar){
              goldbar::create([
                  'SerialNumber'=>$request->name,
                  'weight_id'=>$request->weight,
                  'safetype_id'=>$request->safetype_id,
                  'safe_id'=>$request->safename,
              ]);
  
              return response()->json([
                  'status'=>200,
                  'message'=>'goldbar Added Successfully.'
              ]);
            }
            else
            {
               return response()->json( [
                   
                   'status'=>404,
                   'errors'=>'fail',
                   
               ]); 
                
              }
      }

 }
 ///////////////////////////// end store new gold bar//////////////////////////////
     ///////////////////////////// edit gold bar//////////////////////////////
     public function edit($id){
 
      $goldbar=goldbar::findOrfail($id);
      // dd($safes);
    if($goldbar){
        return response()->json([
            'status'=>200,
            'message'=>'safetype Added Successfully.',
            'goldbar'=>$goldbar,
        ]);
    
    }
        else
        {
            return response()->json([
                'status'=>404,
                'errors'=>'not found'
            ]);
        }
    
    }

    /////////////////////////////  endedit gold bar//////////////////////////////



    public function update(Request $request,$id){


      $validator=Validator::make($request->all(),[
        'name'=>'required|string|max:10',
        'weight'=>'required', //weight
        'safetype_id'=>'required',
        'safename'=>'required'
      
      ]);
      if($validator->fails())
          {
              return response()->json([
                  'status'=>404,
                  'errors'=>$validator->errors()
              ]);
          }
          else
          {
              $goldbar=goldbar::findOrfail($id);
              if($goldbar){
                  $goldbar->SerialNumber= $request->input('name');
                  $goldbar->weight_id= $request->input('weight');
                  $goldbar->safetype_id= $request->input('safetype_id');
                  $goldbar->safe_id= $request->input('safename');
                  $goldbar->save();
                  return response()->json([
                      'status'=>200,
                      'message'=>'safetype updated Successfully.'
                  ]);
              }
              else
      {
          return response()->json([
              'status'=>404,
              'errors'=>'No safetype Found.'
          ]);
      }

          }
  
     }


     ///////////////////////end update////////////////////
     public function delete($id){
        $goldbar=goldbar::findOrfail($id);
        if($goldbar){
            $goldbar->delete();
            return response()->json([
                'status'=>200,
                'message'=>'deleted.'
            ]);
          }else{
              return response()->json([
                  'status'=>404,
                  'errors'=>'not found.'
              ]); 
          }
        

 }
             ////////////////////////end delete///////////////
             public function search( Request $request){
                $keyword=$request->keyword;
                $goldbar=goldbar::with('safetype','weight','safe')->where('SerialNumber','like',"%$keyword%")->get();
              
                return response()->json( $goldbar);

}


               /////////////////end search///////////////////
}