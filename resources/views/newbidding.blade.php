@extends('layouts.app')

@section('content')
<div class="container-fluid col-xs-8 col-xs-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">New Bidding</h3>
        </div>
        <div class="panel-body">
            <form action="/addbidding" method="POST"> 
                <div class="form-group">
                    {{ csrf_field() }}
                    <label for="bid_name">Name</label>
                    <input type="text" class="form-control" name="bid_name">
                    <label for="specification">Specification</label>
                    <input type="text" class="form-control" name="specification">
                    <label for="min_price">Minimum Price</label>
                    <input type="number" class="form-control" name="min_price" min="1" step="0.01">
                    <label for="max_price">Maximum Price</label>
                    <input type="number" class="form-control" name="max_price" min="1" step="0.01">
                    <label for="time_start">Time Start</label>
                    <input type="datetime-local" class="form-control" name="time_start">
                    <label for="time_end">Time End</label>
                    <input type="datetime-local" class="form-control" name="time_end">
                </div>
                <button class="btn btn-default" type="submit">+ Add Bidding</button>
            </form>
        </div>
    </div>
</div>
@endsection