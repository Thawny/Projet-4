Projet-4
========
** Accessible à l'adresse louvre.tony-malto.fr **       

Un projet fictif réalisé avec Symfony ayant pour but créer une billetterie en ligne pour le musée du Louvre.

Installer le projet sur sa machine :

- À la racine de votre serveur local, réer un nouveau dossier qui contiendra le projet puis se rendre dans se dossier depuis le terminal.
- Si git est installer, jouer la commande "git clone https://github.com/Thawny/Projet-3.git"
- Une partie du code s'installera alors sur la votre machine locale dans le dossier dans lequel vous vous trouviez au moment ou
    vous avez joué la commande.
- Parmi les fichiers qui viennent de s'installer doit se trouver un fichier composer.json qui contient toutes les dépendances
    du projet.
- Si composer n'est pas déjà installé sur votre machine, installez à l'emplacement de votre choix en jouant les commande :
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
- Une fois composer installé, retournez dans le dossier du projet si vous l'avez quitté et jouer la commande :
    "php chemin/vers/composer.phar install"
- Si tout s'est bien passé, toutes la dépendances nécessaires au bon fonctionnement du projet seront installées.
