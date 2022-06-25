<?php

namespace App\Http\Controllers\admin;

use App\Models\safe;
use App\Models\country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class countrycontroller extends Controller
{    //get create form
    public function create(){

        return view('dashboard.admin.country');
    }
    /////////////////////fetch country from database//////////////////////////
    public function FetchCountry(){
         $country=country::get();
            return response()->json([
                'country'=>$country,
            ]); 
    }
/////////////////////////////store new country//////////////////////////////
   public function store( Request $request){
    $validator=Validator::make($request->all(),[
        'CountryName'=>'required|string|max:10'
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
            $country = new country;
            $country->CountryName= $request->input('CountryName');
            $country->save();
            return response()->json([
                'status'=>200,
                'message'=>'Country Added Successfully.'
            ]);
        }

   }
   ///////////////////////////// end store new country//////////////////////////////
 

      ///////////////////////////// edit country//////////////////////////////
public function edit($id){
 
  $countries=country::findOrfail($id);
if($countries){
    return response()->json([
        'status'=>200,
        'message'=>'Country Added Successfully.',
        'countries'=>$countries,
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
                'CountryName'=>'required|string|max:10'
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
                    $country=country::findOrfail($id);
                    if($country){
                        $country->CountryName= $request->input('CountryName');
                        $country->save();
                        return response()->json([
                            'status'=>200,
                            'message'=>'Country updated Successfully.'
                        ]);
                    }
                    else
            {
                return response()->json([
                    'status'=>404,
                    'errors'=>'No country Found.'
                ]);
            }

                }
        
           }


           ///////////////////////end update////////////////////
           public function delete($id){
            $country=country::findOrfail($id);
            if($country){
              $safe=safe::where('country_id',$id)->count();
              if($safe==0){
                $country->delete();
                return response()->json([
                    'status'=>200,
                    'message'=>'deleted.'
                ]);
              }else{
                  return response()->json([
                      'status'=>404,
                      'errors'=>'country has this safes.'
                  ]);  


              }
            }

     }
            ///////////////////end delete////////////////////////
     public function search( Request $request){
    $keyword=$request->keyword;
    $country=country::where('CountryName','like',"%$keyword%")->get();
  
    return response()->json( $country);
               }
             /////////////////end search////////////////////////  

}



   


