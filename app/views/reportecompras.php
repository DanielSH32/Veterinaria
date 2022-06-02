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
                <img src="<?php echo URL?>public_html/images/cuenta.png" alt="" style="width:40px;">
                Reporte de compras
            </h2>
            <form class="row gy-2 gx-3 align-items-center mt-5 mb-5">
                <div class="col-auto d-flex">
                    <label for="fecha">Fecha Inicio: </label>
                    <input type="date" id="fecha" name="fecha">

                    </select>
                </div>
                <div class="col-auto d-flex">
                    <label for="fecha2">Fecha fin: </label>
                    <input type="date" id="fecha2" name="fecha2">

                    </select>
                </div>
                <div class="col-auto d-flex">
                    <label for="id_proveedor">Proveedor: </label>
                    <select name="id_proveedor" id="id_proveedor" class="form-select" value=0>

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
    <script src="<?php echo URL?>public_html/customjs/reportecompras.js">
    </script>
</body>
</html>