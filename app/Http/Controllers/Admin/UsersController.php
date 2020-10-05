<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Gate;
use Illuminate\Http\Request;

use DataTables;
use Redirect,Response;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    if ($request->ajax()) {
    $data = User::latest()->get();
    return Datatables::of($data)
    ->addIndexColumn()
    ->addColumn('action', function($row){
    
    $action = '<a class="btn btn-info" id="show-user" data-toggle="modal" data-id='.$row->id.'>Show</a>
    <a class="btn btn-success" id="edit-user" data-toggle="modal" data-id='.$row->id.'>Edit </a>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <a id="delete-user" data-id='.$row->id.' class="btn btn-danger delete-user">Delete</a>';
    
    return $action;
    
    })
    ->rawColumns(['action'])
    ->make(true);
    }
    
    return view('users');
   
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
    
    $r=$request->validate([
    'name' => 'required',
    'email' => 'required',
    
    ]);
    
    $uId = $request->user_id;
    $const_pasword='password';
     User::updateOrCreate(['id' => $uId],['name' => $request->name, 'email' => $request->email,'password'=>$const_pasword]);
    if(empty($request->user_id))
    $msg = 'User created successfully.';
    else
    $msg = 'User data is updated successfully';
    return redirect()->route('admin.users.index')->with('success',$msg);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
$where = array('id' => $id);
$user = User::where($where)->first();
return Response::json($user);
//return view('users.show',compact('user'));
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $id)
    {
        // if(Gate::denies('edit-users')){
        //     return redirect(route('admin.users.index'));
        // }

    //    $roles = Role::all();
       
    //    return view('admin.users.edit')->with([
    //        'user'=>$id,
    //        'roles'=>$roles
    //    ]);
       $where = array('id' => $id);
$user = User::where($where)->first();
info($user);
return Response::json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
      

        $user->name=$request->name;
        $user->email=$request->email;       
        $user->save();
       

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)

{
    $user = User::where('id',$id)->delete();
    return Response::json($user);
    //return redirect()->route('users.index');
    }

    }

