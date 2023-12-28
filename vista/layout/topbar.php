
<!doctype html>
<html lang="es">

<head>

    <head lang="es">
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, user-scalable=no" name="viewport">
        <meta content="ie=edge" http-equiv="x-ua-compatible">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Anton&family=Libre+Baskerville:ital@1&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Libre+Baskerville:ital@1&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../public/estilos/style.css">
        <title>MC - DANNY.of</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="sweetalert2.min.css">

        <link href="https://tresplazas.com/web/img/big_punto_de_venta.png" rel="shortcut icon">
        <link href="../public/app/publico/css/lib/font-awesome/font-awesome.min.css" rel="stylesheet">
        <link href="../public/bootstrap5/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

        <link rel="stylesheet" href="../public/app/publico/css/lib/lobipanel/lobipanel.min.css">
        <link rel="stylesheet" href="../public/app/publico/css/separate/vendor/lobipanel.min.css">
        <link rel="stylesheet" href="../public/app/publico/css/lib/jqueryui/jquery-ui.min.css">
        <link rel="stylesheet" href="../public/app/publico/css/separate/pages/widgets.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Alfa+Slab+One&family=Anton&family=Concert+One&family=Libre+Baskerville:ital@1&family=Neuton:ital,wght@0,300;0,700;1,400&family=PT+Sans:ital,wght@0,700;1,400;1,700&family=Patua+One&family=Russo+One&display=swap" rel="stylesheet">

        <!-- font awesome -->
        <link rel="stylesheet" href="../public/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="../public/fontawesome/css/fontawesome.min.css">

        <!-- datatables -->
        <link rel="stylesheet" href="../public/app/publico/css/lib/datatables-net/datatables.min.css">
        <link rel="stylesheet" href="../public/app/publico/css/separate/vendor/datatables-net.min.css">

        <link href="../public/app/publico/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
        <link href="../public/app/publico/css/main.css" rel="stylesheet">
        <link href="../public/app/publico/css/mis_estilos/estilos.css" rel="stylesheet">

        <!-- form -->
        <link rel="stylesheet" type="text/css" href="../public/app/publico/css/lib/jquery-flex-label/jquery.flex.label.css"> <!-- Original -->

        <!-- mis estilos -->
        <link href="../public/principal/css/estilos.css" rel="stylesheet">

        <!-- pNotify -->
        <link href="../public/pnotify/css/pnotify.css" rel="stylesheet" />
        <link href="../public/pnotify/css/pnotify.buttons.css" rel="stylesheet" />
        <link href="../public/pnotify/css/custom.min.css" rel="stylesheet" />

        <!-- google fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

        <!-- pnotify -->
        <script src="../public/pnotify/js/jquery.min.js">
        </script>
        <script src="../public/pnotify/js/pnotify.js">
        </script>
        <script src="../public/pnotify/js/pnotify.buttons.js">
        </script>

        <!-- alpine js -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

        <!-- chart js -->
        <script src="../public/chart/chart.js"></script>

        <style>
            .marca {
                width: 100%;
                background: rgb(13, 39, 48);
                position: fixed;
                bottom: 0;
                z-index: 999;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 10px;
            }

            .marca__parrafo {
                margin: 0 !important;
                color: white;
            }

            .marca__texto {
                color: rgb(0, 162, 255);
                text-decoration: underline;
            }

            .marca__parrafo span {
                color: red;
            }

            .page-content {
                margin-top: 70px;
            }

            @media screen and (max-width:1056px) {
                .page-content {
                    padding: 15px !important;
                }
            }
        </style>

    </head>
</head>

<body class="with-side-menu">
    <div id="app">

        <header class="site-header">
            <div class="container-fluid" style="padding-left: 40px;">

                <a href="#" class="site-logo">

                </a>

                <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
                    <span>toggle menu</span>
                </button>

                <button class="hamburger hamburger--htla">
                    <span>toggle menu</span>
                </button>
                <div class="site-header-content">
                    <div class="site-header-content-in">
                        <div class="site-header-shown">

                            <div class="dropdown dropdown-notification">
                                <h6 class="text-light mt-2">
                                    Administrador
                                </h6>
                            </div>

                            <div class="dropdown user-menu">
                                <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="../public/app/publico/img/user.svg" alt="">
                                </button>
                                <div class="dropdown-menu dropdown-menu-right pt-0" aria-labelledby="dd-user-menu">

                                    <h5 class="p-2 text-center bg-primary"><?= $_SESSION["nombre"]." ".$_SESSION['apellido'] ?></h5>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal5" href=""><span class="font-icon glyphicon glyphicon-user"></span>Perfil</a>
                                    <a class="dropdown-item"data-toggle="modal" data-target="#staticBackdrop2" href=""><span class="font-icon glyphicon glyphicon-lock"></span>Cambiar contraseña</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../cerrar.php">
                                        <span class="font-icon glyphicon glyphicon-log-out"></span>salir
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--.site-header-shown-->

                        <div class="mobile-menu-right-overlay"></div>
                        <div class="site-header-collapsed">

                        </div>
                        <!--.site-header-collapsed-->
                    </div>
                    <!--site-header-content-in-->
                </div>
                <!--.site-header-content-->
            </div>
            <!--.container-fluid-->
        </header>



<!-- Modal -->
                    <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center flex-grow-1" id="exampleModalLabel">PERFIL DE USUARIO</h5>
                                <a href=""class="btn btn-success btn-rounded" style="position: absolute; right: 20px;"  data-toggle="modal" data-target="#staticBackdrop6"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h1>  USUARIO:   <?= $_SESSION["name"]?></h1>
                                <h1>  NOMBRES:   <?= $_SESSION["nombre"]?></h1>
                                <h1>APELLIDOS:  <?= $_SESSION["apellido"]?></h1> 
                                <h1>   ESTADO:  <?= $_SESSION["estado"]?></h1>                                 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Cerrar</button>
                            </div>
                            </div>
                        </div>
                    </div>

                <div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title text-center flex-grow-1" id="staticBackdropLabel">CAMBIAR CONTRASEÑA</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px;">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form  action="../validate/cambiar_clave.php" method="POST" novalidate>
                            <div class="modal-body"> 
                            <div hidden class="col-md-5">
                            <label for="validationCustom01" class="form-label">ID</label>
                            <input hidden type="text" class="form-control" value="<?= $_SESSION["id"]?>" name="codigo"   >
                            </div>
                            <div class="col-md-12">
                            <label for="validationCustom02" class="form-label">CONTRASEÑA ACTUAL</label>
                            <input type="password" class="form-control" name="contraactual" >
                            </div>
                            <div class="col-md-12"><br>
                            <label for="validationCustom01" class="form-label">CONTRASEÑA NUEVA</label>
                            <input type="password" class="form-control" name="contranueva"  >
                            </div>
                            <div class="col-md-12"><br>
                            <label for="validationCustom02" class="form-label">REPETIR CONTRASEÑA NUEVA</label>
                            <input type="password" class="form-control "name="repetircontra"  ><br>
                            </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Volver</button>
                                <button type="submit"name="btnactualizar" class="btn btn-primary btn-rounded">Actualizar</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <?php
if(isset($_SESSION['cambiar'])){
  $res=$_SESSION['cambiar'];?>
  <script>
      Swal.fire({
        position: "top-end",
        icon: "success",
        title: "CORRECTO...",
        text: "La contraseña se cambió correctamente",
        showConfirmButton: false,
        timer: 2500
      });
  </script>
<?php
  unset($_SESSION['cambiar']);
}
?>
<?php
    if(isset($_SESSION['error'])){
    $res=$_SESSION['error'];?>
    <script>
        Swal.fire({
            position: "top-end",
            icon: "info",
            title: "Ups ...",
            text: "Contraseña nueva diferente en los campos ",
            showConfirmButton: false,
            timer: 2500
        });
    </script>
    <?php
    unset($_SESSION['error']);
    }
    ?>
    <?php
    if(isset($_SESSION['no'])){
    $res=$_SESSION['no'];?>
    <script>
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "INCORRECTO...",
            text: "Ups, Contraseña actual incorrecto",
            showConfirmButton: false,
            timer: 2500
        });
    </script>
    <?php
    unset($_SESSION['no']);
    }
    ?>
    <?php
    if(isset($_SESSION['vacio'])){
    $res=$_SESSION['vacio'];?>
    <script>
        Swal.fire({
            position: "top-end",
            icon: "info",
            title: "VACIO ...",
            text: "Ups, complete todos los campos",
            showConfirmButton: false,
            timer: 2500
        });
    </script>
    <?php
    unset($_SESSION['vacio']);
    }
    ?>
    <?php
    if(isset($_SESSION['nose'])){
    $res=$_SESSION['nose'];?>
    <script>
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Ups; ERROR...",
            text: "Ups, Ocurrio un error",
            showConfirmButton: false,
            timer: 2500
        });
    </script>
    <?php
    unset($_SESSION['nose']);
    }
?>
            
            <div class="modal fade" id="staticBackdrop6" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header ">
                      <h5 class="modal-title text-center flex-grow-1" id="staticBackdropLabel">ACTUALIZAR DATOS</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px;">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form class="row g-3 needs-validation"action="../validate/actualizar_usuario.php" method="POST" novalidate>
                    <div class="modal-body">
                      <div hidden class="col-md-2"><br>
                        <label for="validationCustom01" class="form-label">ID</label>
                        <input type="text" class="form-control" name="codigo"  value="<?= $_SESSION["id"]?>" >
                      </div> 
                      <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">USUARIO</label>
                        <input type="text" class="form-control" name="usuario"  value="<?= $_SESSION["name"]?>" >
                      </div>
                      <div class="col-md-5">
                        <label for="validationCustom01" class="form-label">ESTADO</label>
                        <input type="text" class="form-control" name="estado"  value="<?= $_SESSION["estado"]?>" readonly >
                      </div>
                      <div class="col-md-6"><br>
                        <label for="validationCustom01" class="form-label">NOMBRES</label>
                        <input type="text" class="form-control" name="nombre" value="<?= $_SESSION["nombre"]?>" >
                      </div>
                      <div class="col-md-6"><br>
                        <label for="validationCustom02" class="form-label">APELLIDOS</label>
                        <input type="text" class="form-control"name="apellido" value="<?= $_SESSION["apellido"]?>" >
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Volver</button>
                      <button type="submit" class="btn btn-primary btn-rounded">Actualizar</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>


        

        <div class="mobile-menu-left-overlay">
        </div>