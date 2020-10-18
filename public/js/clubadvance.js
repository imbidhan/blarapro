$(document).ready(function(){
    $('#advanceMenu').addClass('active');

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(".clickSingleBetDetail").click(function(e){
        e.preventDefault();
        console.log("ok");

        /*Modal Only close by clicking close icon , that king of protection here*/
        $('#placeBetBtn').modal({backdrop: 'static', keyboard: false});

        var betDetailId   = $(this).val();
        var base_url = window.location.origin;
        var redirect_url = base_url + '/show/single/bet/detail/' + betDetailId;

        $.ajax({
            type: 'GET',
            url: redirect_url,
            data: {
                _token: CSRF_TOKEN,
                betDetailId:$(this).val()
            },
            dataType: 'JSON',
            success: function (data) {
                $("#betAmount").val("");
                $("#betDetailQus").text("");
                $("#betDetailAns").text("");
                $("#betDetailRate").val("");
                $("#betEstReturn").val("");
                $("#betDetail_id").val();
                $("#match_id").val();
                $("#betoption_id").val();

                $("#betDetail_id").val(data.id);
                $("#match_id").val(data.match_id);
                $("#betoption_id").val(data.betoption_id);

                $("#betDetailQus").append("Q: "+ data.betoption.betOptionName);
                $("#betDetailAns").append("A: "+ data.betName);
                $("#betDetailRate").val(data.betRate);
                $("#betEstReturn").val(parseFloat(parseInt(0)*parseFloat(data.betRate)).toFixed(2));

            }
        });

    });

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
        $("#placeBetSubmit").addClass('placeBetSubmitCls').prop('disabled', true);
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
