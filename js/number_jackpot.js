function number_winner() {
    let year = $("#ev_valaszt").val();
    let szam1 = $("#szam1").val();
    let szam2 = $("#szam2").val();
    $("#adat").html("");
    $.post(
        SITE_ROOT + "service/number_value",
        {"op" : "info", "ev" : year, "szam1": szam1, "szam2": szam2},
        function(data) {

            if (data.lista.length == 0) {
                $("<p>").append("Ebben az évben nem húzták ki ezt a két számot egyszerre.").appendTo("#adat");
                return;
            }
            
            let table = $("<table>").appendTo("#adat");
            let row = $("<tr>").appendTo(table);
            $("<th>").append("Év").appendTo(row);
            $("<th>").append("Játékhét").appendTo(row);
            $("<th>").append("Találat").appendTo(row);
            $("<th>").append("Nyeremény").appendTo(row);

            $.each(data.lista, function(key, value) {
                let row = $("<tr>").appendTo(table);
                let fieldNames = ['ev', 'het', 'talalat', 'ertek'];
                for (let fieldName of fieldNames) {
                    $("<td>").append(value[fieldName]).appendTo(row);
                }
            })
        },
        "json"                                                    
    );
    
}

function evszamok() {
    $.post(
        SITE_ROOT + "service/number_value",
        {"op" : "year"},
        function(data) {
            $.each(data.lista, function(key, value) {
                $("<option>").val(value.ev).text(value.ev).appendTo($("#ev_valaszt"));
            })
        },
        "json"                                                    
    );

}
$(document)
    .ajaxStart(() => $("#loading").show())
    .ajaxStop(() => $("#loading").hide())
    .ready(function() {
        evszamok();
        $("#loading").hide();
        $("#send").click(number_winner);
    })