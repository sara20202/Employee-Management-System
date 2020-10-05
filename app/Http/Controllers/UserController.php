<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Image;

class UserController extends Controller
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('user', ['user' => Auth::user()]);
    }

    /**
     * @param Request $request
     * @return
     */
    public function update(Request $request)
    {
        // Get current user
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        // Validate the data submitted by user
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:225|'. Rule::unique('users')->ignore($user->id),
        ]);

        // if fails redirects back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }




        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            // var_dump($avatar);
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            
    		Image::make($avatar)->resize(300, 300)->save( public_path('//avatar/' . $filename ) );

    		
            $user->avatar = $filename;
            // dd($request);
        }

        // Fill user model
        $user->fill([
            'name' => $request->name,
            'email' => $request->email
        ]);






        // Save user to database
        $user->save();

        // Redirect to route
        return redirect()->route('user');
    }
}