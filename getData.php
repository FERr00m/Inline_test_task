<?
require 'db.php';


//Получаем данные
if (isset($_POST['getData'])) {
  $posts = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/posts'), true);

  $comments = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/comments'), true);

  // отправляем данные в БД
  if ($posts && $comments) {
    foreach ($posts as $post) {
    $dbh->query("INSERT INTO `posts` (id, userId, title, body) 
                  VALUES ('$post[id]', '$post[userId]', '$post[title]', '$post[body]')");
  }

  foreach ($comments as $comment) {
    $dbh->query("INSERT INTO `comments` (id, postId, name, email, body) 
                  VALUES ('$comment[id]', '$comment[postId]', '$comment[name]', '$comment[email]', '$comment[body]')");
  }
    echo '<script>console.log("Загружено ' . count($posts) . ' записей и ' . count($comments) . ' комментариев")</script>';
  } else {
    echo 'Что-то пошло не так';
  }
}



