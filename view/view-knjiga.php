<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title><?= $Naslov ?></title>

<h1><?= $Naslov ?></h1>

<ul>
    <li>Avtor: <b><?= $Avtor ?></b></li>
    <li>Naslov: <b><?= $Naslov ?></b></li>
    <li>Cena: <b><?= $Cena ?> EUR</b></li>
    <li>Leto izdaje: <b><?= $Leto_izdaje ?></b></li>
</ul>

<p><a href="<?= BASE_URL . "store/" ?>">Vse knjige</a></p>

