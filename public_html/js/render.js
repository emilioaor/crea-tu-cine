var online = 0;
var download = 0;
function addOnline() {
    online++;
    var onlineHtml = '';
    onlineHtml += '<div class="row rowO' + online + '">';
    onlineHtml += '<div class="col-md-5 form-group">';
    onlineHtml +=       '<label for="title_url">Titulo del video</label>';
    onlineHtml +=       '<input type="text" class="form-control" name="title_online[]" placeholder="Titulo del video" maxlength="20" required="required">';
    onlineHtml += '</div>';
    onlineHtml += '<div class="col-md-5 form-group">';
    onlineHtml +=       '<label for="url">Url</label>';
    onlineHtml +=       '<input type="text" class="form-control" name="url_online[]" placeholder="Url" maxlength="255" required="required">';
    onlineHtml += '</div>';
    onlineHtml += '<div class="col-md-2 form-group">';
    onlineHtml +=       '<br><a href="Javascript:removeOnline(' + online + ')" class="text-danger">(X)</a>';
    onlineHtml += '</div>';
    onlineHtml += '</div>';

    $("#spaceOnline").append(onlineHtml);
}

function addDownload() {
    download++;
    var onlineHtml = '';
    onlineHtml += '<div class="row rowD' + download + '">';
    onlineHtml += '<div class="col-md-5 form-group">';
    onlineHtml +=       '<label for="title">Titulo de la descarga</label>';
    onlineHtml +=       '<input type="text" class="form-control" name="download_title[]" placeholder="Titulo de la descarga" maxlength="20" required="required">';
    onlineHtml += '</div>';
    onlineHtml += '<div class="col-md-5 form-group">';
    onlineHtml +=       '<label for="url">Url</label>';
    onlineHtml +=       '<input type="text" class="form-control" name="download_url[]" placeholder="Url" maxlength="255" required="required">';
    onlineHtml += '</div>';
    onlineHtml += '<div class="col-md-2 form-group">';
    onlineHtml +=       '<br><a href="Javascript:removeDownload(' + download + ')" class="text-danger">(X)</a>';
    onlineHtml += '</div>';
    onlineHtml += '</div>';

    $("#spaceDownload").append(onlineHtml);
}

function removeOnline(id) {
    $(".rowO" + id).html('');
}

function removeDownload(id) {
    $(".rowD" + id).html('');
}

$("#trailer").on("blur", function(){

    if ($("#trailer").match('/^[0-9]/ig')) {
        console.log("SI");
    } else {
        console.log("NO");
    }
});