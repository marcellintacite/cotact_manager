<?php
require_once 'db.php';
$errore = "";

if (isset($_COOKIE['identifiant'])) {
    header("Location:dash.php");
}

if (isset($_POST['submit'])) {
    if (empty($_POST['nom']) || empty($_POST['identifiant']) || empty($_POST['pass'])) {
        $errore = "Veuillez sasir tous les champs";
    } else {
        $nom = htmlspecialchars($_POST['nom']);
        $identifiant = htmlspecialchars($_POST['identifiant']);
        $pass = htmlspecialchars($_POST['pass']);

        $req = "INSERT INTO users (nom, login, pass) VALUES ('$nom', '$identifiant', '$pass')";

        if (mysqli_query($conn, $req)) {
            setcookie("identifiant", $identifiant, time() + 86400 * 30);
            echo '<script>alert("données enreigistrées")</script>';
            header("Location:contact.php");
        } else {
            echo "erreur";
        }
    };
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="font/css/all.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="form_content">
            <div class="user_avatar">
                <div class="c" style="color:'red';">
                    <img src="img/avatar.png" alt="" srcset="">
                    <h2>Inscription</h2>
                </div>
            </div>
            <div class="form_start">
                <form method="POST" action="index.php" id="my_form" name="myForm">
                    <div class="n">
                        <?php echo $errore ? $errore : null; ?>
                    </div>
                    <div class="form_group">
                        <span class="icons fas fa-user"></span>
                        <input type="text" name="nom" placeholder="Nom complet" id="nom" required />

                    </div>
                    <div class="form_group">
                        <span class="icons fas fa-envelope"></span>
                        <input type="text" name="identifiant" placeholder="identifiant/login" id="id" required />
                    </div>
                    <div class="form_group">
                        <span class="icons fas fa-key"></span>
                        <input type="password" name="pass" placeholder="mot de passe" id="pass" required />

                    </div>
                    <button type="submit" class="btn" name="submit">Valider</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>