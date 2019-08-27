<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Command;
use App\Dish;
use App\CommandPlat;
use App\User;
use App\Table;
use App\Feedback;



class AdminController extends Controller
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

        $id = Auth::user()->id;


        $commands = command::where('id_client', $id )->get();
        $dishes = Dish::all();
        $orders = CommandPlat::all();



         return view('admin')->with('commands',$commands)->with('dishes',$dishes)->with('orders',$orders);
     }

     public function indexDishes()
     {
        $totalPrice = 0;

        $id = Auth::user()->id;


        $commands = command::where('id_client', $id )->get();
        $dishes = Dish::all();
        $orders = CommandPlat::all();



         return view('admindishes')->with('commands',$commands)->with('dishes',$dishes)->with('orders',$orders);
     }
     

     public function indexTables()
     {
        $id = Auth::user()->id;

        $tables = Table::all();


         return view('admintables')->with('tables',$tables);
     }

     
     public function indexReviews()
     {
        $feedbacks = feedback::all();
        return view('adminreviews')->with('feedbacks',$feedbacks);
     }

     public function indexUsers()
     {
        $totalPrice = 0;

        $users = User::all();

         return view('adminusers')->with('users',$users);
     }



}
