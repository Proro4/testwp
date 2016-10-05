jQuery(document).ready(function($) {
    
    jQuery('.rcl-public-editor .rcl-upload-box .upload-image-url').live('keyup',function(){        
        var content = jQuery(this).val();
        //console.log(content);
        var idbox = jQuery(this).parents('.rcl-upload-box').attr('id');
        var res = rcl_is_valid_url(content);
        if(!res) return false;

        rcl_preloader_show('#'+idbox);
        var parent = jQuery(this).parent();
        var dataString = 'action=rcl_upload_box&url_image='+content;
        dataString += '&ajax_nonce='+Rcl.nonce;
        jQuery.ajax({
            type: 'POST', 
            data: dataString, 
            dataType: 'json', 
            url: Rcl.ajaxurl,
            success: function(data){

                if(data['error']){
                    rcl_notice(data['error'],'error');
                    rcl_preloader_hide();
                    return false;
                }

                jQuery('#'+idbox).html(data[0]['content']);
                rcl_preloader_hide();

            }			
        });
        return false;
    });

});

function rcl_add_editor_box(e,type,idbox,content){
    rcl_preloader_show(e);
    var dataString = 'action=rcl_add_editor_box';
    if(type) dataString += '&type='+type;
    if(idbox) dataString += '&idbox='+idbox;
    dataString += '&ajax_nonce='+Rcl.nonce;
    jQuery.ajax({
        type: 'POST', 
        data: dataString, 
        dataType: 'json', 
        url: Rcl.ajaxurl,
        success: function(data){
            if(data['error']){
                rcl_notice(data['error'],'error');
                return false;
            }
            var editor = jQuery(e).parents('.rcl-public-editor');
            editor.children('.rcl-editor-content').append(data['content']);
            if(content) jQuery('#rcl-upload-'+idbox).html(content);
            rcl_preloader_hide();
            return true;
        }			
    }); 
    return false;
}
	
function rcl_delete_editor_box(e){
	var box = jQuery(e).parents('.rcl-content-box');
	box.remove();
	return false;
}

function rcl_delete_post(element){
    rcl_preloader_show(element);
    var post_id = jQuery(element).data('post');
    var dataString = 'action=rcl_ajax_delete_post&post_id='+post_id;
    dataString += '&ajax_nonce='+Rcl.nonce;
    jQuery.ajax({
        type: 'POST', data: dataString, dataType: 'json', url: Rcl.ajaxurl,
        success: function(data){
            rcl_preloader_hide();
            if(data['error']){
                rcl_notice(data['error'],'error');
                return false;
            }
            jQuery('#'+data['post_type']+'-'+post_id).remove();
            rcl_notice(data['success'],'success');
        }
    });
    return false;
}

function rcl_edit_post(element){
    var id_contayner = 'rcl-popup-content';	
    jQuery('body > div').last().after('<div id=\''+id_contayner+'\' title=\''+Rcl.local.edit_box_title+'\'></div>');
    var contayner = jQuery( '#'+id_contayner );
    contayner.dialog({
        modal: true,
        resizable: false,
        width:500,
        dialogClass: 'rcl-edit-post-form',
        close: function (e, data) {
            jQuery( this ).dialog( 'close' );
            contayner.remove();
        },
        open: function (e, data){
            var post_id = jQuery(element).data('post');
            var dataString = 'action=rcl_get_edit_postdata&post_id='+post_id;
            dataString += '&ajax_nonce='+Rcl.nonce;
            jQuery.ajax({
                    type: 'POST', data: dataString, dataType: 'json', url: Rcl.ajaxurl,
                    success: function(data){                                   
                        if(data['error']){
                            rcl_notice(data['error'],'error');
                            return false;
                        }                                   
                        if(data['result']==100){
                            contayner.html(data['content']);
                        }
                    }
            });				
        },
        buttons: [{
          text: Rcl.local.save,
          icons: {
                primary: "ui-icon-disk"
          },
          click: function() {
                var postdata   = jQuery('#'+id_contayner+' form').serialize();
                var dataString = 'action=rcl_edit_postdata&'+postdata;
                dataString += '&ajax_nonce='+Rcl.nonce;
                jQuery.ajax({
                type: 'POST', data: dataString, dataType: 'json', url: Rcl.ajaxurl,
                success: function(data){
                    if(data['error']){
                        rcl_notice(data['error'],'warning');
                        return false;
                    }  
                    if(data['result']==100){
                        rcl_notice(data['content'],'success');
                    }
                }
                });
          }
        },
        {
          text: Rcl.local.close,
          icons: {
                primary: "ui-icon-closethick"
          },
          click: function() {
                jQuery( this ).dialog( "close" );
          }
        }]
    });
}

function rcl_init_upload_box(idbox){
	
    rcl_add_dropzone('#rcl-upload-'+idbox);

    var cntFiles = 0;

    jQuery('#rcl-upload-'+idbox+' .rcl-box-uploader').fileupload({
        dataType: 'json',
        type: 'POST',
        singleFileUploads:false,
        url: Rcl.ajaxurl,
        formData:{action:'rcl_upload_box',ajax_nonce:Rcl.nonce},
        dropZone: jQuery('#rcl-upload-'+idbox),
        change: function (e, data){				
                rcl_preloader_show('#rcl-upload-'+idbox);
        },
        done: function (e, data) {				
            if(data.result['error']){
                rcl_notice(data.result['error'],'error');
                rcl_preloader_hide();
                return false;
            }
            var id = idbox;
            jQuery.each(data.files, function (index, file) {
                if(cntFiles>=1){
                        id++;
                        rcl_add_editor_box('#rcl-upload-'+idbox,'image',id,data.result[cntFiles]['content']);					
                }else{
                        jQuery('#rcl-upload-'+idbox).html(data.result[cntFiles]['content']);
                }
                cntFiles++;
            });
            rcl_preloader_hide();
        }
    });
	
}

function rcl_preview(e){

	var submit = jQuery(e);
	var formblock = submit.parents('form');
	var required = true;

	formblock.find(':required').each(function(){
            if(!jQuery(this).val()){
                    jQuery(this).css('box-shadow','0px 0px 1px 1px red');
                    required = false;
            }else{
                    jQuery(this).css('box-shadow','none');
            }
	});
        
        if(formblock.find( 'input[name="cats[]"]' ).length > 0){             
            if(formblock.find('input[name="cats[]"]:checked').length == 0){
                formblock.find( 'input[name="cats[]"]' ).css('box-shadow','0px 0px 1px 1px red');
                required = false;
            }else{
                formblock.find( 'input[name="cats[]"]' ).css('box-shadow','none');
            }
        }

	if(!required){
            rcl_notice(Rcl.local.requared_fields_empty,'error');
            return false;
	}

        submit.attr('disabled',true).val(Rcl.local.wait+'...');
	
	var iframe = jQuery("#contentarea_ifr").contents().find("#tinymce").html();
	if(iframe){
            tinyMCE.triggerSave();
            formblock.find('textarea[name="post_content"]').html(iframe);
        }
	
        var string   = formblock.serialize();

	var dataString = 'action=rcl_preview_post&'+string;
        dataString += '&ajax_nonce='+Rcl.nonce;
	jQuery.ajax({
            type: 'POST', 
            data: dataString, 
            dataType: 'json', 
            url: Rcl.ajaxurl,
            success: function(data){

                if(data['error']){
                    rcl_notice(data['error'],'error');
                    submit.attr('disabled',false).val(Rcl.local.preview);
                    return false;
                }

                if(data['content']){
                    formblock.children().last('div').after(data['content']);
                    var height = jQuery("#rcl-preview").height()+100;
                    jQuery("#rcl-preview").parent().height(height);
                    var offsetTop = jQuery("#rcl-preview").offset().top;
                    jQuery('body,html').animate({scrollTop:offsetTop -50}, 500);
                    submit.attr('disabled',false).val(Rcl.local.preview);
                    return true;
                }

                submit.attr('disabled',false).val(Rcl.local.preview);
                rcl_notice(Rcl.local.error,'error');

            }
	}); 
	return false;

}

function rcl_get_prefiew_content(formblock,iframe){
    formblock.find('textarea[name="post_content"]').html(iframe);
    return formblock.serialize();
}

function rcl_preview_close(e){
	var preview = jQuery(e).parents('#rcl-preview');
	preview.parent().removeAttr('style');
	var offsetTop = preview.offset().top;
	jQuery('body,html').animate({scrollTop:offsetTop -50}, 500);
	preview.remove();	
}