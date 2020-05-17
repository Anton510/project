<?php

session_start();
//задание валидация
 if (strlen($_POST['comment']) == 0) {
 	 $_SESSION["comment"] =  "<div class='alert alert-success' role='alert'>Пожалуйста введите ваш комментарий</div>";
 	 header('Location: /index.php');
 	exit;
 	
 }
    
 	
//задание флеш уведомление

    $_SESSION['push'] = "<div class='alert alert-success' role='alert'>Комментарий успешно добавлен</div>" ;


//Соединение с базой
	
$driver = 'mysql'; // тип базы данных, с которой мы будем работать 

$host = 'localhost';// альтернатива '127.0.0.1' - адрес хоста, в нашем случае локального

$db_name = 'test'; // имя базы данных 

$db_user = 'root'; // имя пользователя для базы данных 

$db_password = ''; // пароль пользователя 

$charset = 'utf8'; // кодировка по умолчанию 

$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; // массив с дополнительными настройками подключения. В данном примере мы установили отображение ошибок, связанных с базой данных, в виде исключений

$dsn = "$driver:host=$host;dbname=$db_name;charset=$charset";


try {
	$conn = new PDO($dsn, $db_user, $db_password, $options); 
	$query = "INSERT INTO come VALUES ( NULL, :id_user, :name, NOW(), :comment)";
	$msg = $conn->prepare($query);
	$msg->execute(['id_user' => $_SESSION['id_user'], 'name' => $_SESSION['names'], 
	'comment' => $_POST['comment']]);
	// $result = $msg->fetchAll(PDO::FETCH_ASSOC);

	

	header('Location: /index.php');
}

catch (PDOException $e)
{
	echo "error";
}

?>
