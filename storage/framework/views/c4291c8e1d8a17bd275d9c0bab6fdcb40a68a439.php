<?php $__env->startSection('search'); ?>
<section class="block-search">
	<div class="container">
		<div class="block-title block-tab-customize">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist" id="tab-search">
				<li role="presentation" class="active"><a href="javascript:void(0)" data-type="1" >BẤT ĐỘNG SẢN BÁN</a></li>
				<li role="presentation"><a href="javascript:void(0)" data-type="2" >BẤT ĐỘNG SẢN CHO THUÊ</a></li>
			</ul>
		</div>
		<div class="block-contents">
			<!-- Tab panes -->
			  <div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="home">
			    	<form action="<?php echo e(route('search')); ?>" method="GET" accept-charset="utf-8" class="search-content-input selectpicker-cus">
			    		<input type="hidden" id="type" value="1" name="type">				    	
				    	<div class="row-select">
							<div class="col-xs-2">
								<div class="form-group">
									<select class="selectpicker form-control" data-live-search="true" name="estate_type_id" id="estate_type_id">
										<option selected="selected" value="">Loại bất động sản</option>
										<?php foreach($banList as $ban): ?>
										<option value="<?php echo e($ban->id); ?>"><?php echo e($ban->name); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>								
							<div class="col-xs-2">
								<div class="form-group">
									<select class="selectpicker form-control" data-live-search="true" id="district_id" name="district_id">
										<option value="">Quận/Huyện</option>
										<?php foreach($districtList as $district): ?>
										<option value="<?php echo e($district->id); ?>"><?php echo e($district->name); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group">
									<select class="selectpicker form-control" data-live-search="true" id="ward_id" name="ward_id">
										<option value="">Phường/Xã</option>
										
									
									</select>
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group">
									<select class="selectpicker form-control" id="street_id" name="street_id" data-live-search="true">
										<option value="">Đường/Phố</option>
									</select>
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group">
									<select class="selectpicker form-control" data-live-search="true" id="project_id" name="project_id">
										<option value="">Dự án</option>
									</select>
								</div>
							</div>
							
							<div class="col-xs-2">
								<div class="form-group">
									<select class="selectpicker form-control" data-live-search="true" name="price_id" id="price_id">
										<option value="">Mức giá</option>
										<?php foreach($priceList as $price): ?>
										<option  value="<?php echo e($price->id); ?>"><?php echo e($price->name); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							
						</div>
						<div class="row-select">
							<div class="col-xs-2">
								<div class="form-group">
									<select class="selectpicker form-control" id="area_id" name="area_id" data-live-search="true">
										<option value="">Diện tích</option>
										<?php foreach($areaList as $area): ?>
										<option value="<?php echo e($area->id); ?>"><?php echo e($area->name); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group">
									<select class="selectpicker form-control" data-live-search="true" name="direction_id">
										<option value="">Hướng nhà</option>
										<?php foreach($directionList as $dir): ?>
										<option value="<?php echo e($dir->id); ?>"><?php echo e($dir->name); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group">
									<select class="selectpicker form-control" data-live-search="true" name="no_room">
										<option value="">Số phòng ngủ</option>
										<option value="1">1+</option>
										<option value="2">2+</option>
										<option value="3">3+</option>
										<option value="4">4+</option>
										<option value="5">5+</option>
										<option value="6">6+</option>
									</select>
								</div>
							</div>								
							<div class="col-xs-2 col-button">
								<div class="form-group">
									<button type="submit" id="btnSearch" class="btn btn-success btn-search-home"><i class="fa fa-search"></i> Tìm Kiếm</button>
								</div>
							</div>
						</div>
			    	</form>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="profile">
			    	
			    </div>
			  </div>
		</div>
	</div>
</section><!-- /block-search -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript_page'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#btnSearch').click(function(){		
			if($('#estate_type_id').val() == ''){
				swal({ title: '', text: 'Vui lòng chọn loại bất động sản.', type: 'error' });
				return false;
			}		
		});
		$('#tab-search li a').click(function(){
			obj = $(this);
			var type = obj.data('type');
			$('#type').val(type);
			$('#tab-search li').removeClass('active');
			obj.parents('li').addClass('active');

			$.ajax({
				url : '<?php echo e(route('get-child')); ?>',
				data : {
					mod : 'estate_type',
					col : 'type',
					id : type
				},
				type : 'POST',
				dataType : 'html',
				success : function(data){
					$('#estate_type_id').html(data).selectpicker('refresh');
				}
			});
			$.ajax({
				url : '<?php echo e(route('get-child')); ?>',
				data : {
					mod : 'price',
					col : 'type',
					id : type
				},
				type : 'POST',
				dataType : 'html',
				success : function(data){
					$('#price_id').html(data).selectpicker('refresh');
				}
			});
		});
	});

</script>
<?php $__env->stopSection(); ?>