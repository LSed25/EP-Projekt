<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>
<meta charset="UTF-8" />
<title>Administrator</title>

<div class="admin">  
    <h1>Administrator</h1>

    <p><button type="button" action="<?= BASE_URL . "store/logout" ?>">Odjava</button></p>
</div>

<div class="admin-nastavitve">

    <h2>Nastavitve administratorja</h2>
    
    <div class="message"><?php echo $variables["message"] ?></div> <--<!-- Ali je bila sprememba gesla/profila uspešna -->
    
    <h3>Spremeni geslo</h3>
    <form action="<?= BASE_URL . "store/changepassword" ?>" method="post">
         <label for="oldpass"><b>Trenutno geslo</b></label>
         <input type="password" placeholder="Vnesi trenutno geslo" name="oldpassword" required>
         <label for="newpass"><b>Novo geslo</b></label>
         <input type="password" placeholder="Vnesi novo geslo" name="newpassword" required>
         <button type="submit">Posodobi geslo</button>
    </form>

    <h3>Posodobi podatke</h3>
    <form action="<?= BASE_URL . "store/admin" ?>" method="post">
         <label for="name"><b>Ime</b></label>
         <input type="text" placeholder="Vnesi ime" name="name" value="<?=$variables["Ime"]?>">
         <label for="surname"><b>Priimek</b></label>
         <input type="text" placeholder="Vnesi priimek" name="surname" value="<?=$variables["Priimek"]?>">
         <label for="email"><b>E-naslov</b></label>
         <input type="email" placeholder="Vnesi e-naslov" name="email" value="<?=$variables["Enaslov"]?>">
         <button type="submit">Posodobi podatke</button>
    </form>
</div>

<div>
    <h2>Upravljanje s prodajalci</h2>

    <h3>Izberi prodajalca:</h3>

    <form action="<?= BASE_URL . "store/admin/prodajalec" ?>" method="get">
         <label for="id"><b>ID prodajalca:</b></label>
         <input type="number" placeholder="Vnesi ime prodajalca" name="id" min="1">
         <button type="submit">Izberi prodajalca</button>
    </form>
</div>