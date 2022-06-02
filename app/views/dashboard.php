<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinaria</title>
    <?php include_once "app/views/secciones/css.php";?>
</head>
<body class="pt-4">
    <div class="container">
        <!--Todos los elementos del encabezado-->
        <section id="encabezado">
            <?php include_once "app/views/secciones/encabezado.php";?>
        </section>
        <!--Opciones de menu-->
        <section id="menu">
            <?php include_once "app/views/secciones/menu.php";?>
        </section>
        <!--Todos los elementos que varian-->
        <section id="contenido">
            <div id="carouselExampleIndicators" class="mt-3 carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="<?php echo URL?>public_html/images/slider1.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                    <img src="<?php echo URL?>public_html/images/slider2.jpeg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                    <img src="<?php echo URL?>public_html/images/slider3.png" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
        <div class="row mt-5">
            <div class="col-md-4">
                <img src="public_html/images/1.png" class="rounded float-start" alt="..." style="height: 300px; width: 300px;">
            </div>
            <div class="col-md-4">
                <img src="public_html/images/2.png" class="rounded mx-auto d-block" alt="..." style="height: 300px; width: 300px;">
            </div>
            <div class="col-md-4">
            <img src="public_html/images/3.png" class="rounded float-end" alt="..." style="height: 300px; width: 300px;">
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-4">
                <img src="public_html/images/4.png" class="rounded float-start" alt="..." style="height: 300px; width: 300px;">
            </div>
            <div class="col-md-4">
                <img src="public_html/images/5.png" class="rounded mx-auto d-block" alt="..." style="height: 300px; width: 300px;">
            </div>
            <div class="col-md-4">
            <img src="public_html/images/6.png" class="rounded float-end" alt="..." style="height: 300px; width: 300px;">
            </div>
        </div>
        
        <!--Todos los elementos que van al final de el sitio-->
        <section id="pie">
            <?php include_once "app/views/secciones/pie.php";?>
        </section>
    </div>
    <?php include_once "app/views/secciones/scripts.php";?>
</body>
</html>