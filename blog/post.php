<?php
 
require('src/model.php');

if(isset($_GET['id']) && !empty($_GET['id'])) {
  $identifier = $_GET['id'];
} else {
  echo 'Erreur : aucun identifiant de billet envoyé';
  die;
}

$post = getPost($identifier);
$comments = getComments($identifier);

require('templates/post.php');