@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::user()->role == 'admin')
                        <ul>
                            <li><a href="/biddinglist">Bidding List</a></li>
                            <li><a href="/newbidding">New Bidding</a></li>
                        </ul>
                    @elseif (Auth::user()->role == 'partner')
                        <ul>
                            <li><a href="/allbiddinglist">All Bidding List</a></li>
                            <li><a href="/bidhistory">Bid History</a></li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
