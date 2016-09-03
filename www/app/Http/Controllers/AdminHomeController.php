<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Hash;

use Auth;

//model
use App\User;
use App\Department;
use App\Notification;
use App\RequestTable;

class AdminHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::get();
        $notifications = Notification::where(['user_id'=>Auth::user()->id])->get();
        $pending_requests = RequestTable::where(['is_granted'=>false])->get();
        return view('admin.home')
                ->with(['pageTitle'=>'Admin Home | ' . SITE_NAME,
                        'user_count'=>$user->count(),
                        'users'=> User::get(),
                        'notifications'=>$notifications,
                        'pending_requests'=>$pending_requests
                    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_student')
                ->with(['pageTitle'=>'Admin Add User | ' . SITE_NAME,
                        'departments'=> Department::get()
                    ]);
    }

    public function create_faculty()
    {
        return view('admin.add_faculty')
                ->with(['pageTitle'=>'Admin Add User | ' . SITE_NAME,
                        'departments'=> Department::get()
                    ]);
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
        $user->is_activated = true;
        $user->save();

        $departments = Department::get();
        return redirect()->back()
                    ->with('info', 'Successfully added ' . $user->name);
    }

    public function store_faculty(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|unique:user|max:255',
            'email' => 'required|unique:user|max:255',
            'password' => 'required',
            'department' => 'required',
            'type' => 'required',
            'device_id' => 'required|unique:user'
        ]);

        $department = Department::where('id', $request->input('department') )->first();
        $user = new User;

        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->password = Hash::make( $request->input('password') );
        $user->department_id = $department->id;
        $user->email = $request->input('email');
        $user->user_type = $request->input('type');
        $user->device_id = $request->input('device_id');
        $user->save();

        $departments = Department::get();
        return redirect()->back()
                    ->with('info', 'Successfully added ' . $user->name);
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
    public function edit($auth_username, $id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.edit_student')
                ->with(['pageTitle'=>'Admin Edit User | ' . SITE_NAME,
                        'departments'=> Department::get(),
                        'user'=>$user
                    ]);
    }

    public function edit_faculty($auth_username, $id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.edit_faculty')
                ->with(['pageTitle'=>'Admin Edit User | ' . SITE_NAME,
                        'departments'=> Department::get(),
                        'user'=>$user
                    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $auth_username, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|unique:user,username,'.$id.'|max:255',
            'email' => 'required|unique:user,email,'.$id.'|max:255',
            'department' => 'required',
            'type' => 'required'
        ]);

        $user = User::where('id', $id)->first();
        $department = Department::where('id', $request->input('department'))->first();

        if( $request->input('password') ){
            $user->password = $request->input('password');
        }

        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->department_id = $department->id;
        $user->email = $request->input('email');
        $user->user_type = $request->input('type');
        $user->save();

        return redirect()->back()
                    ->with('info', 'Successfully updated ' . $user->name);
    }

    public function update_faculty(Request $request, $auth_username, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|unique:user,username,'.$id.'|max:255',
            'email' => 'required|unique:user,email,'.$id.'|max:255',
            'department' => 'required',
            'type' => 'required',
            'device_id' => 'required|unique:user,device_id,'.$id.'|max:70',
        ]);

        $user = User::where('id', $id)->first();
        $department = Department::where('id', $request->input('department'))->first();

        if( $request->input('password') ){
            $user->password = $request->input('password');
        }

        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->department_id = $department->id;
        $user->email = $request->input('email');
        $user->user_type = $request->input('type');
        $user->device_id = $request->input('device_id');
        $user->save();

        return redirect()->back()
                    ->with('info', 'Successfully updated ' . $user->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($auth_username, $id)
    {
        $user = User::where('id', $id)->first();
        $name = $user->name;
        $user->delete();
        return redirect()->back()
                    ->with('info', 'Successfully deleted ' . $name);
    }
}
