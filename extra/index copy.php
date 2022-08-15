<!DOCTYPE html>
<html lang="en">

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
    include 'db_connection.php';

    $conn = openCon();

    echo "Conexion correcta";

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
                        $query = $conn->query("SELECT * FROM tusuario");
                        while ($valores = mysqli_fetch_array($query)) {
                            echo '<option value="' . $valores['idUsuario'] . '">' . $valores['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <br><br>
                    <select id="select2" name="select2" class="form-select">
                        <option value="0">Selecciona un Menu</option>
                        <?php
                        $query2 = $conn->query("SELECT * FROM tmenu");
                        while ($valores2 = mysqli_fetch_array($query2)) {
                            echo '<option value="' . $valores2['idMenu'] . '">' . $valores2['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <div id="menu1" name="menu">
                        <div class="form-check">
                            <br><br>
                            <input class="form-check-input" type="checkbox" value="2" id="">
                            <label class="form-check-label" for="defaultCheck1">Entrada de facturas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="4" id="">
                            <label class="form-check-label" for="defaultCheck1">Mantenimiento efectos a pagar
                                periodicos</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="5" id="">
                            <label class="form-check-label" for="defaultCheck1">Seleccion de efectos a pagar
                                periodicos</label>
                        </div>
                        <br><br>
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-outline-primary" value="Guardar">Guardar</button>
                            <button type="button" class="btn btn-outline-success" value="Agregar">Agregar</button>
                            <button type="button" class="btn btn-outline-danger" value="Eliminar">Eliminar</button>
                            <button type="button" class="btn btn-outline-warning" value="Cancelar">Cancelar</button>
                        </div>
                    </div>
                    <div id="menu2" name="menu">
                        <br><br>
                        Haz selecionado el menu <strong>"2"</strong>.
                    </div>
                    <div id="menu3" name="menu">
                        <br><br>
                        Haz seleccionado el menu <strong>"3"</strong>.
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    closeCon($conn);
    ?>

</body>

<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script>
    $(document).ready(function() {

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
    });
</script>

</html>