<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Orders extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'orders';

	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'id',
      'customer_id',
      'tong_tien',
      'tong_sp',
      'status',
      'method_id',
      'coupon_id',
      'giam_gia',
      'tien_thanh_toan',
      'phi_giao_hang',
      'district_id',
      'city_id',
      'ward_id',
      'address',
      'address_type',
      'service_fee',
      'ngay_giao_du_kien',
      'ngay_giao_thuc',
      'phi_cod',
      'full_name',
      'email',
      'phone'
    ];

    public function order_detail()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id');
    }

    public function customer()
    {
        return $this->hasOne('App\Models\Customer', 'id', 'customer_id');
    }
}
