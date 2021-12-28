<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sistemska prijava</title>
    </head>
    <body>
        <?php
        $authorized_users = ["admin", "prodaja"];

        $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");
        $cert_data = openssl_x509_parse($client_cert);
        
        if(!$cert_data) {
            http_response_code(403);
            die('Forbidden');
        }else{

        ?>
        <h1>Sistemska prijava</h1>
        <form action="<?= BASE_URL . "store/login" ?>" method="post">
            <p><label>E-naslov: <input type="email" name="email" value="<?= $email ?>" /></label></p>
            <p><label>Geslo: <input type="password" name="password" value="<?= $password ?>" /></label></p>
            <p><button>Prijava</button></p>
        </form>
        <?php } ?>
    </body>
</html>