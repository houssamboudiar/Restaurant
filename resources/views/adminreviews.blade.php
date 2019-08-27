@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users review</div>

                <div class="card-body">
                </div>
        @if (count($feedbacks)>=1)
                    @foreach ($feedbacks as $feedback)
                    <ul class="list-unstyled">
                        <li class="media" style="margin-bottom: 10px; padding-left: 23px;" >
                            <img src="{{ asset('user-picture.png') }}" class="mr-3" alt="...">
                            <div class="media-body">
                            <h5 class="mt-0 mb-1">{{$feedback->rating}}</h5>
                            {{$feedback->review}}
                            </div>
                        </li>
                    </ul>
                    @endforeach

                </tbody>
            </table>
        </div>

        @else
            <h1>No reviews yet ! :)</h1>
        @endif

    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection