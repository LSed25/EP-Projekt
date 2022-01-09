<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Knjigarna</title>

<h1>Knjigarna</h1>

<button><a href="<?= BASE_URL . "store/user/" . $_SESSION["id"]["id"]?>">Moj profil</a></button> <button style="float: right;"><a href="<?= BASE_URL . "store/user/cart/" . $_SESSION["id"]["id"]?>">Košarica</a></button>

<ul>

    <?php foreach ($books as $book): ?>
            <li><a href="<?= BASE_URL . "store/" . $book["id"] ?>"><?= $book["Avtor"] ?>: 
        	<?= $book["Naslov"] ?> (<?= $book["Leto_izdaje"] ?>)</a></li>
    <?php endforeach; ?>

</ul>

