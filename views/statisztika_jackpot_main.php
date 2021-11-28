
<script type="text/javascript">
    const SITE_ROOT = "<?=SITE_ROOT?>";
</script>
<script type="text/javascript" src="<?php echo SITE_ROOT ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_ROOT ?>js/number_jackpot.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT ?>css/number_jackpot.css">

<p>A legtöbb ember évekig játszik ugyanazokkal a számokkal. Biztosan neked is vannak ilyen számaid. Ha más nem, akkor kedvenc számod.</p>

<p>Kíváncsi vagy, milyen nyeremények voltak akkor, amikor legalább egy kettesed lett volna? Add meg az évszámot és két számot, és mindjárt látod is az eredményt!</p>

<label for="ev_valaszt">Évszám:</label>
<select id="ev_valaszt"></select>
<label for="szam1">Első szám:</label>
<input type="number" id="szam1" name="szam1" min="1" max="45" />
<label for="szam2">Második szám:</label>
<input type="number" id="szam2" name="szam2" min="1" max="45" />
<button id="send" value="Mehet">Mehet</button>

<div id="loading">Loading...</div>
<div id="adat"></div>
