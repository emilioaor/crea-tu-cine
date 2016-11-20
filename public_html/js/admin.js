
function updateFasts(id){

	var download = $('#download'+id).val();
	$('#imgFast'+id).show();

	var data = {
		'id'	: 	id,
		'download'	: 	download
	}

	$.ajax({
		'data'	: data,
		'url'	: '/admin/fast/update',
		'type'	: 'get',
		'success'	: function(){
			$('#imgFast'+id).hide();
		}
	});
}