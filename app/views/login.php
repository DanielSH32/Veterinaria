<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>veterinaria</title>
    <link rel="stylesheet" href="<?php echo URL?>public_html/css/bootstrap.min.css">
</head>
<body background= "/veterinaria/public_html/images/background1.png" style="background-size: cover;">
    <div class="container d-flex">
        <div class="card col-md-6 col-sm-12 mx-auto position-absolute top-50 start-50 translate-middle">
            <div class="card-header">
                <h3 class="text-center">Inicio de sesión</h3>
            </div>
            <div class="card-body">
                <form action="login.php" id="formlogin" method="post">
                    <div class="form-floating mt-4">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Usuario" name="usuario">
                        <label for="floatingInput">Usuario</label>
                    </div>
                    <div class="form-floating mt-5">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="alert alert-danger d-none mt-3" role="alert" id="mensaje">
                      Mensaje
                    </div>
                    <div class="d-grid gap-2 mt-5">
                        <button class="btn btn-success" type="submit">Iniciar sesión</button>
                    </div>
                    <p class="text-muted mt-5 text-center">
                        LA MASCOTA&copy; 2021
                    </p>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo URL?>public_html/customjs/api.js"></script>
    <script src="<?php echo URL?>public_html/customjs/login.js"></script>
</body>
</html>