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
            <!-- Listado de autores -->
            <div id="contentList" class="mt-3">
                <h4>
                    <img src="<?php echo URL?>public_html/images/repartidor.png" alt="" style="width:40px;">
                    Proveedores
                    <button class="btn btn-outline-dark float-end" id="btnAgregar">
                        <i class="bi bi-plus-square-fill"></i>
                        Agregar Proveedor
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
                            <th>Proveedor</th>
                            <th>contacto</th>
                            <th>telefono</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            <td>1</td>
                            <td>Administrador</td>
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
            <!-- Finaliza Listado de autores -->
            <!-- Inicia formulario de autores-->
            <div id="contentForm" class="d-none mt-3">
                <h4>
                    <img src="<?php echo URL?>public_html/images/repartidor.png" alt="" style="width:40px;">
                    Proveedores
                </h4>
                <hr>
                <form id="formProveedor">
                    <div class="row mb-3">
                        <label for="proveedor" class="col-sm-2 col-form-label">Proveedor:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="proveedor" name="proveedor" required>
                        <input type="hidden" name="id_proveedor" id="id_proveedor" value="0">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="contacto" class="col-sm-2 col-form-label">Contacto:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="contacto" name="contacto" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="telefono" class="col-sm-2 col-form-label">Telefono:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" id="btnCancelar"><i class="bi bi-x-octagon-fill"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-hdd-fill"></i> Guardar</button>
                </form>
            </div>
            <!-- Finaliza formulario de autores-->
        </section>
        <!--Todos los elementos que van al final de el sitio-->
        <section id="pie">
            <?php include_once "app/views/secciones/pie.php";?>
        </section>
    </div>
    <?php include_once "app/views/secciones/scripts.php";?>
    <script src="<?php echo URL?>public_html/customjs/proveedores.js">
    </script>
</body>
</html>