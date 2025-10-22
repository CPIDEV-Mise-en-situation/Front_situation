<?php
require_once __DIR__ . '/config.php';

$id = (int)$_GET['id'];
$req = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$req->execute([$id]);
$product = $req->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header('Location: shoplist.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/product.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['title']) ?></title>
</head>
<body>
    <header class="header">
        <a href="../index.php">
            <img src="../img/logo.png" alt="icon">
        </a>
        <nav id="navigation">
            <div class="nav">
                <ul>
                    <li><a href="shoplist.php">Produit</a></li>
                    <li><a href="">Profil</a></li>
                    <li><a href="connexion.php">Connexion</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="productContainer">

        <div class="productContent">
            <h1 id="productTitle"><?= htmlspecialchars($product['title']) ?></h1>
            <h2>A propos de ce produit :</h2>
            <p><?= htmlspecialchars($product['desc_']) ?></p>
            <div class="productStatus">
                <h2>Caution : <?= htmlspecialchars($product['price']) ?>€</h2>
                <p class="contentTag"><?= htmlspecialchars($product["status"]) ?></p>
            </div>
        </div>
        
        <div class="ProductImage">
          <img src="../IMG/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>" class="imageProduct">
            <p class="orderTag">Réserver</p>
        </div>

    </div>

    <footer id="footer">
        <img src="../IMG/logo.png" alt="Logo" id="footer-icon">
        <div id="contact">
            <ul>
                <li><p>Contact :</p></li>
                <li><a href="">19 place du Duroc</a></li>
                <li><a href="">54700 Pont-à-Monsson</a></li>
                <li><a href="">+33 3 83 81 10 68</a></li>
            </ul>
        </div>
        <div id="infos">
            <ul>
                <li><a href="">Mentions légales</a></li>
                <li><a href="">Accessibilité</a></li>
                <li><a href="">Gestion des cookies</a></li>
            </ul>
        </div>
        <div id="equipe"><p>Team CPIDEV</p></div>
    </footer>

</body>
</html>
