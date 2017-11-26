@extends('layouts.app')

@section('content')
<div class="container-fluid col-xs-8 col-xs-offset-2 menu-bar">
    <a href="/allbiddinglist">Return to Bidding List</a>
</div>

<div class="container-fluid col-xs-8 col-xs-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Bidding Details</h3>
        </div>   
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>Bidding Name</th>
                    <th>Specification</th>
                    <th>Minimum Price</th>
                    <th>Maximum Price</th>
                    <th>Lowest Bid</th>
                </tr>
                <tr>
                    @if ($data)
                        <td>
                            {{$data[0]->bidding_name}}
                        </td>
                        <td>
                            {{$data[0]->specification}}
                        </td>
                        <td>
                            {{$data[0]->min_price}}
                        </td>
                        <td>
                            {{$data[0]->max_price}}
                        </td>
                        <td>
                            {{$data[0]->submit_price}}
                        </td>
                    @else
                        <td><i>No submitted bid yet.</i></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @endif
                </tr>
            </table>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Your Bidding History</h3>
        </div>   
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>Bid Amount</th>
                    <th>Bid Time</th>
                </tr>
                @if ($bid)
                    @foreach($bid as $b)
                        <tr>
                            <td>
                                {{$b->submit_price}}
                            </td>
                            <td>
                                {{$b->created_at}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td><i>You haven't submitted bid yet.</i></td>
                        <td></td>
                    </tr>
                @endif
            </table>
        </div>
    </div>

    @if ($data)
        @if (date_create() <= date_create($data[0]->time_end))
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Submit New Bid</h3>
                </div>
                <div class="panel-body">
                    <form action="/submitbid" method="POST"> 
                        <div class="form-group">
                            {{ csrf_field() }}
                            <label for="submit_price">Bid Amount</label>
                            <input type="number" class="form-control" name="submit_price" min="1" step="0.01">
                            <input type="hidden" name="bid_id" value="{{$bidID}}">
                        </div>
                        <button class="btn btn-default" type="submit">Bid</button>
                    </form>
                </div>
            </div>
        @endif
    @else
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Submit New Bid</h3>
            </div>
            <div class="panel-body">
                <form action="/submitbid" method="POST"> 
                    <div class="form-group">
                        {{ csrf_field() }}
                        <label for="submit_price">Bid Amount</label>
                        <input type="number" class="form-control" name="submit_price" min="1" step="0.01">
                        <input type="hidden" name="bid_id" value="{{$bidID}}">
                    </div>
                    <button class="btn btn-default" type="submit">Bid</button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection