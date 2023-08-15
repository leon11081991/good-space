<?php

namespace App\Http\Controllers;


//use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        // * 顯示所有資料在前台
        //dd(Listing::all());
        //dd(Auth::user());
        //dd(Auth::check());

        return inertia('Index/Index',
        [
            'message'=> 'Hello Laravel'
        ]
    );
    }

    public function show()
    {
        return inertia('Index/Show');
    }
}
