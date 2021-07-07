var EcommerceProductsEdit = function () {

    var handleImages = function() {

        // see http://www.plupload.com/
        var uploader = new plupload.Uploader({
            runtimes : 'html5,flash,silverlight,html4',
             
            browse_button : document.getElementById('tab_images_uploader_pickfiles'), // you can pass in id...
            container: document.getElementById('tab_images_uploader_container'), // ... or DOM Element itself
             
            url : "modules/product/ajax/image_ajax.php",
             
            filters : {
                max_file_size : '10mb',
                mime_types: [
                //                    {title : "Image files", extensions : "jpg,gif,png"},
                {
                    title : "Image files", 
                    extensions : "jpg,png,gif,bmp,jpeg,PNG,JPG,JPEG,GIF,BMP"
                }
                //                    {title : "Zip files", extensions : "zip"}
                ]
            },
         
            // Flash settings
            flash_swf_url : 'assets/plugins/plupload/js/Moxie.swf',
     
            // Silverlight settings
            silverlight_xap_url : 'assets/plugins/plupload/js/Moxie.xap',             
         
            init: {
                PostInit: function() {
                    $('#tab_images_uploader_filelist').html("");
         
                    $('#tab_images_uploader_uploadfiles').click(function() {
                        uploader.start();
                        return false;
                    });
                    
                    $('#tab_images_uploader_filelist').on('click', '.added-files .remove', function(){
                        uploader.removeFile($(this).parent('.added-files').attr("id"));    
                        $(this).parent('.added-files').remove();         
                        var img_id = $(this).attr('id');
                        $.ajax({
                            type: 'POST',
                            url: "modules/product/ajax/remove_image_ajax.php",
                            data: 'img_id='+img_id,                            
                            success: function(resultData) {           
                                         
                            }
                        });
                    });
             
                },
         
                FilesAdded: function(up, files) {                    
                    plupload.each(files, function(file) {
                        $('#tab_images_uploader_filelist').append('<div class="alert alert-warning added-files" id="uploaded_file_' + file.id + '">' + file.name + '(' + plupload.formatSize(file.size) + ') <span class="status label label-info"></span>&nbsp;<a href="javascript:;" style="margin-top:-5px" class="remove pull-right btn btn-sm red remove_tmp_img"><i class="fa fa-times"></i> remove</a></div>');
                    });
                },
         
                UploadProgress: function(up, file) {
                    $('#uploaded_file_' + file.id + ' > .status').html(file.percent + '%');
                },

                FileUploaded: function(up, file, response) {                    
                    var response = $.parseJSON(response.response);                    
                    if (response.result && response.result == 'OK') {
                        var id = response.id; // uploaded file's unique name. Here you can collect uploaded file names and submit an jax request to your server side script to process the uploaded files and update the images tabke

                        $('#uploaded_file_' + file.id + ' > .status').removeClass("label-info").addClass("label-success").html('<i class="fa fa-check"></i> Done'); // set successfull upload
                        $('#uploaded_file_' + file.id + ' a').attr('id', response.tmp_id);
                        $.ajax({
                            type: 'POST',
                            url: "modules/product/ajax/add_image_ajax.php",
                            data: 'img_id='+response.tmp_id,                            
                            success: function(result) {           
                                if(result!=""){
                                    if($('#no_image_avaliable').length==1){
                                        $('#no_image_avaliable').remove();
                                    }
                                    $('#image_tbody').prepend(result);
                                }       
                            }
                        });
                    } else {
                        $('#uploaded_file_' + file.id + ' > .status').removeClass("label-info").addClass("label-danger").html('<i class="fa fa-warning"></i> Failed'); // set failed upload
                        Metronic.alert({
                            type: 'danger', 
                            message: 'One of uploads failed. Please retry.', 
                            closeInSeconds: 10, 
                            icon: 'warning'
                        });
                    }
                },         
                Error: function(up, err) {                   
                    Metronic.alert({
                        type: 'danger', 
                        message: err.message, 
                        closeInSeconds: 10, 
                        icon: 'warning'
                    });
                }
            }
        });

        uploader.init();

    }
    
    var handleColorImages = function() {

        // see http://www.plupload.com/
        var uploader = new plupload.Uploader({
            runtimes : 'html5,flash,silverlight,html4',
             
            browse_button : document.getElementById('tab_color_images_uploader_pickfiles'), // you can pass in id...
            container: document.getElementById('tab_color_images_uploader_container'), // ... or DOM Element itself
             
            url : "modules/product/ajax/color_image_ajax.php",
             
            filters : {
                max_file_size : '10mb',
                mime_types: [
                //                    {title : "Image files", extensions : "jpg,gif,png"},
                {
                    title : "Image files", 
                    extensions : "jpg,png,gif,bmp,jpeg,PNG,JPG,JPEG,GIF,BMP"
                }
                //                    {title : "Zip files", extensions : "zip"}
                ]
            },
         
            // Flash settings
            flash_swf_url : 'assets/plugins/plupload/js/Moxie.swf',
     
            // Silverlight settings
            silverlight_xap_url : 'assets/plugins/plupload/js/Moxie.xap',             
         
            init: {
                PostInit: function() {
                    $('#tab_color_images_uploader_filelist').html("");
         
                    $('#tab_color_images_uploader_uploadfiles').click(function() {
                        uploader.start();
                        return false;
                    });
                    
                    $('#tab_color_images_uploader_filelist').on('click', '.added-files .remove', function(){
                        uploader.removeFile($(this).parent('.added-files').attr("id"));    
                        $(this).parent('.added-files').remove();         
                        var img_id = $(this).attr('id');
                        $.ajax({
                            type: 'POST',
                            url: "modules/product/ajax/remove_image_ajax.php",
                            data: 'img_id='+img_id,                            
                            success: function(resultData) {           
                                         
                            }
                        });
                    });                
                },
         
                FilesAdded: function(up, files) {                    
                    plupload.each(files, function(file) {
                        $('#tab_color_images_uploader_filelist').append('<div class="alert alert-warning added-files" id="uploaded_file_' + file.id + '">' + file.name + '(' + plupload.formatSize(file.size) + ') <span class="status label label-info"></span>&nbsp;<a href="javascript:;" style="margin-top:-5px" class="remove pull-right btn btn-sm red remove_tmp_img"><i class="fa fa-times"></i> remove</a></div>');
                    });
                },
         
                UploadProgress: function(up, file) {
                    $('#uploaded_file_' + file.id + ' > .status').html(file.percent + '%');
                },

                FileUploaded: function(up, file, response) {                    
                    var response = $.parseJSON(response.response);                    
                    if (response.result && response.result == 'OK') {
                        var id = response.id; // uploaded file's unique name. Here you can collect uploaded file names and submit an jax request to your server side script to process the uploaded files and update the images tabke

                        $('#uploaded_file_' + file.id + ' > .status').removeClass("label-info").addClass("label-success").html('<i class="fa fa-check"></i> Done'); // set successfull upload
                        $('#uploaded_file_' + file.id + ' a').attr('id', response.tmp_id);
                        $.ajax({
                            type: 'POST',
                            url: "modules/product/ajax/add_image_ajax.php",
                            data: 'img_id='+response.tmp_id,                            
                            success: function(result) {           
                                if(result!=""){
                                    if($('#no_color_image_avaliable').length==1){
                                        $('#no_color_image_avaliable').remove();
                                    }
                                    $('#color_image_tbody').prepend(result);
                                }       
                            }
                        });
                    } else {
                        $('#uploaded_file_' + file.id + ' > .status').removeClass("label-info").addClass("label-danger").html('<i class="fa fa-warning"></i> Failed'); // set failed upload
                        Metronic.alert({
                            type: 'danger', 
                            message: 'One of uploads failed. Please retry.', 
                            closeInSeconds: 10, 
                            icon: 'warning'
                        });
                    }
                },         
                Error: function(up, err) {                   
                    Metronic.alert({
                        type: 'danger', 
                        message: err.message, 
                        closeInSeconds: 10, 
                        icon: 'warning'
                    });
                }
            }
        });

        uploader.init();

    }

    

     

    var initComponents = function () {
        //init datepickers
        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            autoclose: true
        });

        //init datetimepickers
        $(".datetime-picker").datetimepicker({
            isRTL: Metronic.isRTL(),
            autoclose: true,
            todayBtn: true,
            pickerPosition: (Metronic.isRTL() ? "bottom-right" : "bottom-left"),
            minuteStep: 10
        });

        //init maxlength handler
        $('.maxlength-handler').maxlength({
            limitReachedClass: "label label-danger",
            alwaysShow: true,
            threshold: 5
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            initComponents();
            handleColorImages();
            handleImages();
           
        }

    };

}();