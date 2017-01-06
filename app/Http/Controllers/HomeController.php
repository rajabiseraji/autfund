<?php




namespace App\Http\Controllers;
use \App\User;
use Auth;
use Illuminate\Http\Request;



class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/main');
    }



    function adminPanel(){
        $users = User::all();

        return view('adminPanel', compact('users'));
    }

    function userDelete(Request $r){
        $userId = $r->userId;
        // return $userId. " ". Auth::id();
        if (Auth::id() == $userId) {
            Auth::logout();
        }
        User::destroy($userId);

    }


    function userAdd(Request $request){
        $request->merge(['password' => Hash::make($request->password)]);
        $user = User::create($request->all());
        return redirect('/admin/users');
    }
}
