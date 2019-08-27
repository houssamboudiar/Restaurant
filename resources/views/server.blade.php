@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="container-fluid col-12">
            <div class="row">
                <div class="col-3 option-card">
                    <div class="card" style="width: 18rem;" class="option-card">
                        <div class="card-body">
                            <h5 class="card-title">Menu</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Laudantium rem corporis aspernatur porro magni.</p>
                            <div class="col-12 text-center">
                                <a href="/menu" class="btn btn-primary">Check what's new</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 option-card">
                    <div class="card" style="width: 18rem;" class="option-card">
                        <div class="card-body">
                            <h5 class="card-title">Oder Food</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Laudantium rem corporis aspernatur porro magni.</p>
                            <div class="col-12 text-center">
                                <a href="{{route('neworder')}}" class="btn btn-success">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 option-card">
                    <div class="card" style="width: 18rem;" class="option-card">
                        <div class="card-body">
                            <h5 class="card-title">Order status</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Laudantium rem corporis aspernatur porro magni.</p>
                            <div class="col-12 text-center">
                                <a href="#" class="btn btn-warning">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 option-card">
                    <div class="card" style="width: 18rem;" class="option-card">
                        <div class="card-body">
                            <h5 class="card-title">Cancel order</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Laudantium rem corporis aspernatur porro magni.</p>
                            <div class="col-12 text-center">
                                <a href="#" class="btn btn-danger">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container col-lg-12" style="margin-top:20px;">
        @if (count($commands)>=1)
        <table class="table h-auto col-lg-12">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Type</th>
                    <th scope="col">Table</th>
                    <th scope="col">Status</th>
                    <th scope="col">Entréé</th>
                    <th scope="col">Principal</th>
                    <th scope="col">Dessert</th>
                    <th scope="col">Price</th>
                    <th scope="col">Validation</th>
                    <th scope="col">Cancel</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commands as $command)
                <tr>
                    <th scope="row" class="w-auto">{{$command->id}}</th>
                    <td class="w-auto">{{$command->type}}</td>
                    <td class="w-auto">@if ($command->id_table==NULL)
                        <span>/</span>
                        @else
                        {{$command->id_table}}
                        @endif</td>
                    <td class="w-auto">{{$command->status}}</td>


                    <td class="w-auto" style="text-transform:capitalize;">
                        @foreach ($orders as $order)
                        @if ($command->entree == $order->id_order)
                        @foreach ($dishes as $dish)
                        @if ($order->id_plat == $dish->id_plat)
                        {{$dish->name}}
                        @endif
                        @endforeach
                        @endif
                        @endforeach

                    </td>



                    <td class="w-auto" style="text-transform:capitalize;">
                        @foreach ($orders as $order)
                        @if ($command->plat == $order->id_order)
                        @foreach ($dishes as $dish)
                        @if ($order->id_plat == $dish->id_plat)
                        {{$dish->name}}
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                    </td>
                    <td class="w-auto" style="text-transform:capitalize;">
                        @foreach ($orders as $order)
                        @if ($command->apr == $order->id_order)
                        @foreach ($dishes as $dish)
                        @if ($order->id_plat == $dish->id_plat)
                        {{$dish->name}}
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                    </td>
                    <td class="w-auto">{{$command->price}}$</td>

                    <td class="w-auto">

                        <form action="{{route('validateCommands',[$command->id])}}" method="post">
                            @csrf
                            @method('POST')
                            @if ($command->status =='Pending')
                            <button type="submit" class='btn btn-danger'>Validate</button>
                            @else
                            <button disabled type="submit" class='btn btn-danger'>Validate</button>
                            @endif
                        </form>

                    </td>

                    <td class="w-auto">

                        <form action="{{route('deleteorder',[$command->id])}}" method="delete">
                            @csrf
                            @method('DELETE')
                            @if ($command->status =='Pending')
                            <button type="submit" class='btn btn-danger'>Delete</button>
                            @else
                            <button disabled type="submit" class='btn btn-danger'>Delete</button>
                            @endif
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h1>No orders yet ! :)</h1>
        @endif

    </div>

</div>

@endsection
