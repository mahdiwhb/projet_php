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

    if(isset($_POST['select'])){
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", "$username");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            exit();
        }

        // Sécurisation des entrées
        $login = htmlspecialchars(trim($_POST['login']));
        $password = $_POST['pwd'];

        // Récupération des informations de l'utilisateur
        $stmt = $pdo->prepare("SELECT id, PASSWORD FROM User WHERE login = :login");
        $stmt->execute(['login' => $login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['PASSWORD'])) {
            // Connexion réussie
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['login'] = $login;

            echo "<div class='form'>
                    <h3 class='titre'>Connexion réussie !</h3>
                    <br><br>
                    <a href='http://localhost/projet_PHP/html/products.html' class='btn'>Continuez sur notre site</a>
                    <a href='javascript:history.back()' class='btn btnMenu'>Précédent</a>
                  </div>";
        } else {
            // Connexion échouée
            echo "<div class='form'>
                    <h3 class='titre'>Connexion échouée ! Identifiants incorrects.</h3>
                    <br><br>
                    <a href='javascript:history.back()' class='btn'>Retour</a>
                  </div>";
        }
    }
    ?>
</body>
</html>
