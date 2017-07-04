<?php $__env->startSection('title'); ?><?php echo e($seo['title']); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('site_description'); ?><?php echo e($seo['description']); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('site_keywords'); ?><?php echo e($seo['keywords']); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('site_name'); ?><?php echo e($settingArr['site_name']); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('favicon'); ?><?php echo e(Helper::showImage($settingArr['favicon'])); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('logo'); ?><?php echo e(Helper::showImage($settingArr['logo'])); ?><?php $__env->stopSection(); ?>

