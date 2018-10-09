<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use App\User;
use Auth;
use App\Notifications\CommentsNotifications;
use App\notification;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try{
            $comments=new Comments();
            $comments->user_id=$request->input('user_id');
            $comments->shipment_id=$request->input('shipment_id');
            $comments->comments=$request->input('comments');
            if($comments->save()){
                $notification=new notification();
                $notification->user_id=Auth::id();
                $notification->comment_id=$comments->id;
                $notification->shipment_id=$request->input('shipment_id');
                $notification->save();
            }
            $request->session()->flash('success', 'Comment Added successfully!');
            return response()->json([
                'success' => 'Comment Added successfully!'
            ]);
        }
        catch(\Exception $e){
            // do task when error
            echo $e->getMessage();
            $request->session()->flash('error', 'Data too long.Comment Added failed!');
            return response()->json([
                'error' => 'Comment Added failed!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
