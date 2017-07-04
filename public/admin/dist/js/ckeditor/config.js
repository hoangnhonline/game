/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
var strPlugins = 'uploadimage';

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	CKEDITOR.config.filebrowserBrowseUrl = CKEDITOR.plugins.getPath('ajaxfilemanager') + 'ajaxfilemanager.php';
	CKEDITOR.config.filebrowserFlashBrowseUrl = CKEDITOR.plugins.getPath('ajaxfilemanager') + 'ajaxfilemanager.php';
	CKEDITOR.config.filebrowserFlashUploadUrl = '/upload/';
	CKEDITOR.config.filebrowserImageBrowseLinkUrl = CKEDITOR.plugins.getPath('ajaxfilemanager') + 'ajaxfilemanager.php';
	CKEDITOR.config.filebrowserImageBrowseUrl = CKEDITOR.plugins.getPath('ajaxfilemanager') + 'ajaxfilemanager.php';	
	CKEDITOR.config.filebrowserImageUploadUrl = '/upload/';
	CKEDITOR.config.filebrowserUploadUrl = '/upload/';
	CKEDITOR.config.htmlEncodeOutput = false;
	CKEDITOR.config.basicEntities = true;
	config.extraPlugins = strPlugins;
	CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_P;
	CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
};
