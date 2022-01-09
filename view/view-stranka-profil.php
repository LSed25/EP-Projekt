<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Moj profil</title>

<h1>Pozdravljen/a <?= $user["Ime"] ?>!</h1>

<div style="float: left;">
<h4>Moji podatki:</h4>

<p>Ime: <?= $user["Ime"] ?></p>
<p>Priimek: <?= $user["Priimek"] ?></p>
<p>E-naslov: <?= $user["Enaslov"] ?></p>
<p>Naslov: <?= $user["Ulica"] ?> <?= $user["Hisna_st"] ?></p>
<p>Pošta: <?= $user["Posta"] ?> <?= $user["Postna_st"] ?></p>

<button><a href="<?= BASE_URL . "store/user/edit/" . $user["id"]?>">Spremeni podatke</a></button> 

<br></br>

<button><a href="<?= BASE_URL . "store/"?>">Knjigarna</a></button>  <button><a href="<?= BASE_URL . "store/logout"?>">Odjava</a></button>

</div>

<div style="float: right;">
    
  <h4>Moja naročila:</h4>
    <?php foreach ($orders as $order): ?>
  <p><b>[<?= $order["id_narocilo"] ?>]</b></p>
      <ul>
        <p>Datum naročila: <?= $order["Datum"] ?></p>
        <p>Cena: <?= $order["Cena"] ?></p>
        <p>Status: <?= $order["Status"] ?></p>
        <p>Zaključeno: <?= $order["Zakljuceno"] ?></p>
      </ul>
    <?php endforeach; ?>