<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="image/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link href="css/grid.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <title>PokemonGoBack</title>
  </head>
  <body class="text-center">
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
        <h5 class="my-0 mr-md-auto font-weight-normal">PokemonGoBack</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="#">Link</a>
            <a class="p-2 text-dark" href="#">Link</a>

            <?php
            if(!isset($_SESSION)){
                session_start();
            }
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                echo '<a class="p-2 text-dark" href="#">' . $_SESSION['user_name'] . ' </a>';
                echo '<a class="btn btn-outline-primary" href="signout.php">Log out</a>';
            }else{
                header('Location: signin.php');
            }
            ?>
        </nav>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">Cards in Hands</div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 offset-md-1" style="background-color: honeydew">
                    <div class="row">
                        <div class="col-md-1 offset-md-1">Discard</div>
                        <div class="col-md-8">Active Cards</div>
                    </div>
                    <div class="row">
                        <div class="col-md-1 offset-md-1">Deck</div>
                    </div>
                    <div class="row">
                        <div class="col align-self-center">
                            <svg height="300" width="300">
                                <ellipse cx="150" cy="150" rx="150" ry="150"
                                         style="fill:lightslategray;stroke:purple;stroke-width:2" />
                            </svg>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1 offset-md-10">Deck</div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 offset-md-2">Active Cards</div>
                        <div class="col-md-1">Discard</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">Cards in Hands</div>
        </div>
    </div>
  </body>
</html>
