<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>
<meta charset="UTF-8" />
<title>Administrator</title>

<div class="admin">  
    <h1>Administrator</h1>

    <p><button type="button"><a href="<?= BASE_URL . "store/logout" ?>">Odjava</a></button></p>
    <p><button type="button"><a href="<?= BASE_URL . "store/admin" ?>">Nazaj na vmesnik administratorja</a></button></p>
</div>

<div class="message"><?php if (isset($variables["message"])) {echo $variables["message"];} ?></div><!-- Ali je bila sprememba gesla/profila uspešna -->

<div class="admin-prodajalec">

    <h2>Urejaj prodajalce</h2>

    <h3>Spremeni podatke prodajalca</h3>
    <form action="<?= BASE_URL . "store/admin/prodajalec" ?>" method="post">
         <input type="hidden" name="do" value="update">
         <input type="hidden" name="id" value="<?=$variables["id_prodajalec"]?>">
         <label for="name"><b>Ime</b></label>
         <input type="text" placeholder="Vnesi ime" name="name" value="<?=$variables["Ime"]?>"> 
         <label for="surname"><b>Priimek</b></label>
         <input type="text" placeholder="Vnesi priimek" name="surname" value="<?=$variables["Priimek"]?>"> 
         <label for="newemail"><b>Nov e-naslov</b></label>
         <input type="email" placeholder="Vnesi nov e-naslov" name="newemail" value="<?=$variables["Enaslov"]?>">
         <button type="submit">Posodobi podatke prodajalca</button>
    </form>
    
    <h3>Spremeni geslo prodajalca</h3>
    <form action="<?= BASE_URL . "store/changepassword" ?>" method="post">
         <input type="hidden" name="id" value="<?=$variables["id_prodajalec"]?>">
         <input type="hidden" name="changedby" value="administrator">
         <label for="oldpass"><b>Trenutno geslo</b></label>
         <input type="password" placeholder="Vnesi trenutno geslo" name="oldpassword" required>
         <label for="newpass"><b>Novo geslo</b></label>
         <input type="password" placeholder="Vnesi novo geslo" name="newpassword" required>
         <input type="hidden" name="role" value="prodajalec">
         <button type="submit">Posodobi geslo</button>
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