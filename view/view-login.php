<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Prijava</title>

<h1>Prijava</h1>

<form action="<?= BASE_URL . "store/login" ?>" method="post">
    <p><label>E-naslov: <input type="email" name="email" value="<?= $email ?>" /></label></p>
    <p><label>Geslo: <input type="password" name="password" value="<?= $password ?>" /></label></p>
    <p><button>Prijava</button> Še nimaš računa? <a href="<?= BASE_URL . "store/register" ?>">Registriraj se</a>
</form>

<p><a href="<?= BASE_URL . "store/syslogin" ?>">Sistemska prijava</a></p>