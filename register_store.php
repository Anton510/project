<?php
session_start();

//Задание валидация данных
if (strlen($_POST['name']) == 0) {
     $_SESSION["name"] =  "<div class='alert text-danger' role='alert'>Пожалуйста введите ваше имя</div>";
     header('Location: /register.php');
 	exit;
}
if (strlen($_POST['email']) == 0) {
     $_SESSION["email"] =  "<div class='alert text-danger' role='alert'>Пожалуйста введите ваше Email</div>";
     header('Location: /register.php');
 	exit;
}
if (strlen($_POST['password']) == 0) {
     $_SESSION["password"] =  "<div class='alert text-danger' role='alert'>Пожалуйста введите ваш пароль</div>";
     header('Location: /register.php');
 	exit;
}
if (strlen($_POST['Confirm']) == 0) {
     $_SESSION["Confirm"] =  "<div class='alert text-danger' role='alert'>Пожалуйста введите ваш пароль</div>";
     header('Location: /register.php');
 	exit;
}

// валидация Email
$email_a = $_POST['email'];
if (filter_var($email_a, FILTER_VALIDATE_EMAIL)) {
    echo "E-mail адрес '$email_b' указан верно.\n";
} else {
    $_SESSION['email_a'] = "E-mail адрес указан неверно.\n";

	header('Location: /register.php');
 	exit;
}
 

// Хэширование пароля
$pwd = $_POST['password'];
$hash = password_hash($pwd, PASSWORD_DEFAULT);

//Соединение с базой
try {
	$pdo = new PDO("mysql:host=localhost;dbname=test;", "root", "");
// Подготовка и выполнение запроса
	$sql = "INSERT INTO register ( name, email, password) VALUES ( :name, :email, :password)";
	$statement = $pdo->prepare($sql);
	$statement->execute(['name'=> $_POST['name'], 'email'=> $_POST['email'],'password' => $hash]);
	header('Location: /index.php');
}
catch (PDOException $e)
{
	echo "error";
}
?>