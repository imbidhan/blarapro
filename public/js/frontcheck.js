$(document).ready(function() {
    $(document).bind("contextmenu",function(e){
        return false;
    });
    $(window).keydown(function(e){
        if(e.keyCode == 13 || e.keyCode == 16 || e.keyCode == 17 || e.keyCode == 18 || e.keycode == 65 || e.keycode == 67  || e.keyCode == 73 || e.keyCode == 80 == e.keyCode == 83 || e.keyCode == 85 || e.keyCode == 86  || e.keyCode == 123) {
            e.preventDefault();
            //alert("Wrong");
            return false;
        }
    });

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $("#refreshBalance").on("click",function(e){

        var base_url = window.location.origin;
        var redirect_url = base_url + '/refresh/user/main/balance/';

        $.ajax({
            type: 'GET',
            url: redirect_url,
            data: {
                _token: CSRF_TOKEN,
            },
            dataType: 'JSON',
            success: function (data) {
                $("#userNewBalance").text('');
                $("#userNewBalance").text(data.totalBalance);
            }
        })
    });
});
