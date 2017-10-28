var blockLike = false;

function like(user, slug) {

    if (! blockLike) {

        var url = '/cine/' + user + '/movies/' + slug + '/like';

        var data = {
            user : user,
            slug : slug,
            _token : $("#tokenLike").val()
        };

        $.ajax({
            url : url,
            data : data,
            type : 'post',
            beforeSend : function () {
              blockLike = true;
            },
            success : function (data) {

                if (data.ok && data.action == 'like') {
                    $("#like").attr('class','btn-like-clicked');
                } else {
                    $("#like").attr('class','btn-like');
                }

                $("#numLike").html(data.count);
            },
            error : function (error) {

            },
            complete : function () {
                blockLike = false;
            }
        });
    }
}
