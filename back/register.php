<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/register.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <title>FORMULAIRE</title>
</head>
<body>
    <div class="logo"><img src="../images/Logo_berbere.png" alt="Logo"></div>

    <?php
    $host = 'localhost';
    $dbname = 'tp_web';
    $username = 'root';

    if(isset($_POST['insert'])){
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", "$username");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            exit();
        }

        // Sécurisation des entrées
        $firstname = htmlspecialchars(trim($_POST['firstname']));
        $lastname = htmlspecialchars(trim($_POST['lastname']));
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $login = htmlspecialchars(trim($_POST['login']));
        $password = $_POST['pwd'];

        if ($email) {
            // Vérification de l'existence de l'email et du login
            $check_user = $pdo->prepare("SELECT id FROM user WHERE EMAIL = :email OR LOGIN = :login");
            $check_user->execute(['email' => $email, 'login' => $login]);
            
            if ($check_user->rowCount() > 0) {
                echo "<div class='form'><h3 class='titre'>L'email ou le login est déjà utilisé !</h3>
                      <a href='javascript:history.back()' class='btn'>Retour</a></div>";
            } else {
                // Hachage sécurisé du mot de passe
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                // Insertion des données
                $sql = "INSERT INTO `user`(`F_NAME`, `L_NAME`, `EMAIL`, `LOGIN`, `PASSWORD`) 
                        VALUES (:firstname, :lastname, :email, :login, :password)";
                $stmt = $pdo->prepare($sql);
                $exec = $stmt->execute([
                    ":firstname" => $firstname, 
                    ":lastname" => $lastname, 
                    ":email" => $email, 
                    ":login" => $login, 
                    ":password" => $hashed_password
                ]);

                if ($exec) {
                    echo "<div class='form'>
                            <h1 class='titre'>Votre compte a été créé avec succès !</h1>
                            <br><br>
                            <a href='http://localhost/projet_PHP/index.php' class='btn'>Accueil</a>
                            <a href='http://localhost/projet_PHP/html/login.html' class='btn btnMenu'>Se connecter</a>
                          </div>";
                } else {
                    echo "<div class='form'><h3 class='titre'>Échec de l'inscription.</h3><a href='javascript:history.back()' class='btn'>Retour</a></div>";
                }
            }
        } else {
            echo "<div class='form'><h3 class='titre'>Email invalide.</h3><a href='javascript:history.back()' class='btn'>Retour</a></div>";
        }
    }
    ?>
</body>
</html>
