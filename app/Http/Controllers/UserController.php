<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests;
use App\User;
use App\Role;
use Session;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('users.index')->withUsers($users);
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
        //Save new user
        if($request->password==$request->password_confirmation)
        {
            $this->validate($request,array(
                    'name'=>'required',
                    'email'=>'email',
                    'password'=>'required',
                    'password_confirmation'=>'required'
                    ));
        
                $user=new User;
                $user->name=$request->name;
                $user->email=$request->email;
                $user->password=Hash::make($request->password);
        
                $user->save();

                $user->roles()->attach(Role::where('name','Reception')->first());
        
                Session::flash('success','New User Created');
        
                return redirect()->route('users.index');
        }
        else
        {
            Session::flash('unsuccess','Unsuccessful!! Retry');
            return redirect()->route('users.index');
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
        $user=User::find($id);
        return view('users.edit')->withUser($user);
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
        if($request->password==$request->password_confirmation)
        {
            $this->validate($request,array(
                    'name'=>'required',
                    'email'=>'email',
                    'password'=>'required',
                    'password_confirmation'=>'required'
                    ));
        
                $user=User::find($id);
                $user->name=$request->name;
                $user->email=$request->email;
                $user->password=Hash::make($request->password);
        
                $user->save();
        
                Session::flash('success','User Edited Successfully');
        
                return redirect()->route('users.index');
        }
        else
        {
            Session::flash('unsuccess','Unsuccessful!! Retry');
            return redirect()->route('users.index');
        }
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
