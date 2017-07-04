<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cate;
use App\Models\LoaiSp;
use App\Models\SanPham;
use App\Models\Orders;
use App\Models\OrderDetail;
use Helper, File, Session, Auth, DB;
use Carbon\Carbon;
class ReportController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {        
        $date_type = $request->date_type ? $request->date_type : "7-ngay-qua";
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $report_type = $request->report_type ? $request->report_type : 'don-hang';
        if($date_type != 'tuy-chon'){
            $tmpArr = Helper::getDayFromTo($date_type);
        }else{
            $tmpArr['date_from'] = date('Y-m-d', strtotime($date_from));
            $tmpArr['date_to'] = date('Y-m-d', strtotime($date_to));
        }
        $dateArr = Helper::getDateFromRange($tmpArr['date_from'], $tmpArr['date_to']);

        if($report_type == 'don-hang'){
            $data['cho_xu_ly'] = $this->reportDonHang($tmpArr['date_from'], $tmpArr['date_to'], 0); // cho xu ly
            $data['dang_xu_ly'] = $this->reportDonHang($tmpArr['date_from'], $tmpArr['date_to'], 1); // dang xu ly
            $data['da_hoan_thanh'] = $this->reportDonHang($tmpArr['date_from'], $tmpArr['date_to'], 3); // da hoan thanh
            $title = "Thống kê tổng số đơn hàng" ;
            $subtitle = "";
            if($date_type == "7-ngay-qua"){
                $title.=" 7 ngày qua";
                $subtitle = date('d-m-Y', strtotime($tmpArr['date_from'])) . " đến ".date('d-m-Y', strtotime($tmpArr['date_to']));
            }elseif($date_type == "thang-nay"){
                $title.=" tháng này ";
                $subtitle = date('m-Y', time());
            }elseif($date_type == "thang-truoc"){
                $title.=" tháng trước";
                $subtitle = date('m-Y', strtotime($dateArr[0]));
            }
        }
        if($report_type == 'khach-hang'){
            $data['thanh_vien'] = $this->reportKhachHang($tmpArr['date_from'], $tmpArr['date_to'], true); // cho xu ly
            $data['vang_lai'] = $this->reportKhachHang($tmpArr['date_from'], $tmpArr['date_to']); // dang xu ly            
            $title = "Thống kê đơn hàng theo khách hàng" ;
            $subtitle = "";
            if($date_type == "7-ngay-qua"){
                $title.=" 7 ngày qua";
                $subtitle = date('d-m-Y', strtotime($tmpArr['date_from'])) . " đến ".date('d-m-Y', strtotime($tmpArr['date_to']));
            }elseif($date_type == "thang-nay"){
                $title.=" tháng này ";
                $subtitle = date('m-Y', time());
            }elseif($date_type == "thang-truoc"){
                $title.=" tháng trước";
                $subtitle = date('m-Y', strtotime($dateArr[0]));
            }
        }
        if($report_type == 'doanh-thu'){
            $data['doanh_thu'] = $this->reportDoanhThu($tmpArr['date_from'], $tmpArr['date_to'], 'doanh_thu');
            $data['phi_giao_hang'] = $this->reportDoanhThu($tmpArr['date_from'], $tmpArr['date_to'], 'phi_giao_hang');
            $data['tien_dich_vu'] = $this->reportDoanhThu($tmpArr['date_from'], $tmpArr['date_to'], 'tien_dich_vu');
             
            $title = "Thống kê doanh thu " ;
            $subtitle = "";
            if($date_type == "7-ngay-qua"){
                $title.=" 7 ngày qua";
                $subtitle = date('d-m-Y', strtotime($tmpArr['date_from'])) . " đến ".date('d-m-Y', strtotime($tmpArr['date_to']));
            }elseif($date_type == "thang-nay"){
                $title.=" tháng này ";
                $subtitle = date('m-Y', time());
            }elseif($date_type == "thang-truoc"){
                $title.=" tháng trước";
                $subtitle = date('m-Y', strtotime($dateArr[0]));
            }
        }
        return view('backend.report.index', compact( 'report_type', 'date_type' , 'date_to', 'date_from', 'data', 'dateArr', 'title','subtitle'));        
    }

    public function reportDonHang($date_from, $date_to, $status){
        $date_from = Carbon::parse($date_from)->format('Y-m-d H:i:s');
        $date_to = Carbon::parse($date_to)->format('Y-m-d H:i:s');
        $query = DB::table('orders')
                     ->select(DB::raw('count(id) as total, DATE(created_at) as date'))
                     ->where('status', $status)
                     ->where('created_at', '>=', $date_from)
                     ->where('created_at', '<=', $date_to)                     
                     ->groupBy('date')
                     ->lists('total', 'date');        
        return $query;
    }
    public function reportKhachHang($date_from, $date_to, $is_customer = false){
        $date_from = Carbon::parse($date_from)->format('Y-m-d H:i:s');
        $date_to = Carbon::parse($date_to)->format('Y-m-d H:i:s');
        if($is_customer == true){
        $query = DB::table('orders')
                     ->select(DB::raw('count(id) as total, DATE(created_at) as date'))
                    
                         ->where('customer_id', '>', 0)
                                  
                     ->where('created_at', '>=', $date_from)
                     ->where('created_at', '<=', $date_to)                     
                     ->groupBy('date')
                     ->lists('total', 'date');        
        }else{
            $query = DB::table('orders')
                     ->select(DB::raw('count(id) as total, DATE(created_at) as date'))
                    
                     ->where('customer_id', 0)
                                  
                     ->where('created_at', '>=', $date_from)
                     ->where('created_at', '<=', $date_to)                     
                     ->groupBy('date')
                     ->lists('total', 'date');        
        }                    
        return $query;
    }
    public function reportDoanhThu($date_from, $date_to, $type){
        $date_from = Carbon::parse($date_from)->format('Y-m-d H:i:s');
        $date_to = Carbon::parse($date_to)->format('Y-m-d H:i:s');
        if($type == 'doanh_thu'){
        $query = DB::table('orders')
                     ->select(DB::raw('SUM(tong_tien) as doanh_thu, DATE(created_at) as date'))
                     ->where('status', 3)
                     ->where('created_at', '>=', $date_from)
                     ->where('created_at', '<=', $date_to)                     
                     ->groupBy('date')
                     ->lists('doanh_thu', 'date');
        }elseif($type == "phi_giao_hang"){
            $query = DB::table('orders')
                     ->select(DB::raw('SUM(phi_giao_hang) as phi_giao_hang, DATE(created_at) as date'))
                     ->where('status', 3)
                     ->where('created_at', '>=', $date_from)
                     ->where('created_at', '<=', $date_to)                     
                     ->groupBy('date')
                     ->lists('phi_giao_hang', 'date');

        }elseif($type == "tien_dich_vu"){
            $query = DB::table('orders')
                     ->select(DB::raw('SUM(service_fee) as tien_dich_vu, DATE(created_at) as date'))
                     ->where('status', 3)
                     ->where('created_at', '>=', $date_from)
                     ->where('created_at', '<=', $date_to)                     
                     ->groupBy('date')
                     ->lists('tien_dich_vu', 'date');

        }
        return $query;
    }   
}
