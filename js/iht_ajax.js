function commonLoad(url, so_obj, des_obj){
	$.ajax({
	   type: 'GET',
	   url : url + $(so_obj).val(),
	   dataType: 'json',
	   success: function(data){
	   		$('#'+des_obj).html(data.content);
	   }
	});
}