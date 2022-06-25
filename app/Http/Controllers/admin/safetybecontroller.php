<?php

namespace App\Http\Controllers\admin;

use App\Models\safe;
use App\Models\bartype;
use App\Models\safetype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class safetybecontroller extends Controller
{
    public function fetchsafetype(){
          $safetype=safetype::get();
          return response()->json([
            'safetype'=>$safetype,
        ]); 
    }
///////////////end fetch/////////////////
public function create(){

    return view('dashboard.admin.safetype');
}
/////////////////////////////store new country//////////////////////////////
public function store( Request $request){
    $validator=Validator::make($request->all(),[
        'types'=>'required|string|max:10'
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

            $safetype=safetype::create([
                'types'=>$request->types,

            ]);
            // $bartype= new bartype();
            // $bartype->types= $request->input('types');
            // $bartype->save();
            return response()->json([
                'status'=>200,
                'message'=>'bartype Added Successfully.'
            ]);
        }

   }
   ///////////////////////////// end store new country//////////////////////////////

         ///////////////////////////// edit country//////////////////////////////
public function edit($id){
 
    $safetype=safetype::findOrfail($id);
  if($safetype){
      return response()->json([
          'status'=>200,
          'message'=>'safetype Added Successfully.',
          'safetype'=>$safetype,
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
                'types'=>'required|string|max:10'
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
                    $safetype=safetype::findOrfail($id);
                    if($safetype){
                        $safetype->types= $request->input('types');
                        $safetype->save();
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

            ///////////////////////end update////////////////////
            public function delete($id){
                $safetype=safetype::findOrfail($id);
                if($safetype){
                  $safe=safe::where('safetype_id',$id)->count();
                  if($safe==0){
                    $safetype->delete();
                    return response()->json([
                        'status'=>200,
                        'message'=>'deleted.'
                    ]);
                  }else{
                      return response()->json([
                          'status'=>404,
                          'errors'=>'type belong to safe.'
                      ]);  
    
    
                  }
                }
    
         }
         /////////////////////end delete //////////////////////
     public function search( Request $request){
        $keyword=$request->keyword;
        $safetype=safetype::where('types','like',"%$keyword%")->get();
      
        return response()->json( $safetype);

}


       /////////////////end search///////////////////

}
