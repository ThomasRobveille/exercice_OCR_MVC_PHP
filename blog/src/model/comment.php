<?php

function getComment(string $post){
  $database = commentDbConnect();
  $statement = $database->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS fr_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
  $statement->execute([$post]);

  $comments = []; 
  while (($row = $statement->fetch())) {
    $comment = [
      'author' => $row['author'],
      'comment' => $row['comment'],
      'french_creation_date' => $row['fr_creation_date']
    ];
    $comments[] = $comment;
  }

  return $comments;
}

function createComment(string $post, string $author, string $comment){
  $database = commentDbConnect();
  $statement = $database->prepare('INSERT INTO comments (author, comment, comment_date, post_id) VALUES (?, ?, NOW(), ?)');
  $affectedLines = $statement->execute([$author, $comment, $post]);

  return ($affectedLines > 0);
}

function commentDbConnect(){
  try {
    $database = new PDO('mysql:host=localhost;dbname=ocr;charset=utf8', 'root', '');
    return $database;
  } catch(Excetion $e) {
    die('Erreur : ' . $e->getMessage());
  }

}