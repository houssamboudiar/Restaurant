@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="container-fluid col-12">
            <div class="row">
                <div class="col-3 option-card"> <!-- Manage Dishes -->
                    <div class="card" style="width: 18rem;" class="option-card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Dishes</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Laudantium rem corporis aspernatur porro magni.</p>
                            <div class="col-12 text-center">
                                <a href="{{route('admindishes')}}" class="btn btn-primary">Manage Dishes</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 option-card"> <!-- Manage Users -->
                    <div class="card" style="width: 18rem;" class="option-card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Users</h5>  
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Laudantium rem corporis aspernatur porro magni.</p>
                            <div class="col-12 text-center">
                                <a href="{{route('adminUsers')}}" class="btn btn-primary">Manage Users</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 option-card"> <!-- Manage Tables -->
                    <div class="card" style="width: 18rem;" class="option-card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Tables</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Laudantium rem corporis aspernatur porro magni.</p>
                            <div class="col-12 text-center">
                                <a href="{{route('admintables')}}" class="btn btn-primary">Manage Tables</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 option-card"> <!-- Check feedbacks -->
                    <div class="card" style="width: 18rem;" class="option-card">
                        <div class="card-body">
                            <h5 class="card-title">Check feedbacks</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Laudantium rem corporis aspernatur porro magni.</p>
                            <div class="col-12 text-center">
                                <a  href="{{route('adminreviews')}}" class="btn btn-warning">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
