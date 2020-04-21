<?php
session_start();

	//Соединение с базой
	
		$driver = 'mysql'; // тип базы данных, с которой мы будем работать 

$host = 'localhost';// альтернатива '127.0.0.1' - адрес хоста, в нашем случае локального

$db_name = 'test'; // имя базы данных 

$db_user = 'root'; // имя пользователя для базы данных 

$db_password = ''; // пароль пользователя 

$charset = 'utf8'; // кодировка по умолчанию 

$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; // массив с дополнительными настройками подключения. В данном примере мы установили отображение ошибок, связанных с базой данных, в виде исключений

$dsn = "$driver:host=$host;dbname=$db_name;charset=$charset";

$pdo = new PDO($dsn, $db_user, $db_password, $options); 
// Подготовка и выполнение запроса
		$email = trim($_POST['email']);
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			"всё ок";
		} else {
			$_SESSION["stop_valid"] =  "<div class='alert text-danger' role='alert'>Неверный формат Email</div>";
     				header('Location: /login.php');
 					exit;
		}

		$pwd = trim($_POST['password']);

		if( !empty($email) && !empty($pwd) ){
			$sql = 'SELECT email, password FROM register WHERE email = :email';
			$params = [':email' => $email];
			$stmt = $pdo->prepare($sql);
			$stmt->execute($params);
		
			$user = $stmt->fetch(PDO::FETCH_OBJ);
		
			if($user){

				if( password_verify($pwd, $user->password) ) {
					$_SESSION['user_login'] = $user->email;
					header('Location: /index.php'); 
					exit;
				} else {
					$_SESSION["stop_login"] =  "<div class='alert text-danger' role='alert'>Неверный логин или пароль</div>";
     				header('Location: /login.php');
 					exit;
				} 
			} else {
				$_SESSION["stop_login"] =  "<div class='alert text-danger' role='alert'>Неверный логин или пароль</div>";
     				header('Location: /login.php');
 					exit;
			}
		} else {
			$_SESSION["stop_nul"] =  "<div class='alert text-danger' role='alert'>Пожалуйста, заполните все поля</div>";
     				header('Location: /login.php');
 					exit;
		}
?>