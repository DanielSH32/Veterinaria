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
            <!-- Listado de usuarios -->
            <div id="contentList" class="mt-3">
                <h4>
                    <img src="<?php echo URL?>public_html/images/caja.png" alt="" style="width:40px;">
                    <!--<i class="bi bi-person-fill"></i> -->
                    Productos
                </h4>
                <hr>
                <!-- Cuadro de texto de busqueda -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <input type="search" class="form-control" aria-describedby="basic-addon2" id="txtSearch">
                            <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-6">
                        <label for="id_cliente" class="col-sm-2 col-form-label">Cliente:</label>
                        <div class="col-sm-3">
                        <select class="form-select" id="id_cliente" name="id_cliente">
                            <option value="Cliente">Cliente</option>
                        </select>
                        </div>
                    </div>
                <!-- Tabla -->
                <div id="contentTable">
                    <table class="table table-striped">
                        <thead >
                            <th>No.</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            <td>Administrador</td>
                            <td>Administrador</td>
                            <td><input type="number" class="form-control" id="cantidad" name="cantidad" required></td>
                            <td>
                                <button class="btn btn-outline-primary"><i class="bi bi-file-plus"></i></button>
                            </td>
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
        </section>
        <!-- Factura -->
        <div id="contentList" class="mt-3">
                <h4>
                    <img src="<?php echo URL?>public_html/images/cuenta.png" alt="" style="width:40px;">
                    <!--<i class="bi bi-person-fill"></i> -->
                    Factura
                </h4>
                <hr>
                <!-- Tabla -->
                <div id="contentTableFact">
                    <table class="table table-striped">
                        <thead >
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>
                            <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tbody>
                    </table>
                    <button class="btn btn-outline-dark float-end" id="btnImprimir">
                        <i class="bi bi-clipboard-check"></i>
                        Imprimir Factura
                    </button>
                </div>
        </div>
        <!--Todos los elementos que van al final de el sitio-->
        <section id="pie">
            <?php include_once "app/views/secciones/pie.php";?>
        </section>
    </div>
    <?php include_once "app/views/secciones/scripts.php";?>
    <script src="<?php echo URL?>public_html/customjs/facturas.js">
    </script>
</body>
</html>