var sending = false;

function sendEmail() {
	if (sending) return true;

	var name = $("#name").val();
	var phone = $("#phone").val();
	var message = $("#message").val();
	alertInit();

	if (name != '' && phone != '' && message != '') {

		var data = {
			name : name,
			phone : phone,
			message : message
		}

		sendData(data);

	} else {
		if (name == '') $("#alert-name").html('El nombre es requerido');
		if (phone == '') $("#alert-phone").html('El teléfono es requerido');
		if (message == '') $("#alert-message").html('El mensaje es requerido');
		$('.alert-form').css('display','inline-block');
	}
}

function alertInit() {
	$("#alert-name").html('');
	$("#alert-phone").html('');
	$("#alert-message").html('');
	$('.alert-form').css('display','none');
	$("#alert-contact").attr('class', '');
	$("#alert-contact").html('');
}

function sendData(data) {
	sending = true;

	$.ajax({
		url : 'mail/mail.php',
		data : data,
		type : 'post',
		success : function(data) {
			if (data == 'true') {
				renderAlertContactSuccess();
				$("#name").val('');
				$("#phone").val('');
				$("#message").val('');
			} else {
				renderAlertContactError();	
			}
		},
		error : function(error) {
			renderAlertContactError();
		},
		complete : function() {
			sending = false;
		}
	});
}

function renderAlertContactError() {
	$("#alert-contact").attr('class', 'alert-danger');
	$("#alert-contact").html('Ha ocurrido un error');
}

function renderAlertContactSuccess() {
	$("#alert-contact").attr('class', 'alert-success');
	$("#alert-contact").html('Su mensaje fue enviado');
}