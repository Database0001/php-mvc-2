<?php

use Modules\Auth;
?>

<?= view('layouts.header', ['title' => "Anasayfa"]) ?>

<?php
$username = @Auth::init()->user()['username'];
?>

<div class="mt-4">
    Hoşgeldin
    <?php if ($username) { ?>
        <?= $username ?>
    <?php } else { ?>
        Ziyaretçi
    <?php } ?>
</div>

<?= view('layouts.footer') ?>