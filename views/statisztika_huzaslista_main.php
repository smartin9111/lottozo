

<link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT ?>css/number_jackpot.css">
<script type="text/javascript" src="<?php echo SITE_ROOT ?>js/jquery.min.js"></script>
<script>
    const SITE_ROOT = "<?=SITE_ROOT?>";
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
        .ready(function() {
            evszamok();
        })
</script>

<h2>Nyereménylista</h2>
<p>Kíváncsi vagy, mikor húzták ki a kedvenc számaidat? És mennyit nyerhettél volna vele akkor? </p>
<p>Add meg az évszámot, amikortól kíváncsi vagy és a két kedvenc számodat. A következő oldalon megkapod a listát, hogy ekkor mennyit lehetett nyerni.</p>
<form method="POST" action="<?=SITE_ROOT?>service/pdfgen" target="_blank">
    <label for="ev_valaszt">Évszám:</label>
    <select id="ev_valaszt" name="ev"></select>
    <label for="szam1">Első szám:</label>
    <input type="number" id="szam1" name="szam1" min="1" max="45" />
    <label for="szam2">Második szám:</label>
    <input type="number" id="szam2" name="szam2" min="1" max="45" />
    <input type="submit" id="send" value="Mehet" />
</form>