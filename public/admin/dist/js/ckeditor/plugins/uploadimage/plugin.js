CKEDITOR.plugins.add('uploadimage',
    {
        init: function (editor) {
            var commandName = 'uploadimage';
            editor.ui.addButton('uploadimage', {
                label: 'Insert Image',
                command: commandName,
                icon: this.path + 'images/icon.png',
            });

            function addButtonAndItem(definition, execCode, listener) {
                editor.addCommand(definition.command, {
                    exec: execCode
                });

                if (editor.addMenuItem)
                    editor.addMenuItem(definition.command, definition);

                if (editor.contextMenu)
                    editor.contextMenu.addListener(listener);
            }

            editor.addMenuGroup('Image');

            addButtonAndItem({
                command: commandName,
                label: 'Chèn ảnh...',
                icon: this.path + 'images/icon.png',
                group: 'link',
                order: 10
            }, function (editor) {
                var box = $('#box_uploadimages'),
                    button = box.find('#button_browse'),
                    loading = box.find('.loading');
                    loading.hide();

                box.dialog({
                    modal: true,
                    title: 'Chèn ảnh',
                    width: 350,
                    height: 200,
                    draggable: true,
                    resizable: false                    
                });
                var bar = $('.bar_upload');
                var percent = $('.percent_upload');
                var status = $('#status');
                $('#myfile').replaceWith('<input style="border-radius:2px;" type="file" id="myfile" name="myfile[]" multiple/>');
                $('#myfile').change(function(){
                    $('#upload_files_new').submit();
                })
                $('#upload_files_new').ajaxForm({
                    beforeSend: function() {
                        status.empty();
                        var percentVal = '0%';
                        bar.width(percentVal);
                        percent.html(percentVal);
                        $('.progress_upload').show();
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentVal = percentComplete + '%';
                        if(percentComplete == 100) percentVal = 'Done';
                        bar.width(percentVal);
                        if(percentComplete < 50){
                            percent.css('color','black');
                        }else{
                            percent.css('color','white');
                        }
                        percent.html(percentVal);                   
                    },
                    success: function() {
                        var percentVal = '100%';
                        bar.width(percentVal);
                        percent.html('Done');
                    },
                    complete: function(xhr) {
                        $('.progress_upload').hide();
                        var percentVal = '0%';
                        bar.width(percentVal);
                        percent.html(percentVal);
                        var response = jQuery.parseJSON($.trim(xhr.responseText));
                        var files = response.fileList,                            
                            html = "";
                        var editor = $('#editor').val();
                            
                                var    editorTemp = CKEDITOR.instances[editor];        
                                var   edi_parent = $(CKEDITOR.instances[editor].document.getBody().$);                      
                            var  get_html,
                            count_img = edi_parent.find('img').length,
                            getParentNode = editorTemp.getSelection().getRanges()[0].startContainer,
                            table = $('<div></div>'),
                            getChildSelected = editorTemp.getSelection().getSelectedElement(),
                            insertMoreImg = false;
                            for (var i in files) {
                                var elementImg = editorTemp.document.createElement('img');
                                elementImg.$.setAttribute('src', files[i].filename);
                                elementImg.$.style.maxWidth="600px";
                                html = $('<table width="100%" border="0" cellpadding="3" width="1" cellspacing="0" align="center" ><tr><td style="text-align:center"></td></tr><tr><td><p style="text-align:center">[Caption]</p></td></tr></table>');
                                html.find('td:eq(0)').append($(elementImg.$));
                                table.append(html);
                      
                            }
                            editorTemp.insertHtml(table.html());
                        loading.hide();
                        box.dialog('close');
                    }
                });

                return false;

            }, function (elem, select) {

                if (!elem || (elem.is('h1') && elem.hasClass('Title')) || (elem.is('h2') && elem.hasClass('Lead')) || elem.data('cke-realelement') || elem.isReadOnly())
                    return null;

                if (elem.hasAttribute('data-component'))
                    return null;

                return {
                    uploadimage: CKEDITOR.TRISTATE_OFF
                };
            });
        }
    });