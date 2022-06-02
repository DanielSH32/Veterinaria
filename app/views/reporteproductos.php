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
        <section>
            <br>
            <br>
            <h2>
                <img src="<?php echo URL?>public_html/images/reporte.png" alt="" style="width:40px;">
                Reporte de productos
            </h2>
            <form class="row gy-2 gx-3 align-items-center mt-5 mb-5">
                <div class="col-auto d-flex">
                    <label for="id_proveedor">Proveedor: </label>
                    <select name="id_proveedor" id="id_proveedor" class="form-select">

                    </select>
                </div>
                <div class="col-auto d-flex">
                    <label for="id_categoria">Categoria: </label>
                    <select name="id_categoria" id="id_categoria" class="form-select">

                    </select>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-outline-success" id="btnViewReport">Ver Reporte</button>
                </div>
            </form>
            <iframe src="" frameborder="0" width="100%" height="500" id="framereporte"></iframe>
        </section>
        
        <!--Todos los elementos que van al final de el sitio-->
        <section id="pie">
            <?php include_once "app/views/secciones/pie.php";?>
        </section>
    </div>
    <?php include_once "app/views/secciones/scripts.php";?>
    <script src="<?php echo URL?>public_html/customjs/reporteproductos.js">
    </script>
</body>
</html>