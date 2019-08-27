@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dishes Menu</div>

                <div class="card-body">
                    @if (count($dishes)>1)
                        @foreach ($dishes as $dish)
                            @if($dish-> name != 'None')


                            <div class="card mb-3" >
                                <div class="row no-gutters">
                                <div class="col-md-4 ">
                                    <img  class="card-img border border-dark rounded-0 img-responsive" src="{{ asset('cake.jpg') }}" >
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                    <h5 class="text-secondary font-weight-light" style="text-transform:capitalize;font-size: 1.1rem;" >{{$dish->type_plat }}</h5>
                                    <h5 class="card-title text-primary font-weight-light" style="text-transform:capitalize;font-size:1.25rem;">{{$dish->name}}</h5>
                                    <p class="card-text">{{$dish -> description }} </p>
                                    <span class="badge badge-success" style="font-size:110%;font-weight: 600; border-radius:0.25rem; margin-bottom:10px ;" >{{$dish -> price }} $</span>
                                    <p class="card-text"><small class="text-muted">Waiting time 10 minutes</small></p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @else
                        <div class="col-12">
                            <h1> Dishes not added yet ! hungry</h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
