<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>
<meta charset="UTF-8" />
<title>Administrator</title>

<div class="admin">  
    <h1>Administrator</h1>

    <p><button type="button" action="">Odjava</button></p>
</div>

<div class="admin-prodajalec">

    <h2>Urejaj prodajalce</h2>

    <h3>Ustvari novega prodajalca</h3>
    <form action="" method="post">
         <label for="name"><b>Ime</b></label>
         <input type="text" placeholder="Vnesi ime" name="name" required>
         <label for="surname"><b>Priimek</b></label>
         <input type="text" placeholder="Vnesi priimek" name="surname" required>
         <label for="email"><b>E-naslov</b></label>
         <input type="email" placeholder="Vnesi e-naslov" name="email" required>
         <label for="password"><b>Geslo</b></label>
         <input type="password" placeholder="Vnesi geslo" name="password" required>
         <button type="submit">Ustvari</button>
    </form>

    <h3>Spremeni podatke prodajalca</h3>
    <form action="" method="post">
        <p>
            <label for="email"><h4>Izberi prodajalca z vnosom njegovega e-naslova</h4></label>
            <input type="email" placeholder="Vnesi e-naslov" name="email" required>
        </p>

         <label for="name"><b>Ime</b></label>
         <input type="text" placeholder="Vnesi ime" name="name">
         <label for="surname"><b>Priimek</b></label>
         <input type="text" placeholder="Vnesi priimek" name="surname">
         <label for="newemail"><b>Nov e-naslov</b></label>
         <input type="email" placeholder="Vnesi nov e-naslov" name="newemail">
         <label for="password"><b>Geslo</b></label>
         <input type="password" placeholder="Vnesi geslo" name="password">
         <button type="submit">Posodobi podatke</button>
    </form>

    <h3>Aktiviraj prodajalca</h3>
    <form action="" method="post">
         <label for="email"><b>E-naslov prodajalca</b></label>
         <input type="email" placeholder="Vnesi e-naslov" name="email" required>
         <label for="password"><b>Geslo prodajalca</b></label>
         <input type="password" placeholder="Vnesi geslo" name="password" required>
         <button type="submit">Aktiviraj</button>
    </form>

    <h3>Deaktiviraj prodajalca</h3>
    <form action="" method="post">
        <label for="email"><b>E-naslov prodajalca</b></label>
        <input type="email" placeholder="Vnesi e-naslov" name="email" required>
        <label for="password"><b>Geslo prodajalca</b></label>
        <input type="password" placeholder="Vnesi geslo" name="password" required>
        <button type="submit">Deaktiviraj</button>
    </form>

</div>