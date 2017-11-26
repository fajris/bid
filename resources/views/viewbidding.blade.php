@extends('layouts.app')

@section('content')
<div class="container-fluid col-xs-8 col-xs-offset-2 menu-bar">
    <a href="/biddinglist">Return to Bidding List</a>
</div>

<div class="container-fluid col-xs-8 col-xs-offset-2">
    <div class="panel panel-default">
    
        <div class="panel-heading">
            <h3 class="panel-title">Bidding History</h3>
        </div>
    
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>Bidding Name</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Bid Price</th>
                </tr>
                @if ($data)
                    @foreach($data as $d)
                        <tr>
                            <td>
                                {{$d->bidding_name}}
                            </td>
                            <td>
                                {{$d->name}}
                            </td>
                            <td>
                                {{$d->email}}
                            </td>
                            <td>
                                {{$d->submit_price}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td><i>No bid submitted yet</i></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection