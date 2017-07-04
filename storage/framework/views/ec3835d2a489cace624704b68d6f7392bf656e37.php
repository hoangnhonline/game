<?php if( !empty( $rsUpload )): ?>
	<?php foreach( $rsUpload as $tmp): ?>
	<div class="col-md-3">
		<img class="img-thumbnail" src="<?php echo e(Helper::showImage($tmp['image_path'])); ?>" style="width:100%">
		<div class="checkbox">
		<input type="hidden" name="image_tmp_url[]" value="<?php echo e($tmp['image_path']); ?>">
		<input type="hidden" name="image_tmp_name[]" value="<?php echo e($tmp['image_name']); ?>">
	    <label><input type="radio" name="thumbnail_id" class="thumb" value="<?php echo e($tmp['image_path']); ?>"> Ảnh đại diện </label>
	    <button class="btn btn-danger btn-sm remove-image" type="button" data-value="<?php echo e($tmp['image_path']); ?>" data-id="" >Xóa</button>
	  </div>
	</div>
	<?php endforeach; ?>
<?php endif; ?>