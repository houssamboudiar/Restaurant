<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Auth;
use App\Dish;
use App\User;
use App\CommandPlat;
use App\Command;
use App\Table;
use PDF;


class OrderController extends Controller
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
    public function index()
    {
        // $totalPrice = 0 ;
        // $dishes = Dish::all();
        // return view('order')->with('dishes',$dishes)->with('totalPrice',$totalPrice);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dishes = Dish::all();
        $id = Auth::user()->id;
        $commands = command::where('id_client', $id )->get();
        $orders = CommandPlat::all();
        $tables = Table::where('status', 'Not reserved' )->get();

        //return view('order')->with('dishes',$dishes)->with('tables',$tables)->with('commands',$commands)->with('orders',$orders);
        return view('order')->with('commands',$commands)->with('orders',$orders)->with('tables',$tables)->with('dishes',$dishes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the data

        /*$this -> validate($request , array(
            'entree'=>'required',
            // 'principal'=>'required',
            // 'dessert'=>'required',
        ));*/
        // try {
        // Store it
            $totalPrice = 0;

            // First Order
            if ($request->entree == 'none') {
                Debugbar::alert('Do nothing ...');
                $firstOrder_id = Null;
            } else {
                # code...
                $firstOrder = new CommandPlat;
                $entreeDish = new Dish;
                $entreeDish = Dish::where('name', $request->entree )->first();
                $idplat = $entreeDish->id_plat;
                $dishPrice = $entreeDish->price;
                Debugbar::alert('entree price'.$dishPrice);
                $totalPrice = $totalPrice + $dishPrice;

                $firstOrder_id = CommandPlat::insertGetId([
                    "id_plat"=>$idplat,
                    "price"=>$dishPrice,
                    ]);
            }

            //Debugbar::alert('1 ' . $totalPrice);


            // // Second Order

            if ($request->principal == 'none') {
                Debugbar::alert('Do nothing ...');
                $secondOrder_id = Null;
            } else {
                # code...
                $secondOrder = new CommandPlat;
                $principDish = new Dish;
                $principDish = Dish::where('name', $request->principal )->first();

                $idplat = $principDish->id_plat;
                $dishPrice = $principDish->price;
                $secondOrder->id_plat = $idplat;
                $secondOrder->price = $dishPrice;
                Debugbar::alert('pr price'.$dishPrice);
                $totalPrice = $totalPrice + $dishPrice;
                $secondOrder_id = CommandPlat::insertGetId([
                    "id_plat"=>$idplat,
                    "price"=>$dishPrice,
                ]);
            }


            // // Third Order

            if ($request->dessert == 'none') {
                Debugbar::alert('Do nothing ...');
                $thirdOrder_id = Null;
            } else {
                # code...
                $thirdOrder = new CommandPlat;
                $dessertDish = new Dish;
                $dessertDish = Dish::where('name', $request->dessert )->first();

                $idplat = $dessertDish->id_plat;
                $dishPrice = $dessertDish->price;
                Debugbar::alert('dessert price'.$dishPrice);
                $totalPrice = $totalPrice + $dishPrice;
                $thirdOrder_id = CommandPlat::insertGetId([
                    "id_plat"=>$idplat,
                    "price"=>$dishPrice,
                ]);
            }

            // Command
            $mainCommand = new Command;
                // User
                $id = Auth::user()->id;
                // Table
                $id_table = $request->table;
                //Command Type
                $commandType = '';
                if ( $request->indoor  == 'Indoors') {
                    $commandType = 'Indoor';
                    $mainCommand = Command::insertGetId([
                        "id_client"=>$id,
                        "id_table"=>$id_table,
                        "entree"=>$firstOrder_id,
                        "plat"=>$secondOrder_id,
                        "apr"=>$thirdOrder_id,
                        "type"=>$commandType,
                        "price"=>$totalPrice,
                    ]);
                    $table = Table::find($id_table);
                    $table->status = 'Reserved';
                    $table->save();
                } else {
                    $commandType = 'Outdoor';
                    $mainCommand = Command::insertGetId([
                        "id_client"=>$id,
                        "entree"=>$firstOrder_id,
                        "plat"=>$secondOrder_id,
                        "apr"=>$thirdOrder_id,
                        "type"=>$commandType,
                        "price"=>$totalPrice,
                    ]);
                }

        // Session::flash('alert-danger', 'danger');
        // Session::flash('alert-warning', 'warning');
        // Session::flash('alert-success', 'success');
        // Session::flash('alert-info', 'info');


        // Redirect
        $dishes = Dish::all();
        $id = Auth::user()->id;
        $commands = command::where('id_client', $id )->get();
        $orders = CommandPlat::all();
        $tables = Table::where('status', 'Not reserved' )->get();

        //return view('order')->with('dishes',$dishes)->with('tables',$tables)->with('commands',$commands)->with('orders',$orders);

        return redirect()->to('client')->with('commands',$commands)->with('orders',$orders)->with('tables',$tables)->with('dishes',$dishes);

        // } catch (\Throwable $th) {
        //     $dishes = Dish::all();
        //     $id = Auth::user()->id;
        //     $commands = command::where('id_client', $id )->get();
        //     $orders = CommandPlat::all();
        //     $tables = Table::where('status', 'Not reserved' )->get();

        //     //return view('order')->with('dishes',$dishes)->with('tables',$tables)->with('commands',$commands)->with('orders',$orders);

        //     Debugbar::alert('Throwed exception'.$th);
        //     return redirect()->to('order')->with('commands',$commands)->with('orders',$orders)->with('tables',$tables)->with('dishes',$dishes);
        //     Session::flash('alert-warning', 'warning');
        // }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function validateCommands(Request $request, $id)
    {
        //
        try {
            $validateCommand = new Command;
            $validateCommand = DB::table('command')->find($id);
            $validateCommand = Command::where('id',  $id )->get()->first();
            $validateCommand->status = "Validated";
            $validateCommand->save();
        } catch (Exception $th) {
            Debugbar::alert("catchy".$th);
        }


        // Redirect
        $dishes = Dish::all();
        $id = Auth::user()->id;
        $commands = command::where('id_client', $id )->get();
        $orders = CommandPlat::all();
        $tables = Table::where('status', 'Not reserved' )->get();

        //return view('order')->with('dishes',$dishes)->with('tables',$tables)->with('commands',$commands)->with('orders',$orders);

        return redirect()->to('client')->with('commands',$commands)->with('orders',$orders)->with('tables',$tables)->with('dishes',$dishes);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function nextCommandStatus(Request $request, $id)
     {
         //
         try {
            $validateCommand = new Command;
            $validateCommand = DB::table('command')->find($id);
            $validateCommand = Command::where('id',  $id )->get()->first();
            if($validateCommand->status == 'Validated'){
                $validateCommand->status = 'On-going';
                $validateCommand->save();

            // Redirect
            $dishes = Dish::all();
            $id = Auth::user()->id;
            $commands = command::where('id_client', $id )->get();
            $orders = CommandPlat::all();
            $tables = Table::where('status', 'Not reserved' )->get();
    
            //return view('order')->with('dishes',$dishes)->with('tables',$tables)->with('commands',$commands)->with('orders',$orders);
    
            return redirect()->to('client')->with('commands',$commands)->with('orders',$orders)->with('tables',$tables)->with('dishes',$dishes);

                return;
            }

            if($validateCommand->status == 'On-going'){
                $validateCommand->status = 'Finished';
                $validateCommand->save();

                // Redirect
                $dishes = Dish::all();
                $id = Auth::user()->id;
                $commands = command::where('id_client', $id )->get();
                $orders = CommandPlat::all();
                $tables = Table::where('status', 'Not reserved' )->get();
        
                //return view('order')->with('dishes',$dishes)->with('tables',$tables)->with('commands',$commands)->with('orders',$orders);
        
                return redirect()->to('client')->with('commands',$commands)->with('orders',$orders)->with('tables',$tables)->with('dishes',$dishes);

                return;
            }

         } catch (Exception $th) {
             Debugbar::alert("catchy".$th);
         }
 
     }

     public function printPDF($id)
    {
       // This  $data array will be passed to our PDF blade

       $c = Command::where('id', $id )->get()->first();

        // Client
         //$client = User::where('id', $c->id_client )->get()->first();
         //$clientmail = $client -> email ;

        //  $datein = $c->created_at ;
        //  $dateout = $c->updated_at ;
        //  $table = $c->id_table ;
        $entree = CommandPlat::where('id_order', $c->entree )->get()->first();
        $entreedish = Dish::where('id_plat', $entree->id_plat )->get()->first();
        $plat = CommandPlat::where('id_order', $c->plat )->get()->first();
        $platdish = Dish::where('id_plat', $plat->id_plat )->get()->first();
        $dessert = CommandPlat::where('id_order', $c->apr )->get()->first();
        $dessertdish = Dish::where('id_plat', $dessert->id_plat )->get()->first();


        $data = [
           'Restaurant' => 'AZE Reastaurant' ,
           'Client' => User::where('id', $c->id_client )->get()->first()->email ,
           'Datein' => $c->created_at ,
           'Dateout' => $c->updated_at ,
           'Table' => $c->id_table ,

           'Entree' => $entreedish->name ,
           'EntreeQ' => $entree->quantity,
           'EntreeP' => $entree->price,

           'Plat' => $platdish->name,
           'PlatQ' => $plat->quantity,
           'PlatP' => $plat->price, 

           'Dessert' => $dessertdish->name,
           'DessertQ' => $dessert->quantity,
           'DessertP' => $dessert->price,

           'Total' => $c->price,     
        ];
        
        $pdf = PDF::loadView('pdf_view', $data);  
        return $pdf->download('medium.pdf');
    }


             /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
         try {
            Debugbar::alert("delete command ".$id);
            $deleteCommand = Command::where('id', $id )->get()->first();

            $type = Auth::user()->user_type;
            if($type == 'cashier'){
                $this->printPDF($deleteCommand);
            }

            $l1 = $deleteCommand->entree;
            $l2 = $deleteCommand->plat;
            $l3 = $deleteCommand->apr;
            $t1 = $deleteCommand->id_table;
            $ty = $deleteCommand->type;

            if ($ty == 'Indoor') {
                # code...
                $table = Table::find($t1);
                $table->status = 'Not reserved';
                $table->save();
            }

            $deleteCommand = Command::where('id', $id )->delete();
            //Delete Orders
            $deleteOrder1 = CommandPlat::where('id_order' ,$l1)->delete();
            $deleteOrder2 = CommandPlat::where( 'id_order' ,$l2)->delete();
            $deleteOrder3 = CommandPlat::where('id_order' ,$l3)->delete();
             //code...
         } catch (Exception $th) {
            Debugbar::alert("catchy".$th);
         }



         // Redirect
         $dishes = Dish::all();
         $id = Auth::user()->id;
         $commands = command::where('id_client', $id )->get();
         $orders = CommandPlat::all();
         $tables = Table::where('status', 'Not reserved' )->get();

         //return view('order')->with('dishes',$dishes)->with('tables',$tables)->with('commands',$commands)->with('orders',$orders);

         return redirect()->to('client')->with('commands',$commands)->with('orders',$orders)->with('tables',$tables)->with('dishes',$dishes);
     }

                  /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroyDish($id)
     {
         try {
            $deletedish = Dish::where('id_plat', $id )->get()->first();
            $deleteCommand = Dish::where('id_plat', $id )->delete();
         } catch (Exception $th) {
            Debugbar::alert("catchy".$th);
         }

        // Redirect
         $dishes = Dish::all();
         $id = Auth::user()->id;
         $commands = command::where('id_client', $id )->get();
         $orders = CommandPlat::all();
         $tables = Table::where('status', 'Not reserved' )->get();

         //return view('order')->with('dishes',$dishes)->with('tables',$tables)->with('commands',$commands)->with('orders',$orders);

         return redirect()->to('admindishes')->with('dishes',$dishes);
     }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function addDish(Request $request){
        $dish = new Dish;

        $dish->name = $request->name ;
        $dish->type_plat = $request->type ;
        $dish->description = $request->description ;
        $dish->price = $request->price ;

        $dish->save();

         // Redirect
         $dishes = Dish::all();
         $id = Auth::user()->id;
         $commands = command::where('id_client', $id )->get();
         $orders = CommandPlat::all();
         $tables = Table::where('status', 'Not reserved' )->get();

         //return view('order')->with('dishes',$dishes)->with('tables',$tables)->with('commands',$commands)->with('orders',$orders);

         return redirect()->to('admindishes')->with('dishes',$dishes);
     }


                       /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroyTable($id)
     {
         try {
            $deletetable = Table::where('id', $id )->get()->first();
            $deletetable = Table::where('id', $id )->delete();
         } catch (Exception $th) {
            Debugbar::alert("catchy".$th);
         }

        // Redirect
         $tables = Table::all();
         //return view('order')->with('dishes',$dishes)->with('tables',$tables)->with('commands',$commands)->with('orders',$orders);

         return redirect()->to('admintables')->with('tables',$tables);
     }

          /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function addTable(){
        $table = new Table;
        $table->status = "Not reserved";
        $table->save();

         // Redirect
         $tables = Table::all();
         //return view('order')->with('dishes',$dishes)->with('tables',$tables)->with('commands',$commands)->with('orders',$orders);

         return redirect()->to('admintables')->with('tables',$tables);
     }
}
