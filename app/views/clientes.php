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
            <!-- Listado de clientes -->
            <div id="contentList" class="mt-3">
                <h4>
                    <img src="<?php echo URL?>public_html/images/consumidor.png" alt="" style="width:40px;">
                    Clientes
                    <button class="btn btn-outline-dark float-end" id="btnAgregar">
                        <i class="bi bi-plus-square-fill"></i>
                        Agregar Cliente
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
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DUI</th>
                            <th>Direccion</th>
                            <th>Email</th>
                            <th>Telefono</th>
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
            <!-- Finaliza Listado de clientes -->
            <!-- Inicia formulario de clientes-->
            <div id="contentForm" class="d-none mt-3">
                <h4>
                    <img src="<?php echo URL?>public_html/images/consumidor.png" alt="" style="width:40px;">
                    clientes
                </h4>
                <hr>
                <form id="formCliente" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="nombre" class="col-sm-2 col-form-label">Nombre:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                        <input type="hidden" name="id_cliente" id="id_cliente" value="0">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="apellido" class="col-sm-2 col-form-label">Apellido:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="dui" class="col-sm-2 col-form-label">DUI:</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="dui" name="dui" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="direccion" class="col-sm-2 col-form-label">Direccion:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="telefono" class="col-sm-2 col-form-label">Telefono:</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="telefono" name="telefono" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" id="btnCancelar"><i class="bi bi-x-octagon-fill"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-hdd-fill"></i> Guardar</button>
                </form>
            </div>
            <!-- Finaliza formulario de clientes-->
        </section>
        <!--Todos los elementos que van al final de el sitio-->
        <section id="pie">
            <?php include_once "app/views/secciones/pie.php";?>
        </section>
    </div>
    <?php include_once "app/views/secciones/scripts.php";?>
    <script src="<?php echo URL?>public_html/customjs/clientes.js">
    </script>
</body>
</html>