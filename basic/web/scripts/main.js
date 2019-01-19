/**
 * Created by root on 05.03.2017.
 */

$(document).ready(function(){
    var lastTab = localStorage.getItem('lastTab');
    if (lastTab!=null) {
        $(' a[href="#myveryownID' + lastTab + '"]').trigger('click');
    }
    localStorage.setItem('lastTab',null);

    $(".delete_marathon_for_user").on("click",function(){
        var checkboxy=$("#myveryownID2 .kv-row-checkbox:checked").length;
        if(checkboxy) {
            if (confirm("Jesteś pewien, że chcesz usunąć te elementy?")) {
                var idki = [];
                $("#myveryownID2 .kv-row-checkbox:checked").each(function () {
                    idki.push($(this).parent().parent().find("td[data-col-seq='0']").html());
                });
                $.ajax({
                    data:{
                        idk:idki
                    },
                    url: "index.php?r=site%2Fdropmarathonforuser",
                    error: function(data) {
                        console.log(data);
                    },
                    success: function(data) {
                        if(data=="ok"){
                            localStorage.setItem("lastTab",2);
                            location.reload();
                        } else {
                            alert("Wystąpił błąd przy usuwaniu maratonu biegacza, spróbuj jeszcze raz!");
                        }
                    }
                });
            }
        }
    });

    $(".delete_interview").on("click",function(){
        var checkboxy=$(".kv-row-checkbox:checked").length;

        if(checkboxy){
            if(confirm("Jesteś pewien, że chcesz usunąć te elementy?")){
                var idki=[];
                $("#myveryownID3 .kv-row-checkbox:checked").each(function(){
                    idki.push($(this).parent().parent().find("td[data-col-seq='0']").html());
                });
                $.ajax({
                    data:{
                        idk:idki
                    },
                    url: "index.php?r=site%2Fdropinterview",
                    error: function(data) {
                        console.log(data);
                    },
                    success: function(data) {
                        if(data=="ok"){
                            localStorage.setItem("lastTab",3);
                            location.reload();
                        } else {
                            alert("Wystąpił błąd przy dodawaniu notatki, spróbuj jeszcze raz!");
                        }
                    }
                });
            }
        }
    });

    $(".add_interview").on("click",function(){
        //$("#datas-form").toggle().css("display","block");

        $("#new_interview_dialog").dialog("open");
    });

    $("#add_new_reminder_default").on("click",function(){
        //$("#datas-form").toggle().css("display","block");

        $("#new_reminder_dialog").dialog("open");
    });

    $("#get_auth_card_user").on("click",function(){
        if(confirm("Jesteś pewien, że chcesz dokonać autoryzacji tej karty ?")){
            $.ajax({
                data:{kwota:$("#form_final_result").val()},
                url: "index.php?r=site%2Fauth",
                error: function(data) {
                    console.log(data);
                },
                success: function(data) {

                    $("#show_results_textarea").val(data);

                }
            });
        }
    });

    $("#form_count_from_percent").on("click",function(){
        var form_kwota=$("#form_kwota").val();
        var form_procent=$("#form_procent").val();
        var wynik=(form_procent/100)*form_kwota;
        $("#form_final_result").val(wynik);
        console.log("cholera");

    });

    $("#get_payment_user").on("click",function(){
        if(confirm("Jesteś pewien, że chcesz dokonać wypłaty z karty ?")){

            if($("#is_send_mail_to_user").prop("checked")){
                var zaznaczone_biegi=$("#myveryownID2 table tr td:nth-child(5) input:checked");
                var zaznaczony_bieg=0;
                for(var i=0;i<zaznaczone_biegi.length;i++ ){
                    if(zaznaczony_bieg==0){
                        zaznaczony_bieg=zaznaczone_biegi[i].value;
                    }
                }
                if(zaznaczony_bieg==0){
                    alert("Musisz wybrać bieg za który zostanie pobrana kwota!");
                } else {
                    $.ajax({
                        data:{
                            kwota: $("#form_final_result").val(),
                            zaznaczony_bieg:zaznaczony_bieg,
                            odbiorca:$("#users-email").val(),//"mahuda94@interia.pl",
                            tytul:"Arunz - Podsumowanie płatności"
                        },
                        url: "index.php?r=mail%2Findex",
                        error: function(data) {
                            console.log(data);
                        },
                        success: function(data) {
                            $.ajax({
                                data:{
                                    idu:$("#id_userka").val(),
                                    idm:zaznaczony_bieg,
                                    nr_card: $("#users-nr_card").val(),
                                    date_card: $("#users-date_card").val(),
                                    uname_card: $("#users-uname_card").val(),
                                    surname_card: $("#users-surname_card").val(),
                                    cvv_cvc: $("#users-cvv_cvc").val(),
                                    users_email: $("#users-email").val(),
                                    uname: $("#users-uname").val(),
                                    surname: $("#users-surname").val(),
                                    kwota:$("#form_final_result").val()
                                },
                                url: "index.php?r=site%2Fpay",
                                error: function(data) {
                                    console.log(data);
                                },
                                success: function(data) {
                                    //alert(data);
                                    $("#show_results_textarea").val(data);
                                }
                            });
                        }
                    });
                }
            }
        }
    });

    $("#create_reminder").on("click",function(){
        if(confirm("Jesteś pewien, że chcesz utworzyć przypominajke ?")){
            $.ajax({
                data:{
                    id_operator:$("#hidden_id").val(),
                    idu:$("#id_userka").val(),
                    note:$("#dp_1").val(),
                    datetime:$("#dp_2").val()
                },
                url: "index.php?r=site%2Faddreminder",
                error: function(data) {
                    console.log(data);
                },
                success: function(data) {
                    alert(data);
                    if(data=="ok"){
                        localStorage.setItem("lastTab",4);
                        location.reload();
                    } else {
                        alert("Wystąpił błąd przy dodawaniu przypominajki, spróbuj jeszcze raz!");
                    }
                }
            });
        }
    });
} );