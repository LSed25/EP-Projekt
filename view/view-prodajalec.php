<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>
<meta charset="UTF-8" />
<title>Prodajalec</title>

<div class="admin">  
    <h1>Prodajalec</h1>

    <p><button type="button"><a href="<?= BASE_URL . "store/logout" ?>">Odjava</a></button></p>
    <p><button type="button"><a href="<?= BASE_URL . "store/prodajalec/narocilo" ?>">Upravljaj z naročili</a></button></p>
</div>

<div class="prodajalec-nastavitve">

    <h2>Nastavitve prodajalca</h2>
    
    <div class="message"><?php if (isset($variables["message"])) {echo $variables["message"];}?></div> <!-- Ali je bila sprememba gesla/profila uspešna -->
    
    <h3>Spremeni geslo</h3>
    <form action="<?= BASE_URL . "store/changepassword" ?>" method="post">
         <label for="oldpass"><b>Trenutno geslo</b></label>
         <input type="password" placeholder="Vnesi trenutno geslo" name="oldpassword" required>
         <label for="newpass"><b>Novo geslo</b></label>
         <input type="password" placeholder="Vnesi novo geslo" name="newpassword" required>
         <input type="hidden" name="role" value="prodajalec">
         <input type="hidden" name="changedby" value="prodajalec">
         <button type="submit">Posodobi geslo</button>
    </form>

    <h3>Posodobi podatke</h3>
    <form action="<?= BASE_URL . "store/prodajalec" ?>" method="post">
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
    <h2>Upravljanje s produkti</h2>

    <h3>Dodaj nov produkt</h3>
    <form action="<?= BASE_URL . "store/produkt" ?>" method="post">
         <input type="hidden" name="do" value="add">
         <label for="author"><b>Avtor</b></label>
         <input type="text" placeholder="Vnesi ime in priimek avtorja" name="author" required>
         <label for="title"><b>Naslov</b></label>
         <input type="text" placeholder="Vnesi naslov knjige" name="title" required>
         <label for="year"><b>Leto izdaje</b></label>
         <input type="number" placeholder="Vnesi leto izdaje" name="year" required>
         <label for="price"><b>Cena</b></label>
         <input type="number" placeholder="Vnesi ceno" name="price" min="0.01" step=".01" required>
         <button type="submit">Ustvari</button>
    </form>

    <h3>Uredi podatke obstoječega produkta:</h3>
    <form action="<?= BASE_URL . "store/produkt" ?>" method="post">
         <label for="id"><b>ID produkta:</b></label>
         <input type="number" placeholder="Vnesi ID produkta" name="id" min="1">
         <input type="hidden" name="do" value="search">
         <button type="submit">Izberi produkt</button>
    </form>

</div>

<div>
    <h2>Upravljanje s profili strank</h2>

    <h3>Dodaj nov profil stranke</h3>
    <form action="<?= BASE_URL . "store/stranka" ?>" method="post">
         <input type="hidden" name="do" value="add">
         <label for="name"><b>Ime</b></label>
         <input type="text" placeholder="Vnesi ime" name="name" required>
         <label for="surname"><b>Priimek</b></label>
         <input type="text" placeholder="Vnesi priimek" name="surname" required>
         <label for="email"><b>E-naslov</b></label>
         <input type="email" placeholder="Vnesi e-naslov" name="email" required>
         <label for="password"><b>Geslo</b></label>
         <input type="password" placeholder="Vnesi geslo" name="password" required>
         <label for="street"><b>Ulica</b></label>
         <input type="text" placeholder="Vnesi ulico" name="street" required>
         <label for="housenumber"><b>Hišna številka</b></label>
         <input type="number" placeholder="Vnesi hišno številko" name="housenumber" min="1" required>
         <label for="postoffice"><b>Pošta</b></label>
         <input type="text" placeholder="Vnesi pošto" name="postoffice" required>
         <label for="postnumber"><b>Poštna številka</b></label>
         <input type="number" placeholder="Vnesi poštno številko" name="postnumber" min="1000" required>
         <button type="submit">Ustvari</button>
    </form>

    <h3>Uredi podatke obstoječega profila stranke:</h3>
    <form action="<?= BASE_URL . "store/stranka" ?>" method="post">
         <label for="id"><b>ID stranke:</b></label>
         <input type="number" placeholder="Vnesi ID stranke" name="id" min="1">
         <input type="hidden" name="do" value="search">
         <button type="submit">Izberi stranko</button>
    </form>

</div>
