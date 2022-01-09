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
        if ($narocilo["status"] == "neobdelano" && $narocilo["zakljuceno"] == true) {
            ?>
        <li>
            <p><b>ID NAROČILA:</b><?php echo $narocilo["id"]; ?></p>
            <p><b>Datum naročila:</b><?php echo $narocilo["datum"]; ?></p>
            <p><b>PODATKI O KUPCU:</b></p>
            <p><b>Ime in priimek:</b><?php echo $narocilo["stranka"]["Ime"]," ",$narocilo["stranka"]["Priimek"]; ?></p>
            <p><b>Naslov:</b><?php echo $narocilo["stranka"]["Ulica"]," ",$narocilo["stranka"]["Hisna_st"],", ",$narocilo["stranka"]["Postna_st"]," ",$narocilo["stranka"]["Posta"]; ?></p>
            <p><b>Kontakt:</b><?php $narocilo["stranka"]["Enaslov"] ?></p>
            <form action="<?= BASE_URL . "store/narocilo" ?>" method="post">
                 <input type="hidden" name="do" value="confirm">
                 <input type="hidden" name="id" value="<?=$narocilo["id"]?>">
                 <button type="submit">Potrdi naročilo</button>
            </form>
            <form action="<?= BASE_URL . "store/narocilo" ?>" method="post">
                 <input type="hidden" name="do" value="cancel">
                 <input type="hidden" name="id" value="<?=$narocilo["id"]?>">
                 <button type="submit">Potrdi naročilo</button>
            </form>           
        </li>
        <?php } endforeach; ?>

</ul>

<h2>Potrjena naročila:</h2>

<ul>

    <?php foreach ($narocila as $narocilo): 
        if ($narocilo["Status"] == "potrjeno" && $narocilo["Zakljuceno"] == true) {
            ?>
        <li></li>
        <?php } endforeach; ?>

</ul>

<h2>Preklicana naročila:</h2>

<ul>

    <?php foreach ($narocila as $narocilo): 
        if ($narocilo["Status"] == "preklicano" && $narocilo["Zakljuceno"] == true) {
            ?>
        <li></li>
        <?php } endforeach; ?>

</ul>

<h2>Stornirana naročila:</h2>

<ul>

    <?php foreach ($narocila as $narocilo): 
        if ($narocilo["Status"] == "stornirano" && $narocilo["Zakljuceno"] == true) {
            ?>
        <li></li>
        <?php } endforeach; ?>

</ul>