<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\customer_night;

class Customer_niController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $objs = customer_night::paginate(15);
      $data['objs'] = $objs;
      $data['datahead'] = "รายชื่อในระบบ รอบบ่าย";
      return view('admin.userni.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data['method'] = "post";
      $data['url'] = url('admin/user_2');
      $data['header'] = "เพิ่มรายชื่อใหม่";
      return view('admin.userni.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
     'name' => 'required|unique:users|max:255',
     'part_day' => 'required',
   ]);


   $get_all_count = DB::table('customer_nights')
                ->select(
                'customer_nights.*'
                )
                ->where('customer_nights.name', $request['name'])
                ->count();

                if($get_all_count > 0){

                  $arr['success'] = false;
        $arr['data_message'] = 'รายชื่อซ้ำ ในระบบ';
        return json_encode($arr);

      }else{




        $package = new customer_night();
        $package->code_id = $request['code_id'];
        $package->name = $request['name'];
        $package->job_title = $request['job_title'];
        $package->current_branch = $request['current_branch'];
        $package->area = $request['area'];
        $package->remark = $request['remark'];
        $package->status = 1;
        $package->new_customer = 1;
        $package->part_day = $request['part_day'];
        $package->save();
      //  return redirect(url('admin/user_2'))->with('add_success','เพิ่มรายชื่อ '.$request['name'].' เสร็จเรียบร้อยแล้ว');


      $get_all_count = DB::table('customer_nights')
                ->select(
                'customer_nights.*'
                )
                ->where('customer_nights.status', 0)
                ->count();

    $get_count = DB::table('customer_nights')
              ->select(
              'customer_nights.*'
              )
              ->where('customer_nights.status', 1)
              ->count();

              $count_user_all_new = customer_night::where('customer_nights.new_customer', 1)->count();
              $arr['count_user_all_new'] = $count_user_all_new;

              $arr['all_count_message'] = $get_all_count;
     $arr['new_count_message'] = $get_count;
     $the_id = $package->id;
     $get_data = DB::table('customer_nights')
                ->select(
                'customer_nights.*'
                )
                ->where('customer_nights.id', $the_id)
                ->first();


                $arr['code_id'] = $get_data->code_id;
                $arr['name'] = $get_data->name;

                if($get_data->part_day == 1){
                    $arr['part_day'] = "รอบเช้า";
                }else{
                  $arr['part_day'] = "รอบบ่าย";
                }

                $arr['job_title'] = $get_data->job_title;
                $arr['current_branch'] = $get_data->current_branch;
                $arr['area'] = $get_data->area;
                $arr['income_time'] = date('Y-m-d H:i:s', strtotime('+7 hour'));
                $arr['success'] = true;

              //  dd($arr);

                return json_encode($arr);



      }



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


    public function user_2_search(Request $request)
    {
      $this->validate($request, [
        'q' => 'required'
      ]);

      $search = $request->get('q');

      $objs = DB::table('customer_nights')
              ->select(
              'customer_nights.*'
              )
              ->where('name', 'like', "%$search%")
              ->orWhere('job_title', 'like', "%$search%")
              ->orWhere('code_id', 'like', "%$search%")
              ->limit(50)
                ->get();


              $get_count = DB::table('customer_nights')
                      ->select(
                      'customer_nights.*'
                      )
                      ->where('name', 'like', "%$search%")
                      ->orWhere('job_title', 'like', "%$search%")
                      ->orWhere('code_id', 'like', "%$search%")
                      ->count();

                      $data['count'] = $get_count;
                      $data['objs'] = $objs;
                      $data['search'] = $search;
                      $data['datahead'] = "รายชื่อในระบบ รอบบ่าย";


                      return view('admin.userni.search', $data);

    }


    public function post_update(Request $request)
    {


      $status_user = $request['status_user'];
      $id = $request['id_user'];

      $code_id = $request['code_id'];

      $name = $request['name'];
      $part_day = $request['part_day'];
      $job_title = $request['job_title'];
      $current_branch = $request['current_branch'];
      $area = $request['area'];




       $upobj = DB::table('customer_nights')
      ->select(
      'customer_nights.*'
      )
      ->where('id', $id)
      ->update(array(
        'status' => $status_user
      ));


       if($status_user == 1){


         $get_all_count = DB::table('customer_nights')
                      ->select(
                      'customer_nights.*'
                      )
                      ->where('customer_nights.status', 0)
                      ->count();

          $get_count = DB::table('customer_nights')
                    ->select(
                    'customer_nights.*'
                    )
                    ->where('customer_nights.status', 1)
                    ->count();
                    $count_user_all_new = customer_night::where('customer_nights.new_customer', 1)->count();
                    $arr['count_user_all_new'] = $count_user_all_new;

          $arr['all_count_message'] = $get_all_count;
          $arr['new_count_message'] = $get_count;

          $get_data = DB::table('customer_nights')
                    ->select(
                    'customer_nights.*'
                    )
                    ->where('customer_nights.id', $id)
                    ->first();

                  //  dd($get_data->code_id);

                    $arr['code_id'] = $get_data->code_id;
                    $arr['name'] = $get_data->name;

                    if($get_data->part_day == 1){
                        $arr['part_day'] = "รอบเช้า";
                    }else{
                      $arr['part_day'] = "รอบบ่าย";
                    }

                    $arr['job_title'] = $get_data->job_title;
                    $arr['current_branch'] = $get_data->current_branch;
                    $arr['area'] = $get_data->area;
                    $arr['income_time'] = date('Y-m-d H:i:s', strtotime('+7 hour'));
                    $arr['success'] = true;

                  //  dd($arr);

                    return json_encode($arr);

       }else{
         $arr['success'] = false;
          return json_encode($arr);
       }

      //  return redirect(url('admin/user_2'))->with('success','อัพเดทรายชื่อสำเร็จแล้วค่ะ');
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
