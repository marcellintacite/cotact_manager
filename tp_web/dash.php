<?php include 'db.php';
$users = [];
$sql = "SELECT * FROM users";
$results = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($results, MYSQLI_ASSOC);

if (isset($_COOKIE['identifiant'])) {
    $id =  $_COOKIE['identifiant'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dash.css">
    <link rel="stylesheet" href="font/css/all.css">
    <title>Utilisateurs</title>
</head>

<body>
    <nav>
        <span class="logo">Bienv<span>enue</span></span>
        <div class="right">
            <span class="fas fa-user"></span>
            <p><?php echo $id ?></p>
        </div>
    </nav>
    <div class="container">
        <div class="sidebar">
            <div class="logout_btn">
                <a href="logout.php">Se deconnecter</a>
            </div>
        </div>
        <div class="contacts">
            <div class="cards">
                <?php echo empty($users) ? "<h2 style:'padding:10px;'>Pas d'utilisateur</h2>" : null; ?>

                <?php foreach ($users as $user) : ?>
                    <div class="card">
                        <div class="card_header">
                            <div class="user_box">
                                <span class="fas fa-user"></span>
                            </div>
                            <div class="user_details">
                                <span class="nom"><?php echo $user['nom'];  ?></span>
                                <span class="identifiant"><?php echo $user['login'];  ?></span>
                            </div>
                            <div class="action">
                                <span class="fa fa-edit"></span>
                            </div>
                        </div>
                        <div class="card_body">
                            <?php
                            $usere = $user['login'];
                            $sqln = "SELECT * FROM contacts WHERE id_user = '$usere'";
                            $results = mysqli_query($conn, $sqln);
                            $contact = mysqli_fetch_all($results, MYSQLI_ASSOC);

                            if (isset($_POST['submit'])) {
                                $contact1 = htmlspecialchars($_POST['contact1']);
                                $contact2 = htmlspecialchars($_POST['contact2']);
                                $mail = htmlspecialchars($_POST['mail']);
                                $id = $_COOKIE['identifiant'];
                                $c = $contact[0]['user_id'];
                                $req = "UPDATE contacts SET contact1='$contact1', contact2 = '$contact2',adressemail='$mail' WHERE id_user = '$usere'";
                                if (mysqli_query($conn, $req)) {
                                    echo '<script>alert("mis à jour effectuer")</script>';
                                    header("Location:dash.php");
                                } else {
                                    echo "erreur";
                                }
                            }

                            echo "<div class='contact_box'>
                                <h4>Contacts</h4>
                                <div class='contact_c'>
                                    <span class='fas fa-phone'></span>
                                    <span>" . $contact[0]['contact1'] . "</span>
                                </div>
                                <div class='contact_c'>
                                    <span class='fas fa-phone'></span>
                                    <span>" . $contact[0]['contact2'] . "</span>
                                </div>
                                <div class='contact_c'>
                                    <span class='fas fa-envelope'></span>
                                    <span>" . $contact[0]['adressemail'] . "</span>
                                </div>
                            </div>"
                            ?>
                        </div>
                        <div class="form_update">
                            <form action="dash.php" method="POST">
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
                                <button type="submit" class="btn" name="submit">Mettre à jour</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>