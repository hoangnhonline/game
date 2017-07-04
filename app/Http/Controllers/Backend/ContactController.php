<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Helper, File, Session, Auth;
use Maatwebsite\Excel\Facades\Excel;
class ContactController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        $status = isset($request->status) ? $request->status : 0;
        $type = isset($request->type) ? $request->type : 0;
        $email = isset($request->email) && $request->email != '' ? $request->email : '';
        $phone = isset($request->phone) && $request->phone != '' ? $request->phone : '';
        
        $query = Contact::whereRaw('1')->orderBy('id', 'DESC');

        $status = 1;

        if( $status > 0){
            $query->where('status', $status);
        }
        if( $type > 0){
            $query->where('type', $type);
        }
        if( $email != ''){
            $query->where('email', 'LIKE', '%'.$email.'%');
        }
        if( $phone != ''){
            $query->where('phone', 'LIKE', '%'.$phone.'%');
        }
        $items = $query->orderBy('id', 'desc')->paginate(20);
        
        return view('backend.contact.index', compact( 'items', 'email', 'status', 'phone', 'type'));
    }    
    public function download()
    {
        $contents = [];
        $query = Contact::whereRaw('1')->orderBy('id', 'DESC')->get();
        $i = 0;
        foreach ($query as $data) {
            $i++;
            $contents[] = [
                'STT' => $i,
                'Email' => $data->email,
                'Ngày ĐK' => date('d-m-Y H:i', strtotime($data->created_at))
            ];
        }        
        
        Excel::create('contact_' . date('YmdHi'), function ($excel) use ($contents) {
            // Set sheets
            $excel->sheet('Email', function ($sheet) use ($contents) {
                $sheet->fromArray($contents, null, 'A1', false, false);
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

        $detail = Contact::find($id);

        return view('backend.contact.edit', compact('detail'));
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
            'email' => 'required|unique:contact,email,'.$dataArr['id'],
        ],
        [   
            'email.required' => 'Bạn chưa nhập email',
            'email.unique' => 'Email đã được sử dụng.'
        ]);
    
        $dataArr['updated_user'] = Auth::user()->id;
        
        $model = Contact::find($dataArr['id']);

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật thành công');        

        return redirect()->route('contact.edit', $dataArr['id']);
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
        $model = Contact::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa contact thành công');
        return redirect()->route('contact.index');
    }
}
