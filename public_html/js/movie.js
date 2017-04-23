function renderOnlineVideo(url) {

    var renderHtml = '';
    renderHtml += '<div class="text-center">';
    renderHtml +=   '<button onclick="clearOnlineVideo()" class="btn btn-danger">Cerrar</button>';
    renderHtml += '</div>';
    renderHtml += '<br>';
    renderHtml += '<div class="embed-responsive embed-responsive-16by9">';
    renderHtml +=   '<iframe src="' + url + '" scrolling="no" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen></iframe>';
    renderHtml += '</div>';

    $("#spaceVideo").css('display','block');
    $("#spaceVideo").html(renderHtml);
}

function clearOnlineVideo() {
    $("#spaceVideo").css('display','none');
    $("#spaceVideo").html('');
}