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

<h2>Naročila, ki čakajo na potrditev:</h2>

<ul>

    <?php foreach ($variables as $narocilo): 
        if ($narocilo["Status"] == "neobdelano" && $narocilo["Zakljuceno"] == true) {
            ?>
        <li>
            <p><b>PODATKI O NAROČILU: </b></p>
            <p><b>ID: </b><?php echo $narocilo["id_narocilo"]; ?></p>
            <p><b>Datum: </b><?php echo $narocilo["Datum"]; ?></p>
            <p><b>Znesek: </b><?php echo $narocilo["Cena"]; ?> €</p>
            <p><b>PODATKI O KUPCU: </b></p>
            <p><b>Ime in priimek: </b><?php echo $narocilo["Stranka"]["Ime"]," ",$narocilo["Stranka"]["Priimek"]; ?></p>
            <p><b>Naslov: </b><?php echo $narocilo["Stranka"]["Ulica"]," ",$narocilo["Stranka"]["Hisna_st"],", ",$narocilo["Stranka"]["Postna_st"]," ",$narocilo["Stranka"]["Posta"]; ?></p>
            <p><b>Kontakt: </b><?php echo $narocilo["Stranka"]["Enaslov"]; ?></p>
            <form action="<?= BASE_URL . "store/narocilo" ?>" method="post">
                 <input type="hidden" name="status" value="potrjeno">
                 <input type="hidden" name="id" value="<?=$narocilo["id_narocilo"]?>">
                 <button type="submit">Potrdi naročilo</button>
            </form>   
            <form action="<?= BASE_URL . "store/narocilo" ?>" method="post">
                 <input type="hidden" name="status" value="preklicano">
                 <input type="hidden" name="id" value="<?=$narocilo["id_narocilo"]?>">
                 <button type="submit">Prekliči naročilo</button>
            </form>           
        </li>
        <?php } endforeach; ?>

</ul>

<h2>Zgodovina potrjenih naročil:</h2>

<ul>

    <?php foreach ($variables as $narocilo): 
        if ($narocilo["Status"] == "potrjeno" && $narocilo["Zakljuceno"] == true) {
            ?>
        <li>
            <p><b>PODATKI O NAROČILU: </b></p>
            <p><b>ID: </b><?php echo $narocilo["id_narocilo"]; ?></p>
            <p><b>Datum: </b><?php echo $narocilo["Datum"]; ?></p>
            <p><b>Znesek: </b><?php echo $narocilo["Cena"]; ?> €</p>
            <p><b>PODATKI O KUPCU: </b></p>
            <p><b>Ime in priimek: </b><?php echo $narocilo["Stranka"]["Ime"]," ",$narocilo["Stranka"]["Priimek"]; ?></p>
            <p><b>Naslov: </b><?php echo $narocilo["Stranka"]["Ulica"]," ",$narocilo["Stranka"]["Hisna_st"],", ",$narocilo["Stranka"]["Postna_st"]," ",$narocilo["Stranka"]["Posta"]; ?></p>
            <p><b>Kontakt: </b><?php echo $narocilo["Stranka"]["Enaslov"]; ?></p>
            <form action="<?= BASE_URL . "store/narocilo" ?>" method="post">
                 <input type="hidden" name="status" value="stornirano">
                 <input type="hidden" name="id" value="<?=$narocilo["id_narocilo"]?>">
                 <button type="submit">Storniraj naročilo</button>
            </form>       
        </li>
        <?php } endforeach; ?>

</ul>

<h2>Zgodovina preklicanih naročil:</h2>

<ul>

    <?php foreach ($variables as $narocilo): 
        if ($narocilo["Status"] == "preklicano" && $narocilo["Zakljuceno"] == true) {
            ?>
        <li>
            <p><b>PODATKI O NAROČILU: </b></p>
            <p><b>ID: </b><?php echo $narocilo["id_narocilo"]; ?></p>
            <p><b>Datum: </b><?php echo $narocilo["Datum"]; ?></p>
            <p><b>Znesek: </b><?php echo $narocilo["Cena"]; ?> €</p>
            <p><b>PODATKI O KUPCU: </b></p>
            <p><b>Ime in priimek: </b><?php echo $narocilo["Stranka"]["Ime"]," ",$narocilo["Stranka"]["Priimek"]; ?></p>
            <p><b>Naslov: </b><?php echo $narocilo["Stranka"]["Ulica"]," ",$narocilo["Stranka"]["Hisna_st"],", ",$narocilo["Stranka"]["Postna_st"]," ",$narocilo["Stranka"]["Posta"]; ?></p>
            <p><b>Kontakt: </b><?php echo $narocilo["Stranka"]["Enaslov"]; ?></p>
        </li>
        <?php } endforeach; ?>

</ul>

<h2>Zgodovina storniranih naročil:</h2>

<ul>

    <?php foreach ($variables as $narocilo): 
        if ($narocilo["Status"] == "stornirano" && $narocilo["Zakljuceno"] == true) {
            ?>
        <li>
            <p><b>PODATKI O NAROČILU: </b></p>
            <p><b>ID: </b><?php echo $narocilo["id_narocilo"]; ?></p>
            <p><b>Datum: </b><?php echo $narocilo["Datum"]; ?></p>
            <p><b>Znesek: </b><?php echo $narocilo["Cena"]; ?> €</p>
            <p><b>PODATKI O KUPCU: </b></p>
            <p><b>Ime in priimek: </b><?php echo $narocilo["Stranka"]["Ime"]," ",$narocilo["Stranka"]["Priimek"]; ?></p>
            <p><b>Naslov: </b><?php echo $narocilo["Stranka"]["Ulica"]," ",$narocilo["Stranka"]["Hisna_st"],", ",$narocilo["Stranka"]["Postna_st"]," ",$narocilo["Stranka"]["Posta"]; ?></p>
            <p><b>Kontakt: </b><?php echo $narocilo["Stranka"]["Enaslov"]; ?></p>
        </li>
        <?php } endforeach; ?>

</ul>