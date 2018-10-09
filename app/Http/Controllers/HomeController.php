<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\shipment;
use Auth;
use App\notification;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$shipments=shipment::leftjoin('notification','notification.shipment_id','=','shipments.id')->select('notification.user_id','shipments.*')->where('shipments.active',1)->orderBy('shipments.created_at','desc')->get();*/
        $shipments=shipment::select('shipments.*')->where('shipments.active',1)->orderBy('shipments.created_at','ASC')->get();
        $id = Auth::id();
        $shipment=$shipments->map(function($item,$key){
            $id = Auth::id();
            $notification=DB::table("notification")
                           ->select('shipment_id as notify')
                           ->whereRaw('NOT FIND_IN_SET('.$id.',user_id)')
                          ->where('shipment_id','=',$item['id'])
                          ->count();
            $item['notify']=$notification;
            return $item;
        });
        return view('home', ['shipments' => $shipment,'userid'=>$id]);
    }
}
