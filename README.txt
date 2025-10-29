===========================================
🏛️  Mairie de Verdun 🏛️
===========================================

Plateforme de prêt de matériel municipal entre la mairie et les habitants de Verdun 🌉
Projet réalisé dans le cadre de la mise en situation DEV – UV3B (SUP DE VINCI, Octobre 2025) 🎓

---

📌 DESCRIPTION
=============

Lend&Share Mairie est une application web permettant aux habitants de Verdun d’emprunter du matériel municipal (barnums, chaises, outils, vidéoprojecteurs, etc.) pour leurs événements personnels ou associatifs. 🎉
La plateforme offre :
- Une interface publique pour les habitants : consultation du catalogue, demandes de prêt, suivi des réservations. 📱
- Un espace d’administration pour la mairie : gestion des stocks, validation des prêts, clôture des retours. 🔑

---

🛠 TECHNOLOGIES UTILISÉES
=======================

🖥 Front-end :
- HTML5, CSS3 (fichiers modularisés par page) 🎨
- JavaScript (gestion des carouselles, header dynamique) ⚙️
- Polices : Roboto 🔤

🖥 Back-end :
- PHP 8.1+ 🐘
- Base de données : MySQL 8.0+ 🗃
- Authentification : Sessions PHP 🔒

---

📂 STRUCTURE DU PROJET
=====================

projet/
├── CSS/ 🎭
│   ├── connexion-inscription.css
│   ├── footer.css
│   ├── header.css
│   ├── index.css
│   ├── product.css
│   ├── root.css
│   └── shopping.css
├── img/ 🖼
│   ├── Partenaire/
│   │   ├── france-lef.png
│   │   ├── GIP.png
│   │   ├── Grand Est.png
│   │   ├── Leader.png
│   │   ├── Meuse.png
│   │   ├── Mewo.png
│   │   ├── prefet.png
│   │   └── UE.png
│   ├── banc.jpg
│   ├── barrière.jpg
│   ├── brouette.jpg
│   ├── chaise.jpg
│   ├── cone_signalisation.jpg
│   ├── Jeanne_d'Arc.jpg
│   ├── little-logo.jpg
│   ├── logo_republique_française.png
│   ├── logo.png
│   ├── mairie.jpg
│   ├── matériel_de_concert.jpg
│   ├── René Cassin.jpg
│   ├── SA BILLARD.jpg
│   ├── table.jpg
│   ├── Thierville.jpg
│   └── VerdunPhoto.jpg
├── JS/ 📜
│   ├── carouselles.js
│   └── header.js
├── MEDIA/ 🎬
│   └── Vidéo Verdun Meuse2 - Lorraine Tourisme - FR.mp4
├── PHP/ 🐘
│   ├── config.php
│   ├── connexion_process.php
│   ├── connexion.php
│   ├── inscription_process.php
│   ├── inscription.php
│   ├── logout.php
│   ├── product.php
│   ├── profil.php
│   └── shoplist.php
├── index.php
└── README.txt

---

🚀 INSTALLATION
=============

🔧 Prérequis communs :
- PHP 8.1+
- MySQL 8.0+
- Accès à un serveur web (Apache, Nginx, IIS)

---

🪟 Installation sur Windows Server (IIS)
-------------------------------------

1️⃣ Installer les dépendances :
   - Télécharger et installer PHP pour Windows (version 8.1, Thread Safe) : https://windows.php.net/download/ 🌐
   - Installer MySQL Server : https://dev.mysql.com/downloads/installer/ 🗄
   - Activer IIS via "Panneau de configuration > Programmes > Activer ou désactiver des fonctionnalités Windows" :
     ✅ Internet Information Services (IIS)
     ✅ CGI (pour PHP)

2️⃣ Configurer IIS :
   a. Ouvrir le Gestionnaire IIS. 🖥
   b. Ajouter un nouveau Site Web :
      - Chemin physique : C:\inetpub\wwwroot\projet (ou le dossier du projet). 📁
      - Lier à un port (ex: 80). 🔌
   c. Configurer PHP :
      - Dans IIS, aller dans "Gestionnaire de modules FastCGI". ⚙️
      - Ajouter un nouveau module pointant vers C:\php\php-cgi.exe.
      - Dans "Mappings des gestionnaires", ajouter un mapping pour *.php vers le module FastCGI.

3️⃣ Configurer la base de données :
   - Importer le script SQL dans phpMyAdmin ou via la ligne de commande :
     mysql -u root -p lendshare < chemin/vers/ton/script.sql 🗃

4️⃣ Mettre à jour le fichier PHP/config.php avec les identifiants de ta base de données. ✏️

5️⃣ Accéder à l’application :
   - Ouvrir http://localhost/projet dans ton navigateur. 🌐

---

🐧 Installation sur Linux (Apache/Nginx)
-------------------------------------

1️⃣ Installer les dépendances (Debian/Ubuntu) :
   sudo apt update
   sudo apt install apache2 mysql-server php libapache2-mod-php php-mysql
   sudo systemctl restart apache2 🔄

2️⃣ Configurer Apache :
   a. Copier le projet dans /var/www/html/ :
      sudo cp -r projet/ /var/www/html/ 📂
   b. Donner les permissions :
      sudo chown -R www-data:www-data /var/www/html/projet
      sudo chmod -R 755 /var/www/html/projet 🔐
   c. Configurer la base de données :
      sudo mysql -u root -p
      CREATE DATABASE lendshare; 🗃
      USE lendshare;
      SOURCE /chemin/vers/ton/script.sql;
   d. Mettre à jour PHP/config.php avec les identifiants MySQL. ✏️

3️⃣ Accéder à l’application :
   - Ouvrir http://localhost/projet dans ton navigateur. 🌐

---

🔧 Option : Utiliser Nginx
-----------------------

1️⃣ Installer Nginx et PHP-FPM :
   sudo apt install nginx php-fpm 📦

2️⃣ Configurer Nginx :
   a. Créer un fichier /etc/nginx/sites-available/projet avec le contenu suivant :
      server {
          listen 80;
          server_name localhost;
          root /var/www/html/projet;
          index index.php;

          location / {
              try_files $uri $uri/ =404;
          }

          location ~ \.php$ {
              include snippets/fastcgi-php.conf;
              fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
          }
      }
   b. Activer le site :
      sudo ln -s /etc/nginx/sites-available/projet /etc/nginx/sites-enabled/
      sudo systemctl restart nginx 🔄

---

🗃 BASE DE DONNÉES
===============

Structure requise (exemple) :
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    mot_de_passe VARCHAR(255),
    role ENUM('utilisateur', 'admin')
);

CREATE TABLE materiels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    description TEXT,
    image VARCHAR(255),
    statut ENUM('disponible', 'prêté')
);

Comptes de test :
+------------------+--------------+---------------+
| Email            | Mot de passe | Rôle          |
+------------------+--------------+---------------+
| habitant@test.fr | password123  | Utilisateur   |
| admin@mairie.fr  | admin123     | Administrateur|
+------------------+--------------+---------------+

---

✨ FONCTIONNALITÉS
===============

Pour les habitants :
- Connexion/Inscription : Formulaires sécurisés. 🔐
- Catalogue : Affichage des matériaux disponibles avec filtres. 🔍
- Fiche produit : Détails et demande de prêt. 📄
- Profil : Suivi des emprunts en cours. 👤

Pour la mairie :
- Gestion des matériaux : Ajout/modification via l’espace admin. ✏️
- Validation des prêts : Interface dédiée. ✅

---

👥 CONTRIBUTEURS
=============

- Thibault Vuillaume (https://github.com/thibaultvlm) 👨‍💻
- Léo Troup (https://github.com/SSVGLeo) 👨‍💻
- Elodie Parisot (https://github.com/Elodieparisot54) 👨‍💻

---

📄 LICENCE
=========

Projet pédagogique. Les images et médias sont utilisés à titre d’exemple ou sont libres de droit. 📜

---

📬 CONTACT
=========

Pour toute question : thibault.vuillaume@etu.supdevinci.fr ✉️
