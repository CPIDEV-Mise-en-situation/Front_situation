<?php

require 'PHP/config.php';
$reqUsers = $pdo->prepare("SELECT * FROM users");
$reqUsers->execute();
$users = $reqUsers->fetchAll(PDO::FETCH_ASSOC);

$reqProducts = $pdo->prepare("SELECT * FROM products");
$reqProducts->execute();
$products = $reqProducts->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/index.css">
    <link rel="stylesheet" href="./CSS/shopping.css">
    <title>LendMairie</title>
</head>

<body>
    <header class="header">
        <a href="index.php">
            <img src="./img/logo.png" alt="icon">
        </a>
        <nav id="navigation">
            <div class="nav">
                <ul>
                    <li><a href="">Produit</a></li>
                    <li><a href="">Profil</a></li>
                    <li><a href="">Connexion</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div>
        <div class="cardContainer">
            <?php
        foreach ($products as $product) {
            ?>
            <a href="product.php?id=<?= urlencode($product['id']) ?>" class="cardProductLink">
                <div class="cardProduct">
                    <img class="imageProduct" src="./IMG/<?= htmlspecialchars($product["image"]) ?>" alt="<?= htmlspecialchars($product["title"]) ?>" title="<?= htmlspecialchars($product["title"]) ?>">
                    <div class="imageContent">
                        <div class="imageTexts">
                            <h2><?= htmlspecialchars($product["title"]) ?></h2>
                            <p class="imageTag"><?= htmlspecialchars($product["status"]) ?></p>
                        </div>
                    </div>
                </div>
            </a>
            <?php
        }
        ?>
        </div>
    </div>
</body>

</html>