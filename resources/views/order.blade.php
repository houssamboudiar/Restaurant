@extends('layouts.app')

@section('content')

<script>
    function selectOnlyThis(id) {
        var myCheckbox = document.getElementsByClassName('check')
        Array.prototype.forEach.call(myCheckbox, function (el) {
            el.checked = false;
        });
        id.checked = true;

        if(document.getElementById('table').value=='Not found'){
            document.getElementById("Indoors").checked = false;
            document.getElementById("Outdoors").checked = true;
        }

        console.log("executed");
        if(document.getElementById("Outdoors").checked){
            console.log("checked");
            document.getElementById("table").disabled = true;
        }else{
            document.getElementById("table").disabled = false;
        }

    }


</script>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Order Form</div>
                <div class="col12 d-flex justify-content-between" style="margin:15px;">
                    <div class="col-4 ">
                        <form style="margin:15px" method="POST" action="{{ route('postorder') }}" >
                            @csrf
                            <div class="form-group">
                                    <label for="table">Table</label>
                                    <select class="form-control" name="table" style="text-transform:capitalize;" id="table" disabled>
                                        @if (count($tables)>0)
                                        @foreach ($tables as $table)
                                        <option style="text-transform:capitalize;">{{$table->id}}
                                        </option>
                                        @endforeach
                                        @else
                                        <option>Not found</option>
                                        @endif
                                    </select>
                            </div>

                            <div class="form-group">
                                <label for="plat_entree">Plat Entréé</label>
                                <select class="form-control" name="entree" style="text-transform:capitalize;" id="plat_entree">
                                    @if (count($dishes)>1)
                                    @foreach ($dishes as $dish)
                                    @if(($dish->type_plat)=='Entrée')
                                    <option>{{$dish->name}}</option>
                                    @endif
                                    @endforeach
                                    @else
                                    <option>Not found</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="plat_prin">Plat Principal</label>
                                <select class="form-control" name="principal" style="text-transform:capitalize;" id="plat_prin">
                                    @if (count($dishes)>1)
                                    @foreach ($dishes as $dish)
                                    @if(($dish->type_plat)=='Plat')
                                    <option style="text-transform:capitalize;">{{$dish->name}}
                                    </option>
                                    @endif
                                    @endforeach
                                    @else
                                    <option>Not found</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="plat_dessert">Plat Dessert</label>
                                <select class="form-control" name="dessert" style="text-transform:capitalize;" id="plat_dessert">
                                    @if (count($dishes)>1)
                                    @foreach ($dishes as $dish)
                                    @if(($dish->type_plat)=='Dessert')
                                    <option style="text-transform:capitalize;">{{$dish->name}}
                                    </option>
                                    @endif
                                    @endforeach
                                    @else
                                    <option>Not found</option>
                                    @endif
                                </select>
                            </div>


                            <div class="col-12">
                                <div class="form-check form-check-inline" style="margin:5px">
                                    <input class="form-check-input check" name="indoor" type="checkbox" id="Indoors" value="Indoors" onclick="selectOnlyThis(this)" >
                                    <label class="form-check-label" for="Indoors">Indoors</label>
                                </div>

                                <div class="form-check" style="margin:5px">
                                    <input class="form-check-input check" name="outdoor" type="checkbox" id="Outdoors" value="Outdoors" onclick="selectOnlyThis(this)" checked>
                                    <label class="form-check-label" for="Outdoors">Outdoors</label>
                                </div>
                            </div>
                            @if (count($tables)==0)
                            <h5 class="alert alert-danger" role="alert">You cant order indoor foor there's no available tables !</h5>
                            @endif
                            <button type="submit" class="btn btn-primary" style="margin:5px">Submit</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

{{-- {!! Form::open(array('route' => 'order','method' => 'PUT')) !!}

{{Form::select("size",['L' => 'Large', 'S' => 'Small'], null,
[
    "class" => "form-group",
    "placeholder" => "Pick a size..."
])
}} --}}
