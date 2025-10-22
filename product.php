<?php
require 'PHP/config.php';

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
    <link rel="stylesheet" href="./CSS/index.css">
    <link rel="stylesheet" href="./CSS/product.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['title']) ?></title>
</head>
<body>
    <header class="header">
        <a href="index.php">
            <img src="./img/logo.png" alt="icon">
        </a>
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
          <img src="./IMG/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>" class="imageProduct">
            <p class="orderTag">Réserver</p>
        </div>

    </div>

</body>
</html>
