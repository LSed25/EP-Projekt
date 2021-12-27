<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Registracija</title>

<h1>Registracija</h1>

<form action="<?= BASE_URL . "store/register" ?>" method="post">
    <p><label>Ime: <input type="text" name="firstname" value="<?= $firstname ?>" autofocus /></label></p>
    <p><label>Priimek: <input type="text" name="lastname" value="<?= $lastname ?>" /></label></p>
    <p><label>E-naslov: <input type="email" name="email" value="<?= $email ?>" /></label></p>
    <p><label>Geslo: <input type="password" name="password" value="<?= $password ?>" /></label></p>
    <p><label>Ulica: <input type="text" name="ulica" value="<?= $ulica ?>" /></label>
        <label>Hišna št.: <input type="number" name="hisnast" value="<?= $hisnast ?>" /></label></p>
    <p><label>Pošta: <input type="text" name="posta" value="<?= $posta ?>" /></label>
        <label>Poštna št.: <input type="number" name="postnast" value="<?= $postnast ?>" /></label></p>
    <p><button>Registracija</button></p>
</form>

