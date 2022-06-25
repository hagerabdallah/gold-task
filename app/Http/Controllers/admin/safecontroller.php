<?php

namespace App\Http\Controllers\admin;
use App\Models\safe;
use App\Models\country;
use App\Models\goldbar;
use App\Models\safetype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
class safecontroller extends Controller
{
    public function create(){
          $safes=safe::get();
          $safetybes=safetype::get();
          $countries=country::get();
        return view('dashboard.admin.safe',compact('safes','safetybes','countries'));
    }


    public function fetchsafe(){
        // $safe=safe::get();
        $safe=safe::with('country','safetype')->get();

       if($safe){
        return response()->json([
            'safe'=>$safe,
        ]); 
       }else{
        return response()->json([
            'status'=>500,
            'errors'=>'fail',
        ]);
       }

      
  }
  /////////////////////////////store new country//////////////////////////////
public function store( Request $request){
    $validator=Validator::make($request->all(),[
        'name'=>'required|string|max:10',
        'safetype_id'=>'required',
        'country_id'=>'required'

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
              $safe= new safe;
              if($safe){
                safe::create([
                    'name'=>$request->name,
                    'safetype_id'=>$request->safetype_id,
                    'country_id'=>$request->country_id,
    
                ]);
    
                return response()->json([
                    'status'=>200,
                    'message'=>'safe Added Successfully.'
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
   ///////////////////////////// end store new country//////////////////////////////
         ///////////////////////////// edit country//////////////////////////////
         public function edit($id){
 
            $safes=safe::findOrfail($id);
            // dd($safes);
          if($safes){
              return response()->json([
                  'status'=>200,
                  'message'=>'safe Added Successfully.',
                  'safes'=>$safes,
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
     
          /////////////////////////////  endedit country//////////////////////////////



          public function update(Request $request,$id){


            $validator=Validator::make($request->all(),[
                'name'=>'required|string|max:10',
                'safetype_id'=>'required',
                'country_id'=>'required'
            
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
                    $safes=safe::findOrfail($id);
                    if($safes){
                        $safes->name= $request->input('name');
                        $safes->country_id= $request->input('country_id');
                        $safes->safetype_id= $request->input('safetype_id');
                        $safes->save();
                        return response()->json([
                            'status'=>200,
                            'message'=>'safe updated Successfully.'
                        ]);
                    }
                    else
            {
                return response()->json([
                    'status'=>404,
                    'errors'=>'No safe Found.'
                ]);
            }

                }
        
           }


           ///////////////////////end update////////////////////
           public function delete($id){
            $safe=safe::findOrfail($id);
            if($safe){
              $goldbar=goldbar::where('safe_id',$id)->count();
              if($goldbar==0){
                $safe->delete();
                return response()->json([
                    'status'=>200,
                    'message'=>'deleted.'
                ]);
              }else{
                  return response()->json([
                      'status'=>404,
                      'errors'=>'safe has this goldbar.'
                  ]);  


              }
            }

     }
     /////////////////////end delete //////////////////////
     public function search( Request $request){
        $keyword=$request->keyword;
        $safe=safe::with('country','safetype')->where('name','like',"%$keyword%")->get();
      
        return response()->json( $safe);

}


       /////////////////end search///////////////////
}
