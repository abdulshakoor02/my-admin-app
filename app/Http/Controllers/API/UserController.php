<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\user_demo;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('user_demo')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|string|max:255|unique:user_demo',
            'password' => 'required|max:20'
        ]);
        return user_demo::create([
            'username' => $request['username'],
            'password' => $request['password']
        ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = user_demo::findOrFail($id);

        $this->validate($request,[
            'username' => 'required|string|max:255|unique:user_demo,username,'.$user->id,
            'password' => 'required|max:20'
        ]);

        $user->update($request->all());

        // return $request->all();
        // return DB::table('user_demo')->where('id',$id)->update([
        //     'username'=> $request['username'],
        //     'password'=> $request['password']
        // ]);
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
        $user = user_demo::findOrFail($id);
        $user->delete();

        return ["message" =>"User deleted"];
    }
}
