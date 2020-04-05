<?php
//задание валидация
 if (strlen($_SESSION['name']) == 0)   "<div class='alert alert-success' role='alert'>Пожалуйста введите ваше имя</div>" ;
    if (strlen($_SESSION['comment']) == 0)  "<div class='alert alert-success' role='alert'>Пожалуйста введите ваш комментарий</div>" ;
    header('Location: /index.php');
    	else exit;
//задание флеш уведомление
session_start();
    $_SESSION['push'] = "<div class='alert alert-success' role='alert'>Комментарий успешно добавлен</div>" ;

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
