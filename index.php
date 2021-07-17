<?
require 'getData.php';

?>
<form  method="post">
  <input type="submit" value="загрузить данные в БД" name="getData">
</form><br>

<form method="get">
  <input type="search" minlength="3" name="search" id="search" required>
  <input type="submit" value="поиск" name="searchData">
</form>

<?
if ($_GET['searchData'] && strlen($_GET['search']) >= 3) {
  
  $result = $dbh->query("SELECT * FROM comments WHERE body LIKE '%$_GET[search]%'");
  
  echo 'Результат поиска: ' . $_GET['search'] . '<br>';

  foreach($result as $item) {
    
    echo "<div>
            <h2>Название статьи:</h2>
            <h3>$item[name]</h3>
            <p>$item[body]</p>
          </div><br>";
    
  }
} else {
  echo 'Для поиска нужно ввести минимум 3 символа';
}

?>