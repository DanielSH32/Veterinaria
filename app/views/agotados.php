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
            <!-- Listado de productos -->
            <div id="contentList" class="mt-3">
                <h4>
                    <img src="<?php echo URL?>public_html/images/out-of-stock.png" alt="" style="width:40px;">
                    Productos Agotados
                    <button class="btn btn-outline-dark float-end" id="btnPDF">
                        <i class="bi bi-plus-square-fill"></i>
                        Generar PDF
                    </button>
                </h4>
                <hr>
                <!-- Tabla -->
                <div id="contentTable">
                    <table class="table table-striped">
                        <thead >
                            <th>Corr</th>
                            <th>Descripcion</th>
                            <th>Precio unitario</th>
                            <th>Cantidad</th>
                            <th>Tipo</th>
                            <th>Proveedor</th>
                        </thead>
                        <tbody>
                            <td>1</td>
                            <td>Administrador</td>
                            <td>Administrador</td>
                            <td>admin</td>
                            <td>Administrador</td>
                            <td>Administrador</td>
                        </tbody>
                    </table>
                </div>
                <!-- Paginación -->
                <div class="row">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination float-end">
                            <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Finaliza Listado de productos -->
            <!-- Inicia formulario de reporte-->
            <div id="contentForm" class="d-none mt-3">
                <h4>
                    <img src="<?php echo URL?>public_html/images/out-of-stock.png" alt="" style="width:40px;">
                    Productos Agotados
                </h4>
                <hr>
                <form id="formProducto" enctype="multipart/form-data">
                    <section>
                        <br>
                        <br>
                        <iframe src="" frameborder="0" width="100%" height="600" id="framereporte"></iframe>
                    </section>
                </form>
            </div>
            <!-- Finaliza formulario de reporte-->
        </section>
        <!--Todos los elementos que van al final de el sitio-->
        <section id="pie">
            <?php include_once "app/views/secciones/pie.php";?>
        </section>
    </div>
    <?php include_once "app/views/secciones/scripts.php";?>
    <script src="<?php echo URL?>public_html/customjs/agotados.js">
    </script>
</body>
</html>