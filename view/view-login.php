<title>Prijava</title>

<h1>Prijava</h1>

<form action="<?= BASE_URL . "store/login" ?>" method="post">
    <p><label>E-naslov: <input type="email" name="email" placeholder="Vnesite e-naslov"/></label></p>
    <p><label>Geslo: <input type="password" name="password" placeholder="Vnesite geslo" /></label></p>
    <input type="hidden" name="role" value="stranka">
    <p><button>Prijava</button> Še nimaš računa? <a href="<?= BASE_URL . "store/register" ?>">Registriraj se</a>
</form>

<div><?php if (isset($variables["message"])) {echo $variables["message"];}?></div>

<p><a href="<?= BASE_URL . "store/syslogin" ?>">Sistemska prijava</a></p>