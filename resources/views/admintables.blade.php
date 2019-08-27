@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="container col-lg-12" style="margin-top:20px;">
                <a href="{{route('addtable')}}" class="btn btn-success">Add table</a>
    <div > 
    </div>
        @if (count($tables)>=1)
        <div class="table-responsive-xl" >
            <table id="applyTable" class="table">
                <thead class="thead-light">
                    <tr >
                        <th class="w-auto" scope="col" >#</th>
                        <th class="w-auto" scope="col">Status</th>
                        <th class="w-auto" scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tables as $table)
                    <tr >
                        <th scope="row" class="w-auto">{{$table->id}}</th>
                        <td class="w-auto" style="text-transform:capitalize;">{{$table->status}}</td>
                        <td class="w-auto" >

                            <form action="{{route('deletetable',[$table->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class='btn btn-danger' >Delete</button>
                            </form>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        @else
            <h1>No orders yet ! :)</h1>
        @endif

    </div>

        <script type="text/javascript" language="javascript">
        var indexplaceholder = 0;


        </script>

</div>

@endsection
