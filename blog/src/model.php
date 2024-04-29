<?php
  function getPosts() {
    $database = dbConnect();

    // We retrieve the 5 last posts
    $statement = $database->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS fr_creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

    $posts = [];
    while (($row = $statement->fetch())) {
      $post = [
        'title' => $row['title'],
        'french_creation_date' => $row['fr_creation_date'],
        'content' => $row['content'],
        'identifier' => $row['id']
      ];
  
      $posts[] = $post;
    }

    return $posts;
  }

  function getPost($identifier){
    $database = dbConnect();

    $statement = $database->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS fr_creation_date FROM posts WHERE id = ?');
    $statement->execute([$identifier]);

    $row = $statement->fetch();
    $post = [
      'title' => $row['title'],
      'french_creation_date' => $row['fr_creation_date'],
      'content' => $row['content'],
      'identifier' => $row['id']
    ];
    
    return $post;
  }

  function getComments($identifier){
    $database = dbConnect();

    $statement = $database->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS fr_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
    $statement->execute([$identifier]);

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

  function dbConnect(){
    try {
      $database = new PDO('mysql:host=localhost;dbname=ocr;charset=utf8', 'root', '');
      return $database;
    } catch(Exception $e){
      die( 'Erreur : '.$e->getMessage()   );
    }

    
  }
