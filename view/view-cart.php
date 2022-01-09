<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Kosarica</title>

<h1>Kosarica</h1>

<?php $kCena = 0; ?>

<ul>
    <?php foreach ($books as $book): ?>
            <li> <?= $book["id_artikel"] ?>  <?= $book["Cena"] ?> EUR </li>
            <?php $kCena += $book["Cena"] ?>
    <?php endforeach; ?>
            <p> Skupna cena: <?= $kCena ?> EUR</p>

</ul>

<br></br>
<button><a href="<?= BASE_URL . "store/" ?>">Nazaj v knjigarno</a></button>