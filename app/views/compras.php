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
            <!-- Listado de compras -->
            <div id="contentList" class="mt-3">
                <h4>
                    <img src="<?php echo URL?>public_html/images/metodo-de-pago.png" alt="" style="width:40px;">
                    Compras
                    <button class="btn btn-outline-dark float-end" id="btnAgregar">
                        <i class="bi bi-plus-square-fill"></i>
                        Agregar Compra
                    </button>
                </h4>
                <hr>
                <!-- Cuadrod de texto de busqueda -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <input type="search" class="form-control" aria-describedby="basic-addon2" id="txtSearch">
                            <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
                        </div>
                    </div>
                </div>
                <!-- Tabla -->
                <div id="contentTable">
                    <table class="table table-striped">
                        <thead >
                            <th>Corr</th>
                            <th>Factura</th>
                            <th>Descripcion</th>
                            <th>Precio unitario</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            <td>1</td>
                            <td>Administrador</td>
                            <td>Administrador</td>
                            <td>admin</td>
                            <td>Administrador</td>
                            <td>Administrador</td>
                            <td>
                                <button class="btn btn-outline-primary"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-outline-dangerr"><i class="bi bi-trash"></i></button>
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
            <!-- Finaliza Listado de compras -->
            <!-- Inicia formulario de compras-->
            <div id="contentForm" class="d-none mt-3">
                <h4>
                    <img src="<?php echo URL?>public_html/images/metodo-de-pago.png" alt="" style="width:40px;">
                    Compras
                </h4>
                <hr>
                <form id="formCompra" enctype="multipart/form-data">
                    <h5>Información de Factura</h5>
                    <br>
                    <div class="row mb-3">
                        <label for="no_fact" class="col-sm-2 col-form-label">Numero de Factura:</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="no_fact" name="no_fact" required>
                        <input type="hidden" name="id_fact" id="id_fact" value="0">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="total" class="col-sm-2 col-form-label">total Compra:</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="total" name="total" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="fecha" class="col-sm-2 col-form-label">Fecha: </label>
                        <div class="col-sm-10">
                        <input type="date" id="fecha" name="fecha">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_proveedor" class="col-sm-2 col-form-label">Proveedor:</label>
                        <div class="col-sm-10">
                        <select class="form-select" id="id_proveedor" name="id_proveedor">
                            <option value="proveedor">proveedor</option>
                        </select>
                        </div>
                    </div>
                    <!-- Foto -->
                    <div class="row mb-3">
                        <label for="foto" class="col-sm-2 col-form-label">Foto:</label>
                        <div class="col-sm-10">
                            <div class="img-thumbnail" id="divFoto" style="width:200px; height:200px;">
                            </div>
                            <span>
                                Haga click para selecionar la foto
                            </span>
                            <input type="file" name="foto" id="foto" class="d-none">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-hdd-fill"></i> Guardar</button>
                </form>
                <form id="formProducto" enctype="multipart/form-data">
                    <hr>
                    <h5>Informacion del Producto Facturado</h5>
                    <br>
                    <div class="row mb-3">
                        <label for="no_fact" class="col-sm-2 col-form-label">Numero de Factura:</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="no_fact" name="no_fact" required>
                        <input type="hidden" name="id_producto" id="id_producto" value="0">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="producto" class="col-sm-2 col-form-label">Producto:</label>
                        <div class="col-sm-10">
                        <select class="form-select" id="producto" name="producto">
                            <option value="producto">producto</option>
                        </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="cantidad" class="col-sm-2 col-form-label">Cantidad:</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="precio" class="col-sm-2 col-form-label">Precio:</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="precio" name="precio" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" id="btnCancelar"><i class="bi bi-x-octagon-fill"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-hdd-fill"></i> Guardar</button>
                </form>
            </div>
            <!-- Finaliza formulario de productos-->
        </section>
        <!--Todos los elementos que van al final de el sitio-->
        <section id="pie">
            <?php include_once "app/views/secciones/pie.php";?>
        </section>
    </div>
    <?php include_once "app/views/secciones/scripts.php";?>
    <script src="<?php echo URL?>public_html/customjs/compras.js">
    </script>
</body>
</html>