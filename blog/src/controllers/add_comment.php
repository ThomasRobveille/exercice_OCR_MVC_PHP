<?php

require_once('src/model.php');

function addComment(string $post, array $input){
  $author = null;
  $comment = null;
  if( !empty($input['author']) && !empty($input['comment']) ){
    $author = $input['author'];
    $comment = $input['comment'];
  } else {
    throw new Exception('Erreur : tous les champs ne sont pas remplis';)
  }

  $success = createComment($post, $author, $comment);
  if($success){
    header('Location: index.php?action=post&id=' . $post);
  } else {
    throw new Exception('Erreur : impossible d\'ajouter le commentaire';)
  }
}