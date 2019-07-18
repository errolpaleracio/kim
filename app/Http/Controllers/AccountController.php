<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use App\Branch;
use App\User as AppUser;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ShowChangeUsernameView()
    {
        return view('account.changeusername');
    }

    public function ChangeUsername(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username'
        ]);
        $user = User::find(Auth::user()->id);

        $user->username = $request->username;
        $user->save();

        $request->session()->flash('message', 'Username successfully changed');
        return redirect()->back();
    }
    
    public function ShowChangePasswordView()
    {
        return view('account.changepassword');
    }

    public function ChangePassword(Request $request)
    {

        $user = User::find(Auth::user()->id);
        $this->validate($request, [
            'old_password' => [
                'required',
                function($attr, $value, $fail) use ($user){
                    if(!Hash::check($value, $user->password))
                        $fail('Old Password is invalid');
                }
            ],
            'new_password' => 'required',
            'repeat_password' => 'required|same:new_password'
        ]);
        $user->password = bcrypt($request->new_password);
        $user->save();
        $request->session()->flash('message', 'Password successfully changed');
        return redirect()->back(); 
    }

    public function ShowCreateAccountForm()
    {
        $branches = Branch::all();

        return view('account.createaccount')->with('branches', $branches);
    }

    public function CreateAccount(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'repeat_password' => 'required|same:password'
        ]);

        $user = new AppUser();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);    
        $user->branch_id = $request->branch_id;

        $user->save();
        $request->session()->flash('message', 'Account successfully created');
        return redirect()->back();
    }

    public function ShowAllAccounts()
    {
        $users = User::whereNotNull('branch_id')->get();
        
        return view('account.showallaccounts')->with('users', $users);
    }
}
