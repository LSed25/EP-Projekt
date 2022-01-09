<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Kosarica</title>

<h1>Kosarica</h1>

<?php $kCena = 0;
      $idx=0; ?>

<ul>
    <?php foreach ($books as $book): ?>
            <li> <?= $products[$idx]["Naslov"] ?>, Kolicina: <?= $pks[$idx]["Kolicina"] ?>, Cena: <?= $book["Cena"] ?> EUR <button><a href="<?= BASE_URL . "store/" ?>">Uredi</a></button> </li>
            <?php $kCena += $book["Cena"]; $idx++;?>
        <?php endforeach; ?>
            <p> Skupna cena: <?= $kCena ?> EUR</p>

</ul>

<br></br>
<button><a href="<?= BASE_URL . "store/" ?>">Nazaj v knjigarno</a></button> <button><a href="<?= BASE_URL . "store/" ?>">Zakljuci nakup</a></button>

// GUMB ZA SUBMIT(efekt), GUMB ZA SPREMINJANJE KOLIČINE(efekt, izbriši cart on submit??), BRISANJE ARTIKLOV