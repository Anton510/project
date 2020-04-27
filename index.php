<?php
session_start();


$pdo = new PDO("mysql:host=localhost;dbname=test;", "root", "");
// задание сортировки
$statement = $pdo->prepare("SELECT * FROM comments ORDER BY id DESC");
$statement->execute();
$massage = $statement->fetchAll(PDO::FETCH_ASSOC);






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
<!--<?php $comments = [
        [
            'user_image' => 'img/no-user.jpg',
            'user_id' => '1',
            'user_name' => 'John Doe',
            'date_comment' => '2019-08-22',
            'user_comment' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe aspernatur, ullam doloremque deleniti, sequi obcaecati.'
        ],
        [
            'user_image' => 'img/no-user.jpg',
            'user_id' => '2',
            'user_name' => 'Joseph Doe',
            'date_comment' => '2019-08-23',
            'user_comment' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe aspernatur, ullam doloremque deleniti, sequi obcaecati.'
        ],
        [
            'user_image' => 'img/no-user.jpg',
            'user_id' => '3',
            'user_name' => 'Jane Doe',
            'date_comment' => '2019-08-24',
            'user_comment' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe aspernatur, ullam doloremque deleniti, sequi obcaecati.'
        ],
        [
            'user_image' => 'img/no-user.jpg',
            'user_id' => '4',
            'user_name' => 'Lemmy',
            'date_comment' => '2019-08-25',
            'user_comment' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe aspernatur, ullam doloremque deleniti, sequi obcaecati.'
        ],
    ];
    ?>-->

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
                "<div class='collapse navbar-collapse' id='navbarSupportedContent'>
                    <!-- Left Side Of Navbar -->
                    <ul class='navbar-nav mr-auto'>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class='navbar-nav ml-auto'>

                        <!-- типо показывает при авторизации-->
                      

                        <?php
                        if ($_COOKIE['remember'] != '') {
                            $_SESSION['enter'];
                            echo "<div class='dropdown'>
                            <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            {$_SESSION['email_reg']} 
                            </button>
                            <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                              <a class='dropdown-item' href='profile.php'>Профиль</a>
                              <a class='dropdown-item' href='exit.php'>Выход</a>
                            </div>
                          </div>";
                        } else {

                            echo "<li class='nav-item'>
                       <a class='nav-link' href='login.php'>Login</a>
                   </li>
                   <li class='nav-item'>
                       <a class='nav-link' href='register.php'>Register</a>
                   </li> ";
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


                                <?php foreach ($massage as $comment) : ?>
                                    <div class="media">
                                        <img src="<?php echo $comment['user_image']; ?>" class="mr-3" alt="..." width="64" height="64">
                                        <div class="media-body">
                                            <h5 class="mt-0"><?php echo $comment['name']; ?></h5>
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
                            <div class="card-body">
                                <form action="store.php" method="post">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Имя</label>
                                        <input name="name" class="form-control" id="exampleFormControlTextarea1" />
                                        <?php echo $_SESSION["name"];
                                        unset($_SESSION['name']); ?>
                                    </div>

                                    <div class="form-group">

                                        <label for="exampleFormControlTextarea1">

                                            Сообщение</label>
                                        <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        <?php echo $_SESSION["comment"];
                                        unset($_SESSION['comment']); ?>
                                    </div>

                                    <button type="submit" name="done" class="btn btn-success">Отправить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>