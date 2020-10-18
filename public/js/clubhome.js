
$(window).on('load', function() {
    var base_url = window.location.origin;
    var redirect_url = base_url + '/home/tab/refresh/';

    var betAmount = $("#betAmount").val();
    var betMinimum = $("#betMinimum").val();

    if(betAmount < betMinimum){
        $("#placeBetSubmit").addClass('placeBetSubmitCls').prop('disabled', true);
    } else {
        $("#placeBetSubmit").removeClass('placeBetSubmitCls').prop('disabled', false);
    }

    $.ajax({
        type: 'GET',
        url: redirect_url,
        success: function (data) {
            $("#appendTab").empty();
            $("#appendTab").append(data.tabRefreshData);
        }
    });
});


(function update() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var base_url = window.location.origin;
    var redirect_url = base_url + '/home/tab/refresh';

    var activeMenuId = $("a.nav-link.active").attr("id");
    var activeContentId = activeMenuId.slice(0,-4);

    $.ajax({
        type: 'GET',
        url: redirect_url,
        success: function (data) {
            $("#appendTab").empty();
            $("#appendTab").append(data.tabRefreshData);
            $("#all").removeClass("show active");
            $("#"+activeContentId).addClass("show active");
        }                     // pass existing options
    }).then(function() {           // on completion, restart
        setTimeout(update, 6000);  // function refers to itself
    });
})();

$(document).ready(function(){

    $('#homeMenu').addClass('active');


    $('#customModelClose').on("click",function(){
        $("#betAmount").val("");
        $("#betDetailQus").text("");
        $("#betDetailAns").text("");
        $("#betDetailRate").val("");
        $("#betEstReturn").val(0.00);

        $("#errorLogin").html("");
        $("#processingMsg").html("");
        $("#errorMsg").html("");
        $("#successMsg").html("");

        if($("#betDetailQus").text().length === 0 || $("#betDetailAns").text().length === 0 || $("#betDetailRate").val().length === 0){
            $("#placeBetSubmit").addClass('placeBetSubmitCls').prop('disabled', true);
        }
    });

    // Change bet amount value
    $("#betAmount").on('keyup keydown change',function(e){

        var betRate   = $("#betDetailRate").val();
        var betAmount = parseInt($(this).val());
        var estAmount = parseFloat(betRate * betAmount);
        var betMinimum = parseInt($("#betMinimum").val());
        var betMaximum = parseInt($("#betMaximum").val());
        if($(this).val().length === 0){
            $("#betEstReturn").val("0.00");
        }else{
            $("#betEstReturn").val(estAmount.toFixed(2));
        }

        if(betAmount < betMinimum || betAmount > betMaximum || $(this).val().length === 0 || $("#betDetailQus").text().length === 0 || $("#betDetailAns").text().length === 0 || $("#betDetailRate").val().length === 0){
            $("#placeBetSubmit").addClass('placeBetSubmitCls').prop('disabled', true);
        } else {
            $("#placeBetSubmit").removeClass('placeBetSubmitCls').prop('disabled', false);
        }

    });

    $("#placeBetSubmit").click(function(e){
        e.preventDefault();

        $("#errorLogin").html("");
        $("#processingMsg").html("");
        $("#successMsg").html("");
        $("#errorLogin").html('["error":"Login first as a user."]');

    });
});
