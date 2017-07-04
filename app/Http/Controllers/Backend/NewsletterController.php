<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Helper, File, Session, Auth;
use Maatwebsite\Excel\Facades\Excel;
class NewsletterController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        $status = isset($request->status) ? $request->status : 0;

        $email = isset($request->email) && $request->email != '' ? $request->email : '';
        
        $query = Newsletter::whereRaw('1')->orderBy('id', 'DESC');

        $status = 1;

        if( $status > 0){
            $query->where('status', $status);
        }
        
        if( $email != ''){
            $query->where('email', 'LIKE', '%'.$email.'%');
        }
        $items = $query->orderBy('id', 'desc')->paginate(20);
        
        return view('backend.newsletter.index', compact( 'items', 'email', 'status' ));
    }    
    public function download()
    {
        $contents = [];
        $query = Newsletter::whereRaw('1')->orderBy('id', 'DESC')->get();
        $i = 0;
        foreach ($query as $data) {
            $i++;
            $contents[] = [
                'STT' => $i,
                'Email' => $data->email,
                'Ngày ĐK' => date('d-m-Y H:i', strtotime($data->created_at))
            ];
        }        
        
        Excel::create('newsletter_' . date('YmdHi'), function ($excel) use ($contents) {
            // Set sheets
            $excel->sheet('Email', function ($sheet) use ($contents) {
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

        $detail = Newsletter::find($id);

        return view('backend.newsletter.edit', compact('detail'));
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
        
        $model = Newsletter::find($dataArr['id']);

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật thành công');        

        return redirect()->route('newsletter.edit', $dataArr['id']);
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
        $model = Newsletter::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa newsletter thành công');
        return redirect()->route('newsletter.index');
    }
}
