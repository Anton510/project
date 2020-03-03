<?php
  /* Принимаем данные из формы */
  $name = $_POST["name"];
  $id = $_POST["id"];
  $comment = $_POST["comment"];
  $name = htmlspecialchars($name);// Преобразуем спецсимволы в HTML-сущности
  $comment = htmlspecialchars($comment);// Преобразуем спецсимволы в HTML-сущности
  $mysqli = new mysqli("localhost", "root", "", "test");// Подключается к базе данных
  $mysqli->query("INSERT INTO `comments` (`name`, `id`, `comment`) VALUES ('$name', '$id', '$comment')");// Добавляем комментарий в таблицу
  header("Location: ".$_SERVER["HTTP_REFERER"]);// Делаем реридект обратно
?>