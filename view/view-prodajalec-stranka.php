<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>
<meta charset="UTF-8" />
<title>Prodajalec</title>

<div class="prodajalec">  
    <h1>Prodajalec</h1>

    <p><button type="button"><a href="<?= BASE_URL . "store/logout" ?>">Odjava</a></button></p>
    <p><button type="button"><a href="<?= BASE_URL . "store/prodajalec" ?>">Nazaj na vmesnik prodajalca</a></button></p>
</div>

<div class="message"><?php if (isset($variables["message"])) {echo $variables["message"];} ?></div><!-- Ali je bila sprememba gesla/profila uspešna -->

<div class="admin-stranka">

    <h2>Urejanje profila stranke</h2>

    <h3>Spremeni podatke stranke</h3>
    <form action="<?= BASE_URL . "store/stranka" ?>" method="post">
         <input type="hidden" name="do" value="update">
         <input type="hidden" name="id" value="<?=$variables["id"]?>">
         <label for="name"><b>Ime</b></label>
         <input type="text" placeholder="Vnesi ime" name="name" value="<?=$variables["Ime"]?>">
         <label for="surname"><b>Priimek</b></label>
         <input type="text" placeholder="Vnesi priimek" name="surname" value="<?=$variables["Priimek"]?>">
         <label for="email"><b>E-naslov</b></label>
         <input type="email" placeholder="Vnesi e-naslov" name="email" value="<?=$variables["Enaslov"]?>">
         <label for="street"><b>Ulica</b></label>
         <input type="text" placeholder="Vnesi ulico" name="street" value="<?=$variables["Ulica"]?>">
         <label for="housenumber"><b>Hišna številka</b></label>
         <input type="number" placeholder="Vnesi hišno številko" name="housenumber" min="1" value="<?=$variables["Hisna_st"]?>">
         <label for="postoffice"><b>Pošta</b></label>
         <input type="text" placeholder="Vnesi pošto" name="postoffice" value="<?=$variables["Posta"]?>">
         <label for="postnumber"><b>Poštna številka</b></label>
         <input type="number" placeholder="Vnesi poštno številko" name="postnumber" min="1000" value="<?=$variables["Postna_st"]?>">
         <button type="submit">Posodobi podatke stranke</button>
    </form>
    
    <h3>Spremeni geslo stranke</h3>
    <form action="<?= BASE_URL . "store/changepassword" ?>" method="post">
         <input type="hidden" name="id" value="<?=$variables["id"]?>">
         <input type="hidden" name="changedby" value="prodajalec">
         <label for="oldpass"><b>Trenutno geslo</b></label>
         <input type="password" placeholder="Vnesi trenutno geslo" name="oldpassword" required>
         <label for="newpass"><b>Novo geslo</b></label>
         <input type="password" placeholder="Vnesi novo geslo" name="newpassword" required>
         <input type="hidden" name="role" value="prodajalec">
         <button type="submit">Posodobi geslo</button>
    </form>

    <h3>Status stranke</h3>

    <?php
    if ($variables["Aktiviran"] == true) { ?>
        <p>Stranka je trenutno aktivirana.</p>
    <?php
        $text = "Deaktiviraj stranko";
    }
    else { ?>
         <p>Prodajalec je trenutno deaktiviran.</p>
    <?php
         $text = "Aktiviraj stranko";
    }
    ?>

    <form action="<?= BASE_URL . "store/stranka" ?>" method="post">
         <input type="hidden" name="do" value="status">
         <input type="hidden" name="status" value="<?=$variables["Aktiviran"]?>">
         <input type="hidden" name="id" value="<?=$variables["id"]?>">
         <button type="submit"><?= $text ?></button>
    </form>

</div>