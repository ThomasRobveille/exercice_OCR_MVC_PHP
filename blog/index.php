<?php 

require_once('src/controllers/homepage.php');
require_once('src/controllers/post.php');
require_once('src/controllers/add_comment.php');

try {
  if(isset($_GET['action']) && !empty($_GET['action'])) {
    if ($_GET['action'] === 'post') {
      if(isset($_GET['id']) && ($_GET['id'] > 0)) {
        $identifier = $_GET['id'];
        post($identifier);
      } else {
        throw new Exception('Erreur : aucun identifiant de billet envoyé';)
      }
    } elseif($_GET['action'] === 'addComment') {
      if(isset($_GET['id']) && ($_GET['id'] > 0)) {
        $identifier = $_GET['id'];
        addComment($identifier, $_POST);
      } else {
        throw new Exception('Erreur : aucun identifiant de billet envoyé';)
      }
    } else {
      throw new Exception('Erreur 404: page non trouvée';)
    }
  } else {
    homepage();
  }
} catch(Exception $e) {
  echo 'Erreur : ' . $e->getMessage();
}