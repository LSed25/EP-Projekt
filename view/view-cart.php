<?php if(!$books) {?>

<h1>Kosarica</h1>

<p>Vaša košarica je prazna!</p>

<button><a href="<?= BASE_URL . "store/" ?>">Nazaj v knjigarno</a></button>
<?php }else{ ?>
<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Kosarica</title>

<h1>Kosarica</h1>

<button><a href="<?= BASE_URL . "store/" ?>">Nazaj v knjigarno</a></button>
<br></br>
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
<form action="<?= BASE_URL . "store/submit/" . $_SESSION["id"]["id"]?>" method="post">
    <input type="hidden" name="id_stranka" value="<?= $_SESSION["id"]["id"] ?>" />
    <input type="hidden" name="cena" value="<?= $kCena ?>" />
    <button type="submit">Zakljuci nakup</button> 
</form>
<p>
<button><a href="<?= BASE_URL . "store/user/cart/delete/" . $_SESSION["id"]["id"]?>">Izprazni košarico</a></button></p>
// GUMB ZA SUBMIT(efekt), GUMB ZA SPREMINJANJE KOLIČINE(efekt, izbriši cart on submit??), BRISANJE ARTIKLOV

<?php } ?>