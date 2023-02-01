<?php
    session_start();

    if (isset($_SESSION['usuario'])) {
        $_SESSION['usuario'];
        $_SESSION['role'];
        $_SESSION['csrf'];
    }
    
    $error = [];
    $alert = null;
    if(isset($_GET['title'])){
        $error[]='-Title Empty  ';
        $message = '<strong>Error!</strong> Ocurrio un problema: ';
        $alert = 'warning';
    }
    if(isset($_GET['resume'])){
        $error[]='-Resume Empty  ';
        $message = '<strong>Error!</strong> Ocurrio un problema: ';
        $alert = 'warning';
    }
    if(isset($_GET['success'])){
        if($_GET['success'] == 'true'){
            $error   = null;
            $message = '<strong>Exito!</strong> Operacion completada.';
            $alert   = 'success';
        }
    }
    if(isset($_GET['login'])){
        $error[] = 'Usuario o Contraseña Incorrecta.';
        $message = '<strong>Ocurrio un problema!</strong>: ';
        $alert   = 'danger';
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=h, initial-scale=1.0">
    
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://kit.fontawesome.com/c8a04cc247.css" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c8a04cc247.js" crossorigin="anonymous"></script>

</head>
<body>
    <nav class="navbar navbar-dark bg-primary mb-5 text-">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">

                <i class="fa-brands fa-php fs-3"></i>
                CRUD PHP|CSS|HTML5
            </a>
            <span>
                <a class=" btn navbar-brand" href="/">Posts</a>
                <a class=" btn navbar-brand" href="/module/users/">Users</a>
                <?php if(isset($_SESSION['usuario'])){?>
                    <a class="btn navbar-brand" href="/logout.php">Logout</a>
                <?php } else { ?>
                    <button type="button" class="btn navbar-brand" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Login
                    </button>
                <?php }?>
                </span>

        </div>
    </nav>

    <div class="container text-center">
    <?php if(isset($_SESSION['usuario'])){?>
        <div class="alert alert-primary" role="alert">
            <h1>Welcome <strong class="text-uppercase"><?php echo $_SESSION['usuario']?></strong></h1>
        </div>
    <?php } else {?>
        <div class="alert alert-warning" role="alert">
            <h1><strong class="text-uppercase"> not logged </strong> admin='admin';password='1234'</h1>
        </div>
    <?php }?>
    <?php if($alert){?>
        <div class="alert alert-<?php echo $alert;?> alert-dismissible fade show  m-auto" role="alert">
            <?php echo $message; if($error){foreach($error as $error):  echo "<strong>" . $error . "</strong>"; endforeach;}?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php } ?>

    