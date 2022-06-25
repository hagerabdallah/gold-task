<?php

namespace App\Http\Controllers\admin;

use App\Models\weight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\goldbar;
use Illuminate\Support\Facades\Validator;

class weightcontroller extends Controller
{
    public function fetchweight(){
        $weights=weight::get();
        return response()->json([
          'weights'=>$weights,
      ]); 
  }
///////////////end fetch/////////////////
public function create(){

  return view('dashboard.admin.weight');
}
/////////////////////////////store new country//////////////////////////////
public function store( Request $request){
    $validator=Validator::make($request->all(),[
        'weight'=>'required|string|max:10'
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

            $safetype=weight::create([
                'weight'=>$request->weight,

            ]);
            // $bartype= new bartype();
            // $bartype->types= $request->input('types');
            // $bartype->save();
            return response()->json([
                'status'=>200,
                'message'=>'weight Added Successfully.'
            ]);
        }

   }
           ///////////////////////////// edit country//////////////////////////////
public function edit($id){
 
    $weight=weight::findOrfail($id);
  if($weight){
      return response()->json([
          'status'=>200,
          'message'=>'safetype Added Successfully.',
          'weight'=>$weight,
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
                'weight'=>'required|string|max:10'
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
                    $weight=weight::findOrfail($id);
                    if($weight){
                        $weight->weight= $request->input('weight');
                        $weight->save();
                        return response()->json([
                            'status'=>200,
                            'message'=>'weight updated Successfully.'
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
                  $weight=weight::findOrfail($id);
                  if($weight){
                    $goldbar=goldbar::where('weight_id',$id)->count();
                    if($goldbar==0){
                      $weight->delete();
                      return response()->json([
                          'status'=>200,
                          'message'=>'deleted.'
                      ]);
                    }else{
                        return response()->json([
                            'status'=>404,
                            'errors'=>'goldbar has this weight.'
                        ]);  


                    }
                  }

           }
           /////////////////////end delete //////////////////////
     public function search( Request $request){
        $keyword=$request->keyword;
        $weight=weight::where('weight','like',"%$keyword%")->get();
      
        return response()->json( $weight);

}


       /////////////////end search///////////////////

}
