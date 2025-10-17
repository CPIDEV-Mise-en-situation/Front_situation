<?php
// require 'config.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $file_id = $_POST['file_id'];
//     $new_name = $_POST['new_name'];

//     // Validation du nom de fichier
//     if (empty($new_name)) {
//         echo "Le nom du fichier ne peut pas être vide.";
//         exit;
//     }

//     // Récupérer le chemin du fichier original
//     $stmt = $pdo->prepare("SELECT file_path FROM files WHERE id = ?");
//     $stmt->execute([$file_id]);
//     $file = $stmt->fetch(PDO::FETCH_ASSOC);

//     if ($file) {
//         $file_path = $file['file_path'];
//         $new_file_path = dirname($file_path) . '/' . $new_name;

//         // Renommer le fichier dans la base de données
//         $stmt = $pdo->prepare("UPDATE files SET file_name = ?, file_path = ? WHERE id = ?");
//         $stmt->execute([$new_name, $new_file_path, $file_id]);

//         // Renommer le fichier physiquement
//         rename($file_path, $new_file_path);

//         echo "Fichier renommé avec succès ! <a href='files.php'>Retour à la liste des fichiers</a>";
//     } else {
//         echo "Fichier introuvable.";
//     }
//     exit;
// }

// $file_id = $_GET['file_id'];
// $stmt = $pdo->prepare("SELECT file_name FROM files WHERE id = ?");
// $stmt->execute([$file_id]);
// $file = $stmt->fetch(PDO::FETCH_ASSOC);

// if (!$file) {
//     echo "Fichier non trouvé.";
//     exit;
// }

require 'PHP/config.php';
$user = $pdo->prepare("INSERT INTO () VALUES ()");
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/index.css">
    <title>LendMairie</title>
</head>
<body>
    <header class="header">
        <img src="./img/logo.png" alt="icon"> 
            <nav id="navigation">  
                    <div class="nav">
                        <ul>
                            <li><a href="shoplist.php">Produit</a></li>
                            <li><a href="">Profil</a></li>
                            <li><a href="">Connexion</a></li>
                        </ul>
                    </div>     
            </nav>
    </header>
</body>
</html>