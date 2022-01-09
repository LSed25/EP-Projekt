<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Moj profil</title>

<h1>Pozdravljen/a <?= $Ime ?>!</h1>

<h4>Moji podatki:</h4>

<p>Ime: <?= $Ime ?></p>
<p>Priimek: <?= $Priimek ?></p>
<p>E-naslov: <?= $Enaslov ?></p>
<p>Naslov: <?= $Ulica ?> <?= $Hisna_st ?></p>
<p>Pošta: <?= $Posta ?> <?= $Postna_st ?></p>

<button><a href="<?= BASE_URL . "store/user/edit/" . $id?>">Spremeni podatke</a></button> 

<br></br>

<button><a href="<?= BASE_URL . "store/"?>">Knjigarna</a></button>  <button><a href="<?= BASE_URL . "store/logout"?>">Odjava</a></button>

