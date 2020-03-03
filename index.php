<?php
    $pdo = new PDO("mysql:host=localhost;dbname=test;", "root", "");
    $statement = $pdo->prepare("SELECT * FROM comments");
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
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
<?php 
/*$comments = [
           [ 'user_imege' => 'img/no-user.jpg',
            'user_id' => '1',
            'user_name' => 'John Doe',
            'user_data' => '25.02.2020',
            'user_comments' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe aspernatur, ullam doloremque deleniti, sequi obcaecati.'],

            ['user_imege' => 'img/no-user.jpg',
            'user_id' => '2',
            'user_name' => 'Ирина Шубина',
            'user_data' => '26.02.2020',
            'user_comments' => 'Воу Воу'],

            ['user_imege' => 'img/no-user.jpg',
            'user_id' => '3',
            'user_name' => 'Антон Шубин',
            'user_data' => '27.02.2020',
            'user_comments' => 'Ни чё се!'],

            ['user_imege' => 'img/no-user.jpg',
            'user_id' => '4',
            'user_name' => 'Jane',
            'user_data' => '28.02.2020',
            'user_comments' => 'fack!!!'],

            ['user_imege' => 'img/no-user.jpg',
            'user_id' => '5',
            'user_name' => 'Bill',
            'user_data' => '28.02.2020',
            'user_comments' => 'O my God']
        ];*/
?>
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
                              <div class="alert alert-success" role="alert">
                                Комментарий успешно добавлен
                              </div>
                                <?php foreach ($comments as $comment): ?>
                                <div class="media">
                                   <img src="<?php echo $comment['user_imege']; ?>" class="mr-3" alt="..." width="64" height="64">
                                  <div class="media-body">
                                    <h5 class="mt-0"><?php echo $comment['name'] ?></h5> 
                                    <span><small><?php echo $comment ['data']; ?></small></span>
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
                            <form name="comment" action="store.php" method="post">
                                <p>
                                 <label>Имя:</label>
                                <input type="text" name="name" />
                                </p>
                                 <p>
                                 <label>Комментарий:</label>
                                  <br />
                                  <textarea name="comment" cols="30" rows="5"></textarea>
                                     </p>
                                     <p>
                                    <input type="hidden" name="id" value="id" />
                                 <input type="submit" value="Отправить" />
                                         </p>
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
