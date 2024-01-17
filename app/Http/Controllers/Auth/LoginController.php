<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\UserLoggedIn;
use App\Events\UserLoggedOut;
use App\Models\User;
use Hash;
use Mail;
use DB;
use Str;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function register_page(){
       return view('register');
    }

    public function register_form(Request $request){
        $input = $request->all();

        $request->validate([
            'name' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $input['name'];
        $user->mobile_no = $input['mobile_no'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $data = $user->save();
        if($data){

            Mail::send('email.welcome', ['users' => $user->name], function($message) use($request){
                $message->to($request->email);
                $message->subject('Welcome to SYSMATECH');
            });
            
             return redirect('/');
        }else{
            return back()->withErrors(['register' => 'Something went wrong.']);
        }
     

    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($request->only('email','password'))){
            $user = Auth::user()->createToken('web-token')->plainTextToken;
            event(new UserLoggedIn($user));

            return redirect('dashboard')->withCookie('web_token', $user);
        } else {
            return back()->withErrors(['login' => 'Invalid credentials']);
        }
    } 


    public function logout(Request $request)
    {
        $user = Auth::user();
        Auth::logout();
        event(new UserLoggedOut($user));
        return redirect('/');
    }

    public function forgotpasswordForm(){
        return view('forgetPassword');
    }

    public function submitforgotpasswordForm(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

        Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function resetpasswordForm($token){
        return view('resetpassword', ['token' => $token]);
    }

    public function submitresetpasswordForm(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
                            ->where([
                              'email' => $request->email, 
                              'token' => $request->token
                            ])
                            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();

        return redirect('/')->with('message', 'Your password has been changed!');
    }
}
