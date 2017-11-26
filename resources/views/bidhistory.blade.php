@extends('layouts.app')

@section('content')
<div class="container-fluid col-xs-8 col-xs-offset-2">
    <div class="panel panel-default">
    
        <div class="panel-heading">
            <h3 class="panel-title">Bid History</h3>
        </div>
    
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>Name</th>
                    <th>Specification</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Bid Amount</th>
                    <th>Bid Time</th>
                    <th>Action</th>
                </tr>
                @foreach($data as $d)
                    <tr>
                        <td>
                            {{$d->bidding_name}}
                        </td>
                        <td>
                            {{$d->specification}}
                        </td>
                        <td>
                            {{$d->time_start}}
                        </td>
                        <td>
                            {{$d->time_end}}
                        </td>
                        <td>
                            {{$d->submit_price}}
                        </td>
                        <td>
                            {{$d->created_at}}
                        </td>
                        <td>
                            <form action= "{{ url('/selectbidding/' . $d->bidding_id) }}" method="POST">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-default custom-button">
                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span> View
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection