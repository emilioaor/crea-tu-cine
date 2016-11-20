function obtenerVideo(url){
	closeAll();
	$('#loading').show();

	$.ajax({
		"url"	: 	url,
		"type"	:	"get",
		success:function(data){
			$('#spaceVideo').show();
			$('.spaceClose').show();
			$('#spaceVideo').html(data.thevideos);
			$('#loading').hide();
			if(data.thevideos2 != 'NO' ) $('#thevideos2').css('display','block');
		}
	});
}

function Download(){
	closeAll();
	$('.spaceClose').show();
	$('.spaceDownload').show();
}

function closeAll(){
	$('#spaceVideo').html('');
	$('#spaceVideo').hide();
	$('.spaceClose').hide();
	$('.spaceDownload').hide();
	$('#thevideos2').hide();
	$('#loading').hide();
}