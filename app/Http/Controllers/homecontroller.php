<?php

namespace App\Http\Controllers;

use App\Models\safe;
use App\Models\weight;
use App\Models\country;
use App\Models\goldbar;
use App\Models\safetype;
use Illuminate\Http\Request;

class homecontroller extends Controller
{
    public function home(){

        $country=country::count();
        $safe=safe::count();
        $safetype=safetype::count();
        $goldbar=goldbar::count();
        $weight=weight::count();

        return view('dashboard.admin.home',compact('country','safe','safetype','goldbar','weight'));
    }
}
