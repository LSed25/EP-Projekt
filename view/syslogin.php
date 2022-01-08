<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sistemska prijava</title>
    </head>
    <body>
        <h1>Sistemska prijava</h1>

        <?php
        $authorized_roles = ["administrator", "prodajalec"];
        $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");
        $cert_data = openssl_x509_parse($client_cert);
        if(!$cert_data) {
            http_response_code(403);
            die('Uporabnik ni avtoriziran.');
        }else{
        
            $role = $cert_data["subject"]["role"];

            if(in_array($role, $authorized_roles)) { ?>
                <form action="<?= BASE_URL . "store/login" ?>" method="post">
                   <p><label>E-naslov: <input type="email" name="email" placeholder="Vnesite e-naslov" /></label></p>
                   <p><label>Geslo: <input type="password" name="password" placeholder="Vnesite geslo" /></label></p>
                   <input type="hidden" name="role" value="<?= $role ?>">
                   <p><button>Prijava</button></p>
                </form>

                <div><?php if(isset($message)) { echo $message; } ?></div>
            <?php 
            }
            else { ?>
                <p>Uporabnik ni avtoriziran.</p>
            <?php
            }
        }
        ?>
    </body>
</html>