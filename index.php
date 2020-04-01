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
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Comments</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
</head>
<!--<?php $comments = [
    ['user_image' => 'img/no-user.jpg',
     'user_id' => '1',
     'user_name' => 'John Doe',
     'date_comment' => '2019-08-22',
     'user_comment' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe aspernatur, ullam doloremque deleniti, sequi obcaecati.'],
    ['user_image' => 'img/no-user.jpg',
     'user_id' => '2',
     'user_name' => 'Joseph Doe',
     'date_comment' => '2019-08-23',
     'user_comment' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe aspernatur, ullam doloremque deleniti, sequi obcaecati.'],
    ['user_image' => 'img/no-user.jpg',
     'user_id' => '3',
     'user_name' => 'Jane Doe',
     'date_comment' => '2019-08-24',
     'user_comment' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe aspernatur, ullam doloremque deleniti, sequi obcaecati.'],
    ['user_image' => 'img/no-user.jpg',
     'user_id' => '4',
     'user_name' => 'Lemmy',
     'date_comment' => '2019-08-25',
     'user_comment' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe aspernatur, ullam doloremque deleniti, sequi obcaecati.'],
];
?>-->
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    Project
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="login.html">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.html">Register</a>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><h3>Комментарии</h3></div>

                            <div class="card-body">
                              <!-- задание флеш уведомление -->
                                <?php echo $_SESSION['push'];
                                unset($_SESSION['push']); ?>
                                
                              
                                <?php foreach ($massage as $comment): ?>
                                <div class="media">
                                 <img src="<?php echo $comment['user_image']; ?>" class="mr-3" alt="..." width="64" height="64">
                                  <div class="media-body">
                                   <h5 class="mt-0"><?php echo $comment['name']; ?></h5> 
                                    <span><small><?php echo $comment['data']; ?></small></span>
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
                            <div class="card-header"><h3>Оставить комментарий</h3></div>

                            <div class="card-body">
                                <form action="store.php" method="post">
                                    <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Имя</label>
                                    <input name="name" class="form-control" id="exampleFormControlTextarea1" />
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Сообщение</label>
                                    <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                  </div>
                                  <button type="submit" class="btn btn-success">Отправить</button>
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
