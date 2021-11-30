# Boilerplate PHP MVC

## Le projet

Ce projet est une base d'application PHP en architecture MVC et un système de routage. Le **routeur** peut prendre en charge les requêtes utilisant les verbes **GET** et **POST**.

### Architecture du projet

```
app
 | controllers <-- Dossier des controleurs
 | core <-- Dossier des classes de base du projet
 |   | Database.class.php <-- Classe "utilitaire" de connexion à la base de donnée
 |   | Router.class.php <-- Classe Routeur
 |   | Route.class.php <-- Class Route
 | models <-- Dossier des modèles
 | views <-- Dossier des vues
 | index.php <-- Point d'entrée de l'application

assets <-- Ressources à servir statiquement
 | images <-- Dossier images
 | scripts <-- Dossier des scripts (JS)
 | styles <-- Dossier des styles (CSS)

```

### Mode de fonctionnement

Le fichier .htaccess configure le serveur Apache pour qu'il cherche si le fichier demandé dans la requête existe dans le dossier assets (par exemple: /assets/styles/style.css). Si ce n'est pas le cas, le point d'entrée de l'application index.php est appelé. L'ensemble des routes créées est alors comparé au chemin de la requête. Si un route correspond, le contrôleur associé est appelé.

### Configuration

Attention, pour fonctionner, ce projet nécessite la **configuration d'un vhost**.

Pour cela:

- Ajoutez un nouveau nom d'hôte sur votre système dans le fichier d'hôtes (pour Windows: c:\Windows\System32\Drivers\etc\hosts et pour MacOS/Linux (en général): /etc/hosts) sous la forme:

```
127.0.0.1 monnouvelhote.local
```

- Ensuite ajoutez un nouveau vhost dans votre configuration apache dans le fichier httpd-vhosts.conf:

```
<VirtualHost *:80>
    DocumentRoot "chemin/vers/le/dossier/du/projet"
    ServerName monnouvelhote.local
</VirtualHost>
```

- Vous pouvez maintenant accéder au projet directement depuis votre nom d'hôte, soit dans l'exemple http://monnouvelhote.local .

## Ajouter une route

### Créer le controller, le modèle et la vue

Dans le dossier app/controllers, créez une **nouvelle classe** contenant une **methode** permettant de **traiter la requête** et **d'afficher la page**. Vous pouvez également ajouter une nouvelle méthode à une classe controleur existante.

Si nécessaire, créez également un **nouveau modèle** dans app/models et une **nouvelle vue** dans app/views.

N'hésitez pas à vous inspirer des classes existantes.

### Créer la route

Dans le fichier index.php, importez votre controller (si ce n'est pas déjà le cas). Si vous utilisez un namespace, vous pouvez créer un alias avec le mot clef "use" si vous le souhaitez.

N'oubliez pas d'instancier le contrôleur:

```
$nom_du_controleur = new NomDuControleur();
```

Vous pouvez ensuite ajouter à la suite des routes existantes votre ou vos nouvelles routes.

Pour une route **GET**:

```
$router->get("/chemin",  [instance_du_controleur, 'nom_de_la_methode']);
```

Pour une route **POST**:

```
$router->post("/chemin",  [instance_du_controleur, 'nom_de_la_methode']);
```
