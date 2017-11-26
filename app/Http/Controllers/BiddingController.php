<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\Facades\DB;
use App\Biddings;
use App\BidSubmissions;

class BiddingController extends Controller
{
    // admin
    function GetBidding() {
        if (Auth::check() and Auth::user()->role == 'admin') {
            $item = DB::select(DB::raw('select * from biddings where user_id = :id'), ['id' => Auth::id()] );
            return view('biddinglist', ["data" => $item]);
        }
        else {
            return redirect('/');
        }
    }
    function NewBidding() {
        if (Auth::check() and Auth::user()->role == 'admin') {
            return view('newbidding');
        }
        else {
            return redirect('/');
        }
    }
    function AddBidding(Request $req) {
        if (Auth::check() and Auth::user()->role == 'admin') {
            DB::beginTransaction();
            try{
                $item = new Biddings;
                $item->user_id = Auth::id();
                $item->bidding_name = $req->input('bid_name');
                $item->specification = $req->input('specification');
                $item->min_price = $req->input('min_price');
                $item->max_price = $req->input('max_price');
                $item->time_start = $req->input('time_start');
                $item->time_end = $req->input('time_end');
                $item->save();
                DB::commit();
                return redirect('/biddinglist');
            }
            catch(\Exception $e){
                DB::rollback();
                return redirect('/');
            }
        }
        else {
            return redirect('/');
        }
    }
    function ViewBidding($id) {
        if (Auth::check() and Auth::user()->role == 'admin') {
            $item = DB::select(DB::raw('select b.bidding_name as bidding_name, u.name as name, u.email as email, bs.submit_price as submit_price
            from bid_submissions bs
            join biddings b on bs.bidding_id=b.id
            join users u on bs.user_id=u.id
            where bs.bidding_id = :bid and bs.status = \'active\'
            group by b.bidding_name, u.name, u.email, bs.submit_price
            order by bs.submit_price asc'), ['bid' => $id] );
            return view('viewbidding', ["data" => $item]);
        }
        else {
            return redirect('/');
        }
    }

    // partner
    function GetAllBidding() {
        if (Auth::check() and Auth::user()->role == 'partner') {
            $item = DB::select('select * from biddings where time_start < now() and time_end > now()');
            return view('allbiddinglist', ["data" => $item]);
        }
        else {
            return redirect('/');
        }
    }
    function SelectBidding($id) {
        if (Auth::check() and Auth::user()->role == 'partner') {
            $item = DB::select(DB::raw('select b.bidding_name as bidding_name, b.specification as specification, b.min_price as min_price, b.max_price as max_price, min(bs.submit_price) as submit_price, b.time_end as time_end
            from bid_submissions bs
            join biddings b on bs.bidding_id=b.id
            where bs.bidding_id = :bid and bs.status = \'active\'
            group by b.bidding_name, b.specification, b.min_price, b.max_price, b.time_end'), ['bid' => $id] );
            $history = DB::select(DB::raw('select * from bid_submissions where user_id = :uid and bidding_id = :bid'), ['uid' => Auth::id(), 'bid' => $id] );
            $bidID = $id;
            return view('selectbidding', ["data" => $item, "bid" => $history, "bidID" => $bidID]);
        }
        else {
            return redirect('/');
        }
    }
    function SubmitBid(Request $req) {
        if (Auth::check() and Auth::user()->role == 'partner') {
            DB::beginTransaction();
            try{
                DB::table('bid_submissions')
                ->where('user_id', Auth::id())
                ->where('bidding_id', $req->input('bid_id'))
                ->update(['status' => 'inactive']);

                $item = new BidSubmissions;
                $item->user_id = Auth::id();
                $item->bidding_id = $req->input('bid_id');
                $item->submit_price = $req->input('submit_price');
                $item->status = 'active';
                $item->save();
                DB::commit();
                return redirect('/allbiddinglist');
            }
            catch(\Exception $e){
                DB::rollback();
                return redirect('/');
            }
        }
        else {
            return redirect('/');
        }
    }
    function BidHistory() {
        if (Auth::check() and Auth::user()->role == 'partner') {
            $item = DB::select(DB::raw('select bs.bidding_id as bidding_id, b.bidding_name as bidding_name, b.specification as specification, b.time_start as time_start, b.time_end as time_end, bs.submit_price as submit_price, bs.created_at as created_at
            from bid_submissions bs
            join biddings b on bs.bidding_id=b.id
            where bs.status = \'active\' and bs.user_id = :uid
            group by bs.bidding_id, b.bidding_name, b.specification, b.time_start, b.time_end, bs.submit_price, bs.created_at'), ['uid' => Auth::id()]);
            return view('bidhistory', ["data" => $item]);
        }
        else {
            return redirect('/');
        }
    }
}
