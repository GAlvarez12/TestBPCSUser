<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="icon" href="assets/iconfull.ico">
    <title>Control de usuarios BPCS</title>
</head>

<body>
    <?php
    //SE INCLUYE EL ARCHIVO DE LA CONEXION 
    include 'db_connection.php';

    //SE ABRE LA CONEXION Y SE DEJA GUARDADA PARA LAS CONSULTAS DENTRO DEL PROGRAMA 
    $conn = openCon();

    echo '
        <div class="alert alert-success" role="alert">
            Conexión correcta
        </div>
    ';

    //closeCon($conn);
    ?>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/logo.png" alt="Logotipo bellota" height="36">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Enlace </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menú despegable
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Accion 1 </a></li>
                            <li><a class="dropdown-item" href="#">Accion 2 </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Otra opcion dividida </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="d-flex flex-column min-vh-100 min-vw-100">
        <div class="d-flex flex-grow-1 justify-content-center align-items-center">
            <div class="border border-primary rounded-5 border-5">
                <form action="" method="post" class="m-10">
                    <select id="select1" name="select1" class="form-select">
                        <option value="0">Selecciona un usuario</option>
                        <?php
                        //CONSULTANDO LISTA DE USUARIOS
                        $query = $conn->query("SELECT * FROM tusuario");
                        //POR CADA REGISTRO ENCONTRADO SE VA A MOSTRAR UNA OPCION DEL SELECT
                        while ($valores = mysqli_fetch_array($query)) {
                            echo '<option value="' . $valores['idUsuario'] . '">' . $valores['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <br><br>
                    <select id="select2" name="select2" class="form-select">
                        <option value="0">Selecciona un Menu</option>
                        <?php
                        //CONSULTANDO LOS MENUS DISPONIBLES
                        $query2 = $conn->query("SELECT * FROM tmenu");
                        //POR CADA REGISTRO ENCONTRADO SE VA A MOSTRAR UNA OPCION DEL SELECT
                        while ($valores2 = mysqli_fetch_array($query2)) {
                            echo '<option value="' . $valores2['idMenu'] . '">' . $valores2['nombre'] . '</option>';
                        }
                        ?>
                    </select>

                    <?php
                    //CONSULTANDO NUEVAMENTE LOS MENUS DISPONIBLES
                    $queryExtra = $conn->query("SELECT * FROM tmenu");
                    //POR CADA MENU ENCONTRADO, SE VA A AÑADIR UN DIV CON EL IDENTIFICADOR DEL MENU
                    while ($valoresExtra = mysqli_fetch_array($queryExtra)) {
                        echo '<div id="menu' . $valoresExtra['idMenu'] . '" name="menu">';
                        //SE GUARDA EL ID DEL MENU DEL CICLO EN CURSO PARA USARLO EN LA SIGUIENTE COSULTA
                        $idmenu = $valoresExtra['idMenu'];
                        //DENTRO DEL CICLO EN CURSO SE HACE UNA CONSULTA PARA BUSCAR TODOS LOS PORGRAMAS QUE COINCIDAN CON EL MENU GUARDADO EN LA VAR ANTERIOR
                        $query3 = $conn->query("SELECT * FROM tprograma WHERE idMenu = $idmenu");
                        //DENTRO DEL CICLO EN CURSO SE HACE OTRO CICLO PARA IMPRIMIR TODOS LOS CHECKBOX QUE COINCIDAN CON EL ID DEL MENU
                        while ($valores3 = mysqli_fetch_array($query3)) {
                            echo '
                            <div class="form-check">
                            <br><br>
                                <input class="form-check-input" type="checkbox" value="' . $valores3['idPrograma'] . '" id="">
                                <label class="form-check-label" for="defaultCheck1">' . $valores3['nombre'] . ' (' . $valores3['codigo'] . ')</label>
                            </div>
                            ';
                        }
                        echo '</div>';
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary" id="btn_Agregar01">Agregar</button>
    <div id="cont_Menu01"></div>
    <?php
    //SE CIERRA LA CONEXION AL DEJAR DE EJECUTAR EL PROGRAMA
    closeCon($conn);
    ?>
</body>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script>
    //FUNCION QUE SE EJECUTA SIEMPRE QUE EL PROGRAMA CARGA
    $(document).ready(function() {

        //DEJANDO TODOS LOS SELECT EN VALOR 0 Y OCULTANDO LOS MENUS QUE NO SE DEBEN VER AL INICIO 
        //DE NO HACERLO, SE QUEDAN EN PANTALLA AUN RECARGANDO LA PAGINA
        $('#select1').val("0");
        $('#select2').val("0");
        $('div[name="menu"]').hide();
        $('#select2').hide();



        $('#select2').on('change', function() {
            var demovalue = $(this).val();
            $('div[name="menu"]').hide();
            $("#menu" + demovalue).show();
        });

        $("#select1").on('change', function() {
            var usuarioval = $(this).val();
            if (usuarioval != "0") {
                $('#select2').show();
            } else {
                $('#select2').hide();
                $('div[name="menu"]').hide();


            }

        })
        /*
        $("#botonEjem").on('click', function() {
            //alert("HOLA");
            var tabla = `<table class="table"><tr><td>Tabla prueba</td></tr></table><button type="button" class="btn btn-primary" id="botonEjem2">Agregar2</button>`;
            $("#tablaEjem").append(tabla);
        })

        $("#botonEjem2").on('click', function() {
            //alert("HOLA");
            $("#tablaEjem").empty();
        })
        */
    });

    /*
    document.getElementById('botonEjem').addEventListener("click", function() {
        var parrafo = document.createElement("p");
        parrafo.setAttribute("id", "P1");
        var contenido = document.createTextNode("Hola Mundo!");
        var contenedor = document.getElementById("tablaEjem");
        parrafo.appendChild(contenido);
        contenedor.appendChild(parrafo);
    });
    */

    document.getElementById('btn_Agregar01').addEventListener("click", function() {
        const el = document.createElement('div');
        el.setAttribute("id", "cont_Tabla01");
        el.innerHTML = `
                    <div class="final-block">Block One</div>
                    <div class="final-block">Block Two</div>
                    <div class="final-block">Block Three</div>
                    <div class="final-block">Block Four</div>
                    <button type="button" class="btn btn-primary" id="btn_Borrar01">Borrar</button>
                    <button type="button" class="btn btn-primary" id="btn_Agregar02">Agregar</button>
                    <div id="cont_Menu02"></div>
                    `;                    
        document.querySelector('#cont_Menu01').appendChild(el);
        document.getElementById('btn_Borrar01').addEventListener("click", function() {
            //var eliminado = document.getElementById("tablaEjem");
            var eliminado2 = document.getElementById("cont_Tabla01");
            eliminado2.parentNode.removeChild(eliminado2);
        });
        
    });    
</script>

</html>