<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title><?= $Naslov ?></title>

<h1><?= $Naslov ?></h1>

<ul>
    <form action="<?= BASE_URL . "store/buy/" . $id ?>" method="post">
        <li>Avtor: <b><?= $Avtor ?></b></li>
        <li>Naslov: <b><?= $Naslov ?></b></li>
        <li>Cena: <b><?= $Cena ?> EUR</b></li>
        <li>Leto izdaje: <b><?= $Leto_izdaje ?></b></li>
        <p></p>
        <input type="hidden" name="id_produkt" value="<?= $id ?>" />
        <input type="hidden" name="cena" value="<?= $Cena ?>" />
        <input style="width: 40px;" type="number" name="kolicina" placeholder="0" min="0" value="0" />
        <button type="submit">V košarico</button>
    </form>
</ul>



<button><a href="<?= BASE_URL . "store/" ?>">Vse knjige</a></button>