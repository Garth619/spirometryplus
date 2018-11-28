jQuery(document).ready(function($){
	"use strict";
	
	/* Select Options */
	$('.ts-importer-wrapper .option label').bind('click', function(){
		var checkbox = $(this).find('input[type="checkbox"]');
		if( checkbox.is(':checked') ){
			$(this).addClass('selected');
		}
		else{
			$(this).removeClass('selected');
		}
		
		ts_import_button_state();
	});
	
	function ts_import_button_state(){
		var disabled = true;
		$('.ts-importer-wrapper .option input[type="checkbox"]').each(function(){
			if( $(this).is(':checked') ){
				disabled = false;
				return;
			}
		});
		$('#ts-import-button').attr('disabled', disabled);
	}
	
	/* Import */
	var ts_import_percent = 0, ts_import_percent_increase = 0, ts_import_index_file = 0;
	var ts_arr_import_data = new Array();
	$('#ts-import-button').bind('click', function(){
		$('.ts-importer-wrapper .option label').unbind('click');
		
		$(this).attr('disabled', true);
		$(this).siblings('.importing-button').removeClass('hidden');
		
		$('.ts-importer-wrapper .import-result').removeClass('hidden');
		
		var import_demo_content = $('#ts_import_demo_content').is(':checked');
		var import_theme_options = $('#ts_import_theme_options').is(':checked');
		var import_widget = $('#ts_import_widget').is(':checked');
		var import_revslider = $('#ts_import_revslider').is(':checked');
		
		if( import_demo_content ){
			var num_content_file = 4;
			for( var i = 1; i <= num_content_file; i++ ){
				var message = '';
				if( i == num_content_file ){
					message = 'Demo Content Imported Successfully';
				}
				if( i < 10 ){
					i = '0' + i;
				}
				var data = {'action' : 'ts_import_content', 'file_name' : 'content_' + i, 'message' : message};
				ts_arr_import_data.push( data );
			}
		}
		
		if( import_theme_options ){
			ts_arr_import_data.push( {'action' : 'ts_import_theme_options', 'message' : 'Theme Options Imported Successfully'} );
		}
		
		if( import_widget ){
			ts_arr_import_data.push( {'action' : 'ts_import_widget', 'message' : 'Widgets Imported Successfully'} );
		}
		
		if( import_revslider ){
			ts_arr_import_data.push( {'action' : 'ts_import_revslider', 'message' : 'Revolution Sliders Imported Successfully'} );
		}
		
		if( import_demo_content ){
			ts_arr_import_data.push( {'action' : 'ts_import_config'} );
		}
		
		var total_ajaxs = ts_arr_import_data.length;
		
		if( total_ajaxs == 0 ){
			return;
		}
		
		ts_import_percent_increase = 100 / total_ajaxs;
		
		ts_import_ajax_handle();
		
	});
	
	function ts_import_ajax_handle(){
		if( ts_import_index_file == ts_arr_import_data.length ){
			ts_add_result_message( 'All Done!!!' );
			$('.ts-importer-wrapper .fa.importing-button').hide();
			return;
		}
		$.ajax({
			type: 'POST'
			,url: ajaxurl
			,async: true
			,data: ts_arr_import_data[ts_import_index_file]
			,complete: function(jqXHR, textStatus){
				ts_import_percent += ts_import_percent_increase;
				ts_progress_bar_handle();
				if( ts_arr_import_data[ts_import_index_file].message ){
					ts_add_result_message( ts_arr_import_data[ts_import_index_file].message );
				}
				ts_import_index_file++;
				setTimeout(function(){
					ts_import_ajax_handle();
				}, 200);
			}
		});
	}
	
	function ts_progress_bar_handle(){
		if( ts_import_percent > 100 ){
			ts_import_percent = 100;
		}
		var progress_bar = $('.ts-importer-wrapper .import-result .progress-bar');
		progress_bar.css({'width': Math.ceil( ts_import_percent ) + '%'});
		progress_bar.html( Math.ceil( ts_import_percent ) + '% Complete');
	}
	
	function ts_add_result_message( message ){
		var message_wrapper = $('.ts-importer-wrapper .messages');
		message_wrapper.append('<p>' + message + '</p>');
	}
	
});
