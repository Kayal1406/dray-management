<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\shipment;
use Session;
use Validator;
use LaravelGmail;
use Webklex\IMAP\Facades\Client;
use Excel;
use DB;
use Flash;
use App\comments;
use App\User;
use Auth;
use App\Notifications\CommentsNotifications;

class ShipmentController extends Controller
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
    public function index(){
        return view('addshipment');
    }

    //List comments
    public function listcomments(Request $request){
        $shipment_id=$request->input('shipment_id');
        $count=$request->input('count');
        $id=Auth::id();
        if($count>0)
            DB::update('update notification SET `user_id`= CONCAT(user_id,",'.$id.'") where shipment_id = ?', [$shipment_id]);
        $comments=Comments::leftjoin('users','users.id','=','comments.user_id')->select("comments.*","users.name")->where('comments.shipment_id',$shipment_id)->orderby('comments.created_at','DESC')->get();
        return response()->json([
            'data' => $comments
        ]);
    }

    //Delete Shipment
     public function deleteshipment(Request $request){
        $id=$request->input('shipment_id');
        $shipment=shipment::find($id);
        $shipment->active=0;
        //Delte comment for particular shipment
        Comments::where('shipment_id','=',$id)->delete();
        if($shipment->save()){
            //return "success";
            $request->session()->flash('success', 'Shipment deleted successfully!');
            return response()->json([
                'success' => 'Shipment deleted successfully!'
            ]);
        }
        else{
            $request->session()->flash('error', 'Shipment deleted error!');
            return response()->json([
                'error' => 'Shipment deleted error!'
            ]);
        }
    }

    //Add single shipment
    public function addshipment(Request $request){
        $validator = Validator::make(
            [
                'customer' => $request->input('customer'),
                'fileno' => $request->input('fileno')
            ],
            [
                'customer' => 'required',
                'fileno' => 'required'
            ]
        );

        if ($validator->fails())
        {
            return back()->with('error',$validator->messages());
        }
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } 
        $shipment=new Shipment();
        $shipment->customer=$request->input('customer');
        $shipment->file=$request->input('fileno');
        $shipment->ff=$request->input('ff');
        $shipment->shipline=$request->input('shipline');
        $shipment->contnr=$request->input('contnr');
        $shipment->last_del=$request->input('lastdel');
        $shipment->pier_co=$request->input('pierco');
        $shipment->doc_co=$request->input('docco');
        $shipment->rep=$request->input('rep');
        $shipment->items=$request->input('items');
        $shipment->shpd=$request->input('shpd');
        $shipment->line=$request->input('line');
        $shipment->cases=$request->input('cases');
        $shipment->save();
        return redirect('/home')->with('success', 'Shipment Added successfully!');
    }

    //Upload Shipment
     public function uploadshipment(Request $request)
    {
        if (!$request->file('shipmentupload')->isValid()) {
            return redirect('/home')->with('error',"Sorry, there is no file attached on the form!");
            return redirect()->route('home');
        }

        $file = $request->file('shipmentupload');
        $format=array('xls','xlsx');
        if (!in_array($file->getClientOriginalExtension(), $format)) {
            return redirect('/home')->with('error',"Sorry, please use .xls or .xlsx extension!");
            return redirect()->route('home');
        }
        $week='';
        //return($request->all());
        if(($request->update==0)){
            if($file){
                $reader=Excel::load($file->getRealPath());
                    //Take Header to check the week
                    $firstrow = $reader->first()->toArray();
                    $week=array_keys($firstrow)[1];
                    $pos = strpos($week, "to");
                    $week=(substr($week, 0, $pos));
                    $shipment=Shipment::where('week',$week)->where('active','=',1)->get()->count();
                    //print_r($shipment);
            }
            if($shipment>0){
                return response()->json([
                    'shipment' => $shipment
                ]);
            }
        }
        elseif($request->update==1){
             $reader=Excel::load($file->getRealPath());
            //Take Header to check the week
            $firstrow = $reader->first()->toArray();
            $week=array_keys($firstrow)[1];
            $pos = strpos($week, "to");
            $week=(substr($week, 0, $pos));
            //$shipment=Shipment::where('week',$week)->get()->count();
            $shipment=Shipment::where('week',$week)->select('id')->get();
            foreach($shipment as $id){
                Comments::where('shipment_id',$id->id)->delete();
                $flight = Shipment::find($id->id);
                $flight->active = 0;
                $flight->save();
            }
        }

        ini_set('max_execution_time',300);
        \Config::set('excel.import.startRow', 2);
        ini_set('max_execution_time',300);
        //$file = $request->file('shipmentupload');
        if($file){
            $path = $file->getRealPath();
            $data = Excel::load($path, function($reader) {
                $reader->ignoreEmpty(true);
            })->get();
            //return $data;
            if(!empty($data) && $data->count()){
                DB::beginTransaction();
                    try {
                        $is_row_empty = true;
                        foreach ($data as $key => $value) {
                                if($value !== '' &&  $value !== NULL) {
                                    $is_row_empty = true; //detect not empty row
                                    foreach ($value as $val) {
                                        if($val !== '' &&  $val !== NULL) {
                                            $is_row_empty = false; //detect empty row
                                            break;
                                        }
                                    }
                                    if(!$is_row_empty){
                                        $shipment=new Shipment();
                                        $shipment->customer=$value->customer;
                                        $shipment->file=$value->file;
                                        $shipment->ff=$value->ff;
                                        $shipment->shipline=$value->ship_line;
                                        $shipment->contnr=$value->contnr;
                                        $shipment->last_del=$value->last_del;
                                        $shipment->pier_co=$value->pier_co;
                                        $shipment->doc_co=$value->doc_co;
                                        $shipment->rep=$value->rep;
                                        $shipment->items=$value->items;
                                        $shipment->shpd=$value->out_of;
                                        $shipment->line=$value->line;
                                        $shipment->cases=$value->cases;
                                        $shipment->week=$week;
                                        $shipment->save();
                                    }
                                }
                        }
                        DB::commit();
                        $request->session()->flash('success', 'Shipment success!');
                        return response()->json([
                            'success' => 'Shipment success!'
                        ]);
                        return redirect('/home')->with('success',"Shipment success!");
                    }
                    catch (\Exception $e) {
                        DB::rollback();
                        $request->session()->flash('success', 'Something wrong in the excel format!');
                        return response()->json([
                            'success' => 'Something wrong in the excel format!'
                        ]);
                        return redirect('/home')->with('error',"Something wrong in the excel format!");
                    }
            }
        }        
    }

    /* Doc recipet upload function*/
    public function docUpload(Request $request){
        $shipments=shipment::find($request->input('shipment-id'));
        $shipment_id= $request->input('shipment-id');
        if($request->hasFile('receipt')) {
            $file = $request->file('receipt');
            //you also need to keep file extension as well
            $name = $file->getClientOriginalName();

            //moving file to public folder
            if($file->move(public_path().'/uploads/docreceipt/'.$shipment_id.'/', $name)){
                $shipments->attachments=$file->getClientOriginalName();
                $shipments->save();
                $request->session()->flash('success', 'Doc receipt Uploaded successfully!');
                return response()->json([
                    'success' => 'Doc receipt Uploaded successfully!'
                ]);
            }
            else{
                $request->session()->flash('error', 'Doc receipt Uploaded error!');
                return response()->json([
                    'error' => 'Doc receipt Uploaded error!'
                ]);
            }
        }
    }
    
    public function filemanager(){
        $shipment=shipment::whereNotNull('attachments')->select('id','file','attachments')->orderBy('updated_at', 'desc')->get();
        return view('compose',['shipments' => $shipment]);
    }

    //Edit
    public function edit($id){
        $shipment=shipment::find($id);
        return view ('edit',compact('shipment'));
    }

    //update shipment
    public function update(Request $request,$id){
        
        $validator = Validator::make(
            [
                'customer' => $request->input('customer'),
                'fileno' => $request->input('fileno')
            ],
            [
                'customer' => 'required',
                'fileno' => 'required'
            ]
        );

        if ($validator->fails())
        {
            return back()->with('error',$validator->messages());
        }
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }        

        $shipment=shipment::find($id);
        $shipment->customer=$request->input('customer');
        $shipment->file=$request->input('fileno');
        $shipment->ff=$request->input('ff');
        $shipment->shipline=$request->input('shipline');
        $shipment->contnr=$request->input('contnr');
        $shipment->last_del=$request->input('lastdel');
        $shipment->pier_co=$request->input('pierco');
        $shipment->doc_co=$request->input('docco');
        $shipment->rep=$request->input('rep');
        $shipment->items=$request->input('items');
        $shipment->shpd=$request->input('shpd');
        $shipment->line=$request->input('line');
        $shipment->cases=$request->input('cases');
        //echo "<pre>";print_r($request->input());exit;
        if($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            //you also need to keep file extension as well
            $name = $file->getClientOriginalName();

            //moving file to public folder
            $file->move(public_path().'/uploads/docreceipt/'.$id.'/', $name);
            $shipment->attachments=$file->getClientOriginalName();
            //echo "hai";exit;
        }
        $shipment->save();
        return redirect('/home')->with('success', 'Shipment updated successfully!');
    }
}
