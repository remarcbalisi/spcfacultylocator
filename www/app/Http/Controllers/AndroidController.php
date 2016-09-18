<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//models
use App\User;
use App\Location;

use Auth;

class AndroidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($device_id)
    {
        $user = User::where(['device_id'=>$device_id])->first();
        $token = csrf_token();

        if($user){
            return response()->json(['status'=>'OK',
                                    'token'=>$token,
                                    'device_id'=>$device_id,
                                    'user'=>$user,
                                    'user_type'=>'faculty'
                                ]);
        }

        return response()->json(['status'=>'OK',
                                'token'=>$token,
                                'device_id'=>$device_id,
                                'user'=>$user,
                                'user_type'=>'student'
                            ]);
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $device_id, $latitude, $longitude)
    {
        $user = User::where(['device_id'=>$device_id])->first();

        if( $user->location_id ){
            $location = Location::where(['id'=>$user->location_id])->first();
            $location->latitude = $latitude;
            $location->longitude = $longitude;
            $location->save();
        }

        else{
            $location = new Location;

            $location->latitude = $latitude;
            $location->longitude = $longitude;
            $location->save();

            $user->location_id = $location->id;
            $user->save();
        }

        $user->status = 'online';
        $user->save();

        return response()->json(['status'=>'OK', 'message'=>'Successfully updated location']);
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

    public function login($username, $password)
    {
        Auth::attempt( ['username'=>$username, 'password'=>$password] );
        $user = Auth::user();
        if( $user ){
            $online_faculties = User::where(["status"=>"online"])->get();
            return response()->json(['status'=>'OK', 'user'=>$user, 'online_faculties'=>$online_faculties]);
        }

        else{
            return response()->json(['status'=>'FAILED', 'message'=>'Invalid username or password']);
        }
    }

    public function locate($id_number){
        $user = User::where(["id_number"=>$id_number])->first();
        $location = Location::where(["id"=>$user->location_id])->first();

        return response()->json(['status'=>'OK', 'location'=>$location]);
    }

    public function logout($device_id){
        $user = User::where(["device_id"=>$device_id])->first();
        $user->status = "offline";
        $user->save();

        return response()->json(["status"=>"OK", "message"=>"Successfully logged out"]);
    }
}
