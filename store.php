<?php
session_start();
    $_SESSION['push'] = "<div class='alert alert-success' role='alert'>Комментарий успешно добавлен</div>" ;

//Соединение с базой
try {
	$conn = new PDO("mysql:host=localhost;dbname=test;", "root", "");
	if (empty($_POST['name'])) exit("Поле не заполнено");
	if (empty($_POST['comment'])) exit("Поле не заполнено блин");

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
