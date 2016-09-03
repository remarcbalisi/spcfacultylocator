<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Hash;

//controllers
use App\Http\Controllers\Auth\RegisterController;

//models
use App\User;
use App\Department;
use App\RequestTable;
use App\Notification;

//events
use App\Events\RequestEvent;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index')->with('pageTitle', 'Home | '.SITE_NAME);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::get();
        return view('user.create')
            ->with(['pageTitle'=>'Register | '.SITE_NAME, 'departments'=>$departments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|unique:user|max:255',
            'email' => 'required|unique:user|max:255',
            'password' => 'required',
            'department' => 'required',
            'type' => 'required'
        ]);

        $department = Department::where('id', $request->input('department') )->first();
        $user = new User;

        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->password = Hash::make( $request->input('password') );
        $user->department_id = $department->id;
        $user->email = $request->input('email');
        $user->user_type = $request->input('type');
        $user->save();

        $req = new RequestTable;
        $req->id = $user->username;
        $req->title = 'Registration request from ' . $user->name;
        $req->body = 'Registration request from ' . $user->name . ' as ' . $user->user_type;
        $req->save();

        $admin_users = User::where(['user_type'=>'admin'])->get();
        $notification_title = 'request';
        $notification_body = 'Registration request from ' . $user->name . ' as ' . $user->user_type;
        foreach($admin_users as $au){
            $notification = new Notification;
            $notification->title = $notification_title;
            $notification->body = $notification_body;
            $notification->user_id = $au->id;
            $notification->save();
        }

        event(new RequestEvent($req));

        $departments = Department::get();
        return redirect()->back()
                    ->with('success', 'Successfully sent request');
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
