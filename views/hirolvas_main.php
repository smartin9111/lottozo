<?php if (isset($viewData['uzenet'])) {
    $viewData['uzenet'];
} ?>


<form action="<?= SITE_ROOT ?>hirek" method="post">

    <div style="margin-top: 20px;"> <?php foreach ($viewData['hirek'] as $hir) { ?>
        <p><?php echo $hir['tartalom'] ?></p>
        <p><?php echo $hir['letrehozva'] ?></p>
        <p><?php echo $hir['bejelentkezes'] ?></p><br>
        <?php } ?>
    </div>