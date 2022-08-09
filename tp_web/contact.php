<?php
require_once 'db.php';
$errore = "";
$id = "";
if (isset($_COOKIE['identifiant'])) {
    $id =  $_COOKIE['identifiant'];
}
if (isset($_POST['submit'])) {
    if (empty($_POST['mail']) || empty($_POST['contact1']) || empty($_POST['contact2'])) {
        $errore = "Veuillez sasir tous les champs";
    } else {
        $contact1 = htmlspecialchars($_POST['contact1']);
        $contact2 = htmlspecialchars($_POST['contact2']);
        $mail = htmlspecialchars($_POST['mail']);

        $req = "INSERT INTO contacts (id_user, contact1, contact2,adressemail) VALUES ('$id', '$contact1', '$contact2', '$mail')";

        if (mysqli_query($conn, $req)) {
            echo '<script>alert("données enreigistrées")</script>';
            header("Location:dash.php");
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
                    <img src="img/av.png" alt="" srcset="">
                    <h2>Contacts</h2>
                </div>
            </div>
            <div class="form_start">
                <form method="POST" action="contact.php" id="my_form" name="myForm">
                    <div class="n">
                        <?php echo $errore ? $errore : null; ?>
                    </div>
                    <div class="form_group">
                        <span class="icons fas fa-phone"></span>
                        <input type="tel" name="contact1" placeholder="contact1" id="nom" required />

                    </div>
                    <div class="form_group">
                        <span class="icons fas  fa-phone"></span>
                        <input type="tel" name="contact2" placeholder="contact2" id="contact2" required />
                    </div>
                    <div class="form_group">
                        <span class="icons fas fa-envelope"></span>
                        <input type="mail" name="mail" placeholder="mail" id="mail" required />

                    </div>
                    <button type="submit" class="btn" name="submit">Enreigistrer</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>