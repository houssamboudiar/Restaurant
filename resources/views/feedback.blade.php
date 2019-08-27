@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Service Review</div>
                <div class="col12 d-flex justify-content-between" style="margin:15px;">
                    <div class="col-4 ">
                        <form style="margin:15px" method="POST" action="{{ route('postfeedback') }}" >
                            @csrf
                            <div class="form-group">
                                    <label for="rating">Rating</label>
                                    <select class="form-control" name="rating" style="text-transform:capitalize;" id="rating">
                                        <option>Poor</option>
                                        <option>Fair</option>
                                        <option selected="selected" >Good</option>
                                        <option>Very good</option>
                                        <option>Excellent</option>
                                    </select>
                            </div>

                            <div class="form-group">
                                <label for="review">Review</label>
                                <textarea class="form-control" name="review" id="review" rows="7" required ></textarea>
                            </div>
 
                            <button type="submit" class="btn btn-primary" style="margin:5px">Submit</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection