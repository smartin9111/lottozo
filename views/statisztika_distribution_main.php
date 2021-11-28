
<script type="text/javascript">
    const SITE_ROOT = "<?=SITE_ROOT?>";
</script>
<script type="text/javascript" src="<?php echo SITE_ROOT ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_ROOT ?>js/number_distribution.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
<h2>Húzott számok eloszlása</h2>
<p>Ezen a grafikonon megnézheted, melyik számot hányszor húzták ki az adott időszakban.</p>
<canvas id="myChart" width="400" height="400"></canvas>