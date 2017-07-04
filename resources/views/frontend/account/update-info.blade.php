@extends('frontend.layout') 
@include('frontend.partials.meta')

@section('content')
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="{{ route('home') }}" title="Trở về trang chủ">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <a href="" title="Thông tin tài khoản">Thông tin tài khoản</a>
        </div>
        <!-- ./breadcrumb -->
        <div class="row">
            @include ('frontend.account.sidebar')
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <h1 class="page-heading">
                    <span class="page-heading-title2">Thông tin tài khoản</span>
                </h1>
                <div class="shipping-address-page">              
                <div class="row row-style-2">
                  <div class="col-lg-12">
                    <div class="panel panel-default">
                      
                      <div class="panel-body">
                        <form class="form-horizontal bv-form" role="form" id="address-info" novalidate>
                          <button type="submit" class="bv-hidden-submit" style="width: 0px; height: 0px;"></button>
                          <div class="form-group row">
                            <label for="full_name" class="col-lg-3 control-label visible-lg-block">Họ tên </label>
                            <div class="col-lg-9 input-wrap has-feedback">
                                <input type="text" name="full_name" class="form-control address" id="full_name" value="{{$customer->full_name}}" placeholder="Nhập họ tên" data-bv-field="full_name">
                                <small class="help-block" data-bv-validator="notEmpty" data-bv-for="telephone" data-bv-result="NOT_VALIDATED" style="display: none;">Vui lòng nhập Họ và tên</small>
                           </div>
                          </div>
                          <div class="form-group row">
                            <label for="telephone" class="col-lg-3 control-label visible-lg-block">Điện thoại di động</label>
                            <div class="col-lg-9 input-wrap has-feedback">
                              <input type="tel" name="telephone" class="form-control address" id="telephone" value="{{$customer->phone}}" placeholder="Nhập số điện thoại" data-bv-field="telephone">
                              <small class="help-block" data-bv-validator="notEmpty" data-bv-for="telephone" data-bv-result="NOT_VALIDATED" style="display: none;">Vui lòng nhập Số điện thoại từ 9 - 15 chữ số</small></div>
                          </div>

                          <div class="form-group row">
                            <label for="city_id" class="col-lg-3 control-label visible-lg-block">Tỉnh/Thành phố</label>
                            <div class="col-lg-9 input-wrap has-feedback">
                              <select name="city_id" class="form-control address" id="city_id" data-bv-field="city_id">
                                <option value="">Chọn Tỉnh/Thành phố</option>
                                @foreach($listCity as $city)
                                  <option value="{{$city->id}}"
                                  @if($customer->city_id == $city->id)
                                  selected
                                  @endif
                                  >{{$city->name}}</option>
                                @endforeach
                              </select>
                              <small class="help-block" data-bv-validator="notEmpty" data-bv-for="city_id" data-bv-result="NOT_VALIDATED" style="display: none;">Vui lòng chọn Tỉnh/Thành phố</small></div>
                          </div>
                          <div class="form-group row">
                            <label for="district_id" class="col-lg-3 control-label visible-lg-block">Quận/Huyện</label>
                            <div class="col-lg-9 input-wrap has-feedback">
                              <select name="district_id" class="form-control address" id="district_id">
                                <option value="0">Chọn Quận/Huyện</option>                              
                              </select>
                               <small class="help-block" data-bv-validator="notEmpty" data-bv-for="district_id" data-bv-result="NOT_VALIDATED" style="display: none;">Vui lòng chọn Quận/Huyện</small></div>
                          </div>
                          <div class="form-group row">
                            <label for="ward_id" class="col-lg-3 control-label visible-lg-block">Phường/Xã</label>
                            <div class="col-lg-9 input-wrap has-feedback">
                              <select name="ward_id" class="form-control address" id="ward_id">
                                <option value="0">Chọn Phường/Xã</option>
                              </select>
                               <small class="help-block" data-bv-validator="notEmpty" data-bv-for="ward_id" data-bv-result="NOT_VALIDATED" style="display: none;">Vui lòng chọn Phường/Xã</small></div>
                          </div>
                          <div class="form-group row">
                            <label for="street" class="col-lg-3 control-label visible-lg-block">Địa chỉ</label>
                            <div class="col-lg-9 input-wrap has-feedback">
                              <textarea name="street" class="form-control address" id="street" placeholder="Ví dụ: 52, đường Trần Hưng Đạo" data-bv-field="street" style="height:50px">{{ $customer->address }}</textarea>
                               <span class="help-block"></span> <small class="help-block" data-bv-validator="notEmpty" data-bv-for="street" data-bv-result="NOT_VALIDATED" style="display: none;">Vui lòng nhập Địa chỉ</small></div>
                          </div>
                          <div class="form-group row form-group-radio group-radio-k-address">
                            <label class="col-lg-3 control-label visible-lg-block"></label>
                            <div class="col-lg-9 input-wrap"> <span style="font-size: 11px;font-style: italic;">Để nhận hàng thuận tiện hơn, bạn vui lòng cho iCho biết loại địa chỉ.</span> </div>
                          </div>
                          <div class="form-group row form-group-radio group-radio-k-address">
                            <label class="col-lg-3 control-label visible-lg-block">Loại địa chỉ</label>
                            <div class="col-lg-9 input-wrap has-feedback">
                                <label class="checkbox-inline">
                                  <input type="radio" name="delivery_address_type" value="0" data-bv-field="delivery_address_type"
                                  @if($customer->address_type == 0)
                                  checked
                                  @endif
                                  >
                                   Nhà riêng / Chung cư
                                </label>

                                <label class="checkbox-inline">
                                  <input type="radio" name="delivery_address_type" value="1" data-bv-field="delivery_address_type"
                                  @if($customer->address_type == 1)
                                  checked
                                  @endif
                                  >
                                   Cơ quan / Công ty
                                </label>
                            </div>
                          </div>
                          <div class="form-group row end">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9">
                              <div id="btn-address" class="btn btn-primary btn-custom3" value="update" style="width:120px">Cập nhật</div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="shiping_plan"></div>
                  </div>
                </div>

           </div><!-- /.shipping-address-page -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<div class="clearfix"></div>
@endsection


@section('javascript_page')
   <script type="text/javascript">
    var customer_district_id = '{{ $customer->district_id }}';
    var customer_ward_id = '{{ $customer->ward_id }}';
    $(document).ready(function() {
         
        $('#btn-address').click(function() {
            $(this).attr('disabled', '');
            validateData();
          });
        $('#city_id').change(function() {
            var city_id = $(this).val();

            customer_district_id = '';
            getDistrict(city_id);
          });
          if( $('#city_id').val() > 0){
            getDistrict($('#city_id').val());
          }

          $('#district_id').change(function() {
            var district_id = $(this).val();
            customer_ward_id = '';
            getWard(district_id);
          });
          if( $('#district_id').val() > 0){
            getWard($('#district_id').val());
          }
    });

      function getDistrict(city_id) {

        if(!city_id) {
          $('#district_id').empty();
          $('#district_id').append('<option value="0">Chọn Quận/Huyện</option>');
          return;
        }

        $.ajax({
          url: "{{ route('get-district') }}",
          method: "POST",
          data : {
            id: city_id
          },
          success : function(list_ward){
            $('#district_id').empty();
            $('#district_id').append('<option value="0">Chọn Quận/Huyện</option>');

            for(i in list_ward) {
              $('#district_id').append('<option value="'+list_ward[i].id+'">'+list_ward[i].name+'</option>');
            }
            if( customer_district_id > 0){
              $('#district_id').val(customer_district_id);
              getWard(customer_district_id);
            }

          }
        });
      }
      function getWard(district_id) {

        if(!district_id) {
          $('#ward_id').html('<option value="0">Chọn Phường/Xã</option>');
          return;
        }

        $.ajax({
          url: "{{route('get-ward')}}",
          method: "POST",
          data : {
            id: district_id
          },
          success : function(list_ward){
            $('#ward_id').empty();
            $('#ward_id').append('<option value="0">Chọn Phường/Xã</option>');

            for(i in list_ward) {
              $('#ward_id').append('<option value="'+list_ward[i].id+'">'+list_ward[i].name+'</option>');
            }

            $('#ward_id').val(customer_ward_id);

          }
        });
      }
    function validateData() {
        var error = [];

        var full_name = $('#full_name').val();
        var city_id   = +$('#city_id').val();
        var district_id   = +$('#district_id').val();
        var ward_id   = +$('#ward_id').val();
        var street    = $('#street').val();
        var telephone = $('#telephone').val();

        if(!full_name.length)
        {
          error.push('full_name');
        }

        if(!city_id)
        {
          error.push('city_id');
        }

        if(!district_id)
        {
          error.push('district_id');
        }

        if(!ward_id)
        {
          error.push('ward_id');
        }

        if(!street)
        {
          error.push('street');
        }

        if(!(/\d{8,15}$/g.test(telephone)) ) {
          error.push('telephone');
        }

        var list = ['full_name', 'city_id', 'district_id', 'ward_id', 'street', 'telephone'];

        for( i in list ) {
            $('#' + list[i]).next().hide();
            $('#' + list[i]).parent().removeClass('has-error');
        }

        if(error.length) {
          for( i in error ) {
            $('#' + error[i]).parent().addClass('has-error');
            $('#' + error[i]).next().show();
          }

          $('#btn-address').removeAttr('disabled');
        } else {
          $.ajax({
            url: "{{ route('update-customer') }}",
            method: "POST",
            data : {
              full_name : full_name,
              city_id : city_id,
              district_id : district_id,
              ward_id : ward_id,
              address : street,
              phone : telephone,
              address_type : $('input[name=delivery_address_type]:checked').val()
            },
            success : function(data){
               $('#btn-address').removeAttr('disabled');
              swal({ title: '', text: 'Cập nhật thông tin thành công', type: 'success' });
            }
          });
        }
      }
  </script>
@endsection
