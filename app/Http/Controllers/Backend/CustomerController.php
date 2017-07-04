<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Helper, File, Session, Auth;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        $status = isset($request->status) ? $request->status : 0;

        $full_name = isset($request->full_name) && $request->full_name != '' ? $request->full_name : '';
        $email = isset($request->email) && $request->email != '' ? $request->email : '';
        $phone = isset($request->phone) && $request->phone != '' ? $request->phone : '';
        
        $query = Customer::whereRaw('1');

        $status = 1;

        if( $status > 0){
            $query->where('status', $status);
        }
        if( $full_name != ''){
            $query->where('full_name', 'LIKE', '%'.$full_name.'%');
        }
        if( $phone != ''){
            $query->where('phone', 'LIKE', '%'.$phone.'%');
        }
        if( $email != ''){
            $query->where('email', 'LIKE', '%'.$email.'%');
        }
        $items = $query->orderBy('id', 'desc')->paginate(20);
        
        return view('backend.customer.index', compact( 'items', 'email', 'status' , 'phone', 'full_name'));
    }    
    public function download()
    {
        $contents = [];
        $query = Customer::where('email', '<>', '')->orderBy('id', 'DESC')->groupBy('email')->get();
        $i = 0;
        foreach ($query as $data) {
            $i++;
            $contents[] = [
                'STT' => $i,
                'Họ tên' => $data->full_name,
                'Email' => $data->email,                
                'Điện thoại' => $data->phone                
            ];
        }        
        
        Excel::create('customer_' . date('YmdHi'), function ($excel) use ($contents) {
            // Set sheets
            $excel->sheet('Khách hàng', function ($sheet) use ($contents) {
                $sheet->fromArray($contents, null, 'A1', false, true);
            });
        })->download('xls');
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  Request  $request
    * @return Response
    */    

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
    //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $tagSelected = [];

        $detail = Customer::find($id);

        return view('backend.customer.edit', compact('detail'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  Request  $request
    * @param  int  $id
    * @return Response
    */
    public function update(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[                              
            'email' => 'required|unique:newsletter,email,'.$dataArr['id'],
        ],
        [   
            'email.required' => 'Bạn chưa nhập email',
            'email.unique' => 'Email đã được sử dụng.'
        ]);
    
        $dataArr['updated_user'] = Auth::user()->id;
        
        $model = Customer::find($dataArr['id']);

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật thành công');        

        return redirect()->route('customer.index', ['status' => $dataArr['status']]);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        // delete
        $model = Customer::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa newsletter thành công');
        return redirect()->route('customer.index');
    }
}
