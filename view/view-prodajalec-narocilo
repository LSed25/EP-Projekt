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

    <?php foreach ($narocila as $narocilo): 
        if ($narocilo["Status"] == "neobdelano" && $narocilo["Zakljuceno"] == true) {
            ?>
        <li>
            
        </li>
    <?php endforeach; ?>

</ul>

<h2>Potrjena naročila:</h2>

<ul>

    <?php foreach ($narocila as $narocilo): 
        if ($narocilo["Status"] == "potrjeno" && $narocilo["Zakljuceno"] == true) {
            ?>
        <li></li>
    <?php endforeach; ?>

</ul>

<h2>Preklicana naročila:</h2>

<ul>

    <?php foreach ($narocila as $narocilo): 
        if ($narocilo["Status"] == "preklicano" && $narocilo["Zakljuceno"] == true) {
            ?>
        <li></li>
    <?php endforeach; ?>

</ul>

<h2>Stornirana naročila:</h2>

<ul>

    <?php foreach ($narocila as $narocilo): 
        if ($narocilo["Status"] == "stornirano" && $narocilo["Zakljuceno"] == true) {
            ?>
        <li></li>
    <?php endforeach; ?>

</ul>