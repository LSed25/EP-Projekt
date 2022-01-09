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

<div class="admin-produkt">

    <h2>Urejanje izbranega produkta</h2>

    <h3>Spremeni podatke produkta</h3>
    <form action="<?= BASE_URL . "store/produkt" ?>" method="post">
         <input type="hidden" name="do" value="update">
         <input type="hidden" name="id" value="<?=$variables["id"]?>">
         <label for="author"><b>Avtor</b></label>
         <input type="text" placeholder="Vnesi ime in priimek avtorja" name="author" value="<?=$variables["Avtor"]?>">
         <label for="title"><b>Naslov</b></label>
         <input type="text" placeholder="Vnesi naslov knjige" name="title" value="<?=$variables["Naslov"]?>">
         <label for="year"><b>Leto izdaje</b></label>
         <input type="number" placeholder="Vnesi leto izdaje" name="year" value="<?=$variables["Leto_izdaje"]?>">
         <label for="price"><b>Cena</b></label>
         <input type="number" placeholder="Vnesi ceno" name="price" min="0.01" step=".01" value="<?=$variables["Cena"]?>">
         <button type="submit">Posodobi podatke produkta</button>
    </form>

    <h3>Status produkta</h3>

    <?php
    if ($variables["Aktiviran"] == true) { ?>
        <p>Produkt je trenutno aktiviran.</p>
    <?php
        $text = "Deaktiviraj produkt";
    }
    else { ?>
         <p>Produkt je trenutno deaktiviran.</p>
    <?php
         $text = "Aktiviraj produkt";
    }
    ?>

    <form action="<?= BASE_URL . "store/produkt" ?>" method="post">
         <input type="hidden" name="do" value="status">
         <input type="hidden" name="status" value="<?=$variables["Aktiviran"]?>">
         <input type="hidden" name="id" value="<?=$variables["id"]?>">
         <button type="submit"><?= $text ?></button>
    </form>

</div>