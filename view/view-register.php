<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Registracija</title>

<h1>Registracija</h1>

<form action="<?= BASE_URL . "store/register" ?>" method="post">
    <p><label>Ime: <input type="text" name="firstname" value="<?= $firstname ?>" required /></label></p>
    <p><label>Priimek: <input type="text" name="lastname" value="<?= $lastname ?>" required /></label></p>
    <p><label>E-naslov: <input type="email" name="email" value="<?= $email ?>" required /></label></p>
    <p><label>Geslo: <input type="password" name="password" value="<?= $password ?>" required /></label></p>
    <p><label>Ulica: <input type="text" name="ulica" value="<?= $ulica ?>" required /></label>
        <label>Hišna št.: <input type="number" name="hisnast" value="<?= $hisnast ?>" required /></label></p>
    <p><label>Pošta: <input type="text" name="posta" value="<?= $posta ?>" required /></label>
        <label>Poštna št.: <input type="number" name="postnast" value="<?= $postnast ?>" required /></label></p>
    <p><button type="submit">Registracija</button></p>
</form>
<a href="<?= BASE_URL . "store/" ?>">Nazaj na seznam izdelkov</a>

<?php echo password_hash("testnogeslo", PASSWORD_DEFAULT); 
       if(password_verify("testnogeslo", password_hash("testnogeslo", PASSWORD_DEFAULT))) {
           echo "\r\nOwO";
       }else{
           echo "TwT";
       }
?>

