<?php
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