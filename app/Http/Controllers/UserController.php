<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;


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
      * Show the application dashboard.
      *
      * @return \Illuminate\Contracts\Support\Renderable
      */
     public function index()
     {
        $totalPrice = 0;

        $idd = Auth::user()->id;


        $commands = command::where('id_client', $idd )->get();
        $dishes = Dish::all();
        $orders = CommandPlat::all();



         return view('adminUsers')->with('commands',$commands)->with('dishes',$dishes)->with('orders',$orders);
     }

     public function deleteuser($iddd)
     {
         try {
            $deleteuser = User::where('id', $iddd )->get()->first();
            $deleteuser = User::where('id', $iddd )->delete();
         } catch (Exception $th) {
            Debugbar::alert("catchy".$th);
         }

        // Redirect
         $users = User::all();

         return redirect()->to('adminusers')->with('users',$users);
     }

     public function updateuser(Request $request , $id)
     {
         try {
            $userr = new User;

            $userr = User::where('id', $id )->get()->first();
            $userr-> fname = $request -> fname ;
            $userr-> lname = $request -> lname ;
            $ty =  $request -> type ;
            Str::lower($ty);
            $userr-> user_type = $ty ;
            $userr->save();
         } catch (Exception $th) {
            Debugbar::alert("catchy".$th);
         }

        // Redirect
         $users = User::all();
         return redirect()->to('adminusers')->with('users',$users);
     }

}
