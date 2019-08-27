<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Command;
use App\Dish;
use App\CommandPlat;



class CashierController extends Controller
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


        $commands = command::where('status', 'Finished' )->get();
        $dishes = Dish::all();
        $orders = CommandPlat::all();



         return view('cashier')->with('commands',$commands)->with('dishes',$dishes)->with('orders',$orders);
     }

     

}
