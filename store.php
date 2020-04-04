<?php
//задание флеш уведомление
session_start();
    $_SESSION['push'] = "<div class='alert alert-success' role='alert'>Комментарий успешно добавлен</div>" ;
   if (strlen($_POST['name']) == 0)  echo "<div class='alert alert-success' role='alert'>Пожалуйста введите ваше имя</div>" ;
    if (strlen($_POST['comment']) == 0)  echo "<div class='alert alert-success' role='alert'>Пожалуйста введите ваш комментарий</div>" ;
//Соединение с базой
try {
	$conn = new PDO("mysql:host=localhost;dbname=test;", "root", "");
	

	$query = "INSERT INTO comments VALUES (NULL , :name, NOW(), :comment)";
	$msg = $conn->prepare($query);
	$msg->execute(['name'=> $_POST['name'], 'comment' => $_POST['comment']]);


	header('Location: /index.php');
}

catch (PDOException $e)
{
	echo "error";
}

?>
