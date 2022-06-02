
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-2">

    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo URL?>dashboard">La Mascota</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">           
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Mantenimiento
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?php echo URL?>usuarios">Usuarios</a></li>
                        <li><a class="dropdown-item" href="<?php echo URL?>clientes">Clientes</a></li>
                        <li><a class="dropdown-item" href="<?php echo URL?>categorias">Categorias</a></li>
                        <li><a class="dropdown-item" href="<?php echo URL?>proveedores">Proveedores</a></li>
                        <li><a class="dropdown-item" href="<?php echo URL?>productos">Productos</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Transacciones
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?php echo URL?>facturas">Nueva venta</a></li>
                        <li><a class="dropdown-item" href="<?php echo URL?>compras">Compras</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Alert
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?php echo URL?>vencidos">Productos Vencidos</a></li>
                        <li><a class="dropdown-item" href="<?php echo URL?>agotados">Productos Agotados</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Informes
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?php echo URL?>reporteproductos">Productos</a></li>
                        <li><a class="dropdown-item" href="<?php echo URL?>reportecompras">Compras</a></li>
                        <li><a class="dropdown-item" href="<?php echo URL?>reporteventas">Ventas</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo URL;?>login/cerrar">Cerrar sesion</a>
                </li>
            </ul>
            <img class="text-end" src="<?php echo URL?>public_html/images/usuarios.png" alt="" style="width:40px;">
            <span style="color: white;"><?php echo $_SESSION["nuser"];?></span>
        </div>
    </div>
</nav>