<?php

session_start();
//задание валидация
if (strlen($_POST['name']) == 0) {
     $_SESSION["name"] =  "<div class='alert alert-success' role='alert'>Пожалуйста введите ваше имя</div>";
 header('Location: /index.php');
 	exit;
}
 if (strlen($_POST['comment']) == 0) {
 	 $_SESSION["comment"] =  "<div class='alert alert-success' role='alert'>Пожалуйста введите ваш комментарий</div>";
 	 header('Location: /index.php');
 	exit;
 	
 }
    
    	
//задание флеш уведомление

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
