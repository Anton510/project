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
// задание сортировки
$statement = $pdo->prepare("SELECT * FROM come LEFT JOIN reg ON reg.id=come.id_user
 ORDER BY id_com DESC");
// $params = [':id' => $_SESSION['id_user']];

$statement->execute($params);
$massage = $statement->fetchAll(PDO::FETCH_ASSOC);



$_SESSION['names'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Comments</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    Project

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                    <!-- Left Side Of Navbar -->
                    <ul class='navbar-nav mr-auto'>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class='navbar-nav ml-auto'>

                       
                        <!-- набор сессий-->

                        <?php
                        
                        // сессия мению
                        $_SESSION['menu_2'] = "<div class='dropdown'>
                        <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                     $_SESSION[names]
                        </button>
                         <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                          <a class='dropdown-item' href='profile.php'>Профиль</a>
                           <a class='dropdown-item' href='exit.php'>Выход</a>
                        </div>
                      </div>";

                        $_SESSION['menu_1'] = "<li class='nav-item'>
                      <a class='nav-link' href='login.php'>Login</a>
                  </li>
                  <li class='nav-item'>
                      <a class='nav-link' href='register.php'>Register</a>
                  </li> ";

                        // сессия комментария
                        $_SESSION['comit'] = "<div class='card-body'>
                        <form action='store.php' method='post'>
                            <div class='form-group'>
                                <label for='exampleFormControlTextarea1'>Имя</label>
                                <input name='name' class='form-control' id='exampleFormControlTextarea1' />
                                <?php echo $_SESSION[name];
                                unset($_SESSION[name]); ?>
                            </div>

                            <div class='form-group'>

                                <label for='exampleFormControlTextarea1'>

                                    Сообщение</label>
                                <textarea name='comment' class='form-control' id='exampleFormControlTextarea1' rows='3'></textarea>
                                <?php echo $_SESSION[comment];
                                unset($_SESSION[comment]); ?>
                            </div>

                            <button type='submit' name='done' class='btn btn-success'>Отправить</button>
                        </form>
                    </div>";
                        ?>

                        <!-- типо показывает при авторизации-->
                        <?php
                        if ($_SESSION['enter']) {
                            echo $_SESSION['menu_2'];
                        } elseif ($_COOKIE['remember'] != '') {
                            $_SESSION['enter'];
                            echo $_SESSION['menu_2'];
                        } else {
                            echo $_SESSION['menu_1'];
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Комментарии</h3>
                            </div>

                            <div class="card-body">
                                <!-- задание флеш уведомление -->
                                <?php echo $_SESSION['push'];

                                unset($_SESSION['push']);
                                ?>
                                

                                <?php
                                
                                foreach ($massage as $comment) : ?>
                                    <div class="media">
                                        <img src="<?php echo $comment['user_image']; ?>" class="mr-3" alt="..." width="64" height="64">
                                        <div class="media-body">
                                            <h5 class="mt-0"><?php echo $comment['names']; ?></h5>
                                            <!-- задание редактирование даты -->
                                            <span><small><?= date("d/m/Y", strtotime($comment['data'])) ?></small></span>
                                            <p>
                                                <?php echo $comment['comment']; ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" style="margin-top: 20px;">
                        <div class="card">
                            <div class="card-header">
                                <h3>Оставить комментарий</h3>

                            </div>
                                <!-- ---------------------------------------- блок комментария -->
                                <?php
                        if ($_SESSION['enter']) {
                            echo "<div class='card-body'>
                            <form action='store.php' method='post'>
                                

                                <div class='form-group'>

                                    <label for = 'exampleFormControlTextarea1'>

                                        Сообщение</label>
                                    <textarea name='comment' class='form-control' id='exampleFormControlTextarea1' rows='3'></textarea>
                                      $_SESSION[comment]
                                    unset ($_SESSION[comment])
                                </div>

                                <button type='submit' name='done' class='btn btn-success'>Отправить</button>
                            </form>
                        </div>";
                        } elseif ($_COOKIE['remember'] != '') {
                            $_SESSION['enter'];
                            echo "div class='card-body'>
                            <form action='store.php' method='post'>
                                

                                <div class='form-group'>

                                    <label for = 'exampleFormControlTextarea1'>

                                        Сообщение</label>
                                    <textarea name='comment' class='form-control' id='exampleFormControlTextarea1' rows='3'></textarea>
                                      $_SESSION[comment]
                                    unset($_SESSION[comment])
                                </div>

                                <button type='submit' name='done' class='btn btn-success'>Отправить</button>
                            </form>
                        </div>";
                        } else {
                            echo "<div class='alert alert-primary' role='alert'>
                            Что бы оставить комментарий <a href='login.php'>авторизуйтесь</a>
                          </div>";
                        }
                        
                        ?>


                        

                            <!-- ---------------------------------------- блок комментария -->

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>