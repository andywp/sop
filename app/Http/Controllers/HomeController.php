<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin/dashboard');
    }
    public function Login(Request $request){
        $config = [
            'client_id' => env('sso_key_public'),
            'client_secret' => env('sso_key_secret'),
            'redirect' => env('sso_url'),
        ];
        return view('admin/login',['config' => $config ]);
       
    }

    public function Auth(Request $request){
        echo '<pre>';
        print_r($request->all());
        echo '</pre>';
        if($request->id !=''){
            $user = DB::table('users')->where('sso_id',$request->id)->first();
            if(!$user){
                DB::table('users')->insert(
                    [
                        'sso_id'         => $request->id,
                        'name'           => $request->name,
                        'username'       => $request->username,
                        'email'          => $request->email,
                        'secondary_email'=> $request->secondary_email,
                        'photo'          => $request->picture,
                        'division'       => $request->division,
                        'password'       => Hash::make($request->id),
                        'secret_key'     => $request->secret_key,
                        'status'         => $request->status,
                        
                    ]
                );
            }else{

                DB::table('users')
                ->where('sso_id', $request->id)
                ->update(
                    [
                        'division'       => $request->division,
                        'secret_key'     => $request->secret_key,
                        'status'         => $request->status,

                    ]
                );
            }

            if (Auth::attempt(['email' => $request->email, 'password' => $request->id, 'status' => 1])) {
                // The user is active, not suspended, and exists.
                return redirect()->intended('admin');
            }else{
                return redirect()->intended('login');
            }






        }else{

            return redirect()->intended('login');
        }




    }


}