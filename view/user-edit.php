<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Moj profil - urejanje</title>

<h1>Urejanje profila</h1>


<form action="<?= BASE_URL . "store/user/edit/" . $id ?>" method="post">
    <input type="hidden" name="id" value="<?= $id ?>"  />
    <p><label>Ime: <input type="text" name="firstname" value="<?= $Ime ?>" required /></label></p>
    <p><label>Priimek: <input type="text" name="lastname" value="<?= $Priimek ?>" required /></label></p>
    <p><label>E-naslov: <input type="email" name="email" value="<?= $Enaslov ?>" required /></label></p>
    <p><label>Geslo: <input type="password" name="password" value="" required /></label></p>
    <p><label>Ulica: <input type="text" name="ulica" value="<?= $Ulica ?>" required /></label>
        <label>Hišna št.: <input type="number" name="hisnast" value="<?= $Hisna_st ?>" required /></label></p>
    <p><label>Pošta: <input type="text" name="posta" value="<?= $Posta ?>" required /></label>
        <label>Poštna št.: <input type="number" name="postnast" value="<?= $Postna_st ?>" required /></label></p>
    <p><button>Posodobi profil</button></p>
</form>

<button><a href="<?= BASE_URL . "store/user/" . $id ?>">Nazaj na profil</a></button>
    