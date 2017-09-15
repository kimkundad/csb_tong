<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\customer_night;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $count_user = customer_night::where('customer_nights.status', 1)->count();

      $count_user_all = customer_night::where('customer_nights.status', 0)->count();
      $count_user_all_new = customer_night::where('customer_nights.new_customer', 1)->count();
    //  dd($count_user_all);
      //$objs = bitcoin::paginate(15);
      $objs = DB::table('customer_nights')
                ->select(
                'customer_nights.*'
                )
                ->where('customer_nights.status', 1)
                ->orderBy('customer_nights.updated_at','ASC')
                ->paginate(15);

      $data['header'] = 'รายชื่อผู้ลงทะเบียนเข้างาน';
      $data['objs'] = $objs;
      $data['count_user'] = $count_user;
      $data['count_user_all'] = $count_user_all;
      $data['count_user_all_new'] = $count_user_all_new;
      return view('admin.dashboard.index', $data);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function get_chart(){

      $get_count = DB::table('customer_nights')
                ->select(
                'customer_nights.*'
                )
                ->where('customer_nights.status', 1)
                ->count();

                $get_count2 = DB::table('customer_nights')
                          ->select(
                          'customer_nights.*'
                          )
                          ->where('customer_nights.status', 0)
                          ->count();


                $arr[0] = [ 'label' => 'ผู้มางาน', 'data' =>[[1, $get_count]],'color' => '#e36159' ];
                $arr[1] = [ 'label' => 'ผู้ร่วมงานทั้งหมด', 'data' =>[[1, $get_count2]],'color' => '#734BA9' ];

              return response()->json($arr);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
