<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Knjigarna</title>

<h1>Knjigarna</h1>

<div>
    <button type="button"><a href="<?= BASE_URL . "store/register" ?>">Registracija</a></button>
    <button type="button"><a href="<?= BASE_URL . "store/login" ?>">Prijava</a></button>
</div>

<ul>

    <?php foreach ($books as $book): ?>
        <li><a href="<?= BASE_URL . "store/" . $book["id"] ?>"><?= $book["Avtor"] ?>: 
        	<?= $book["Naslov"] ?> (<?= $book["Leto_izdaje"] ?>)</a></li>
    <?php endforeach; ?>

</ul>
