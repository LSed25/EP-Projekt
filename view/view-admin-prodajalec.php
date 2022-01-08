<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>
<meta charset="UTF-8" />
<title>Administrator</title>

<div class="admin">  
    <h1>Administrator</h1>

    <p><button type="button" action="<?= BASE_URL . "store/logout" ?>">Odjava</button></p>
    <p><button type="button" action="<?= BASE_URL . "store/admin" ?>">Nazaj</button></p>
</div>

<div class="message"><?php echo $variables["message"] ?></div> <--<!-- Ali je bila sprememba gesla/profila uspešna -->

<div class="admin-prodajalec">

    <h2>Urejaj prodajalce</h2>

    <h3>Ustvari novega prodajalca</h3>
    <form action="<?= BASE_URL . "store/admin/prodajalec" ?>" method="post">
         <input type="hidden" name="do" value="add">
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
    <form action="<?= BASE_URL . "store/admin/prodajalec" ?>" method="post">
         <input type="hidden" name="do" value="update">
         <input type="hidden" name="id" value="<?=$variables["id_prodajalec"]?>">
         <label for="name"><b>Ime</b></label>
         <input type="text" placeholder="Vnesi ime" name="name" value="<?=$variables["Ime"]?>"> 
         <label for="surname"><b>Priimek</b></label>
         <input type="text" placeholder="Vnesi priimek" name="surname" value="<?=$podatki["Priimek"]?>"> 
         <label for="newemail"><b>Nov e-naslov</b></label>
         <input type="email" placeholder="Vnesi nov e-naslov" name="newemail" value="<?=$variables["Enaslov"]?>">
         <button type="submit">Posodobi podatke prodajalca</button>
    </form>

    <h3>Status prodajalca</h3>

    <?php
    if ($variables["Aktiviran"] == true) { ?>
        <p>Prodajalec je trenutno aktiviran.</p>
    <?php
        $text = "Deaktiviraj prodajalca";
    }
    else { ?>
         <p>Prodajalec je trenutno deaktiviran.</p>
    <?php
         $text = "Aktiviraj prodajalca";
    }
    ?>

    <form action="<?= BASE_URL . "store/admin/prodajalec" ?>" method="post">
         <input type="hidden" name="do" value="status">
         <input type="hidden" name="status" value="<?=$variables["Aktiviran"]?>">
         <input type="hidden" name="id" value="<?=$variables["id_prodajalec"]?>">
         <button type="submit"><?= $text ?></button>
    </form>

</div>