<?php
//Соединение с базой

try {
	$conn = new PDO("mysql:host=localhost;dbname=test;", "root", "");
	if (empty($_POST['name'])) exit("Поле не заполнено");
	if (empty($_POST['content'])) exit("Поле не заполнено блин");

	$query = "INSERT INTO massage (message_id, name, message_date) VALUES (NULL , :name, NOW())";
	$msg = $conn->prepare($query);
	$msg->execute(['name'=> $_POST['name']]);

	$msg_id = $conn->lastInsertId();
	$query = "INSERT INTO massage_content (content_id , content, message_id) VALUES (NULL , :content, :message_id)";
	$msg = $conn->prepare($query);
	$msg->execute(['content' => $_POST['content'], 'message_id' => $msg_id]);
	header('Location: /index.php');
}

catch (PDOException $e)
{
	echo "error";
}

?>