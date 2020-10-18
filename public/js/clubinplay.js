$(window).on('load', function() {
    var base_url = window.location.origin;
    var redirect_url = base_url + '/inplay/tab/refresh';

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
$(document).ready(function(){

    $('#inPlayMenu').addClass('active');

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
