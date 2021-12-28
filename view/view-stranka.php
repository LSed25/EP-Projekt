<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Knjigarna [name]</title>

<h1>Knjigarna [name]</h1>

<ul>

    <?php foreach ($books as $book): ?>
        <li><a href="<?= BASE_URL . "store/view/" . $book["id"] ?>"><?= $book["Avtor"] ?>: 
        	<?= $book["Naslov"] ?> (<?= $book["Leto_izdaje"] ?>)</a></li>
    <?php endforeach; ?>

</ul>