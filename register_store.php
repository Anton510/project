<?php
//Соединение с базой
try {
	$pdo = new PDO("mysql:host=localhost;dbname=test;", "root", "");
// Подготовка и выполнение запроса
	$sql = "INSERT INTO register ( name, email, password, Confirm) VALUES ( :name, :email, :password, :Confirm)";
	$statement = $pdo->prepare($sql);
	$statement->execute(['name'=> $_POST['name'], 'email'=> $_POST['email'],'password' => $_POST['password'], 'Confirm' => $_POST['Confirm']]);
	header('Location: /index.php');
}
catch (PDOException $e)
{
	echo "error";
}

?>