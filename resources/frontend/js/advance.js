$(document).ready(function(){
    $('#advanceMenu').addClass('active');

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(".clickSingleBetDetail").click(function(e){

        e.preventDefault();

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
        $("#placeBetSubmit").show();
        $("#modalCustomBodyId").show();
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
        $("#placeBetSubmit").hide();
        $("#betAmount").addClass('placeBetSubmitCls');

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var base_url = window.location.origin;
        var redirect_url  = base_url + '/store/place/bet';
        var betDetailRate = $("#betDetailRate").val();
        var betAmount     = $("#betAmount").val();
        $("#betAmount").val("");

        $("#processingMsg").html("Bet processing take little time ..... ");

        $.ajax({
            type: 'POST',
            url: redirect_url,
            data: {"_token": CSRF_TOKEN,
                betDetail_id  : $("#betDetail_id").val(),
                match_id      : $("#match_id").val(),
                betoption_id  : $("#betoption_id").val(),
                betDetailRate : $("#betDetailRate").val(),
                betAmount     : betAmount,
                betMinimum    : $("#betMinimum").val(),
                betMaximum    : $("#betMaximum").val(),
            },
            //dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {

                $("#modalCustomBodyId").hide();
                $("#betAmount").removeClass('placeBetSubmitCls');
                $("#betAmount").val("");
                $("#betEstReturn").val(parseFloat(parseInt(0)*parseFloat(betDetailRate)).toFixed(2));

                if(data.errorLogin){
                    $("#errorLogin").html("");
                    $("#processingMsg").html("");
                    $("#successMsg").html("");
                    $("#errorLogin").html(data.errorLogin);
                }

                if(data.errorMsg){
                    $("#errorLogin").html("");
                    $("#processingMsg").html("");
                    $("#errorMsg").html("");
                    $("#successMsg").html("");
                    $("#errorMsg").html(data.errorMsg);
                }

                if(data.successMsg){
                    $("#errorLogin").html("");
                    $("#processingMsg").html("");
                    $("#errorMsg").html("");
                    $("#successMsg").html("");
                    $("#successMsg").html(data.successMsg);
                }
            }
        });
    });
});
