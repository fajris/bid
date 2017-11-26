<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/biddinglist', 'BiddingController@GetBidding');
Route::get('/newbidding', 'BiddingController@NewBidding');
Route::post('/addbidding', 'BiddingController@AddBidding');
Route::post('/viewbidding/{id}', 'BiddingController@ViewBidding');

Route::get('/allbiddinglist', 'BiddingController@GetAllBidding');
Route::post('/selectbidding/{id}', 'BiddingController@SelectBidding');
Route::post('/submitbid', 'BiddingController@SubmitBid');
Route::get('/bidhistory', 'BiddingController@BidHistory');