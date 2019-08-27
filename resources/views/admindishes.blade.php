@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="container col-lg-12" style="margin-top:20px;">
    <div > 
        <button href="#bottom" id='btn' type="submit" class='btn btn-success' onclick="addRow()" style='margin-bottom: 12px;' ><a href="#bottom" style="text-decoration:none; color:#fff; " >Add dish</a></button>
    </div>
        @if (count($dishes)>=1)
        <div class="table-responsive-xl" >
            <table id="applyTable" class="table">
                <thead class="thead-light">
                    <tr >
                        <th class="w-auto" scope="col" >#</th>
                        <th class="w-auto" scope="col">Name</th>
                        <th class="w-auto" scope="col">Type</th>
                        <th class="w-auto" scope="col">Description</th>
                        <th class="w-auto" scope="col">Price</th>
                        <th class="w-auto" scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dishes as $dish)
                        @if($dish-> name != 'None')
                    <tr >
                        <th scope="row" class="w-auto">{{$dish->id_plat}}</th>
                        <td class="w-auto" style="text-transform:capitalize;">{{$dish->name}}</td>
                        <td class="w-auto">{{$dish->type_plat}}</td>
                        <td class="w-auto">{{$dish->description}}</td>
                        <td class="w-auto" >{{$dish->price}}$</td>
                        <td class="w-auto" >

                            <form action="{{route('deletedish',[$dish->id_plat])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class='btn btn-danger' >Delete</button>
                            </form>

                        </td>
                    </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
        </div>

        @else
            <h1>No orders yet ! :)</h1>
        @endif
        <div id="bottom"><a href="bottom"></a></div>

    </div>

        <script type="text/javascript" language="javascript">
        var indexplaceholder = 0;

        function addRow(){
        var test ='<tr id="newrow" ><td scope="row" class="w-auto"><form id="form1" method="post" action="{{ route("addDish") }}">@csrf #</form></td><td class="w-auto"><input form="form1" required class="form-control" type="text" name="name" placeholder=" Name" /></td><td class="w-auto"><select form="form1" required class="form-control" name="type" style="text-transform:capitalize;" id="type"><option selected="selected"  >Dessert</option><option>Plat</option><option>Entrée</option></select></td><td class="w-auto"><textarea  form="form1" required class="form-control" rows="1" cols="50" type="textarea" name="description" placeholder=" Description" /></td><td class="w-auto"><input form="form1" required class="form-control" type="number" pattern="\d*" name="price" placeholder=" Price" /></td><td class="w-auto"><button form="form1" type="submit" class="btn btn-info">Add</button></td></tr>';
        $("#applyTable").append(test);
        var btn = document.getElementById("btn"); 
        btn.disabled = true;
        }
        
        function enableBtn(){
            var btn = document.getElementById("btn"); 
            btn.disabled = false;
        }

        </script>

</div>

@endsection
