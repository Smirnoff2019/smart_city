<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use DB;

class MapController extends Controller
{
    public function index()
    {
        $point = DB::table('points')->get()->all();
        return view('Admin.maps.index', ['point' => $point]);
    }

    public function show()
    {
        //
    }

}
