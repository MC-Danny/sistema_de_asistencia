<?php
if(!empty($_POST['btnentrada'])){

    if(!empty($_POST['txtdni'])){

        $dni=$_POST['txtdni'];
//verificamos que exista el dni del empleado en la base de datos
        $consul="SELECT * FROM tblempleado where DNI=?";
        $entrada = $cn->prepare($consul);
        $entrada->execute([$dni]);
        $existe = $entrada->fetch();
    
        if($existe==true){
            date_default_timezone_set('America/Lima'); 
            $fechaentrada=date("Y-m-d H:i:s");
//verificamos que no se haya registrado la asistencia del empleado
            $busfecha="SELECT ENTRADA FROM tblasistencia WHERE DNI=? ORDER BY COD_ASIS DESC LIMIT 1";
            $entra = $cn->prepare($busfecha);
            $entra->execute([$dni]);
            $solounaentrada = $entra->fetchColumn();
//si se ecuentra la entrada del empleado con la fecha actual nos muestra una notificacion
            if(substr($fechaentrada,0,10)==substr($solounaentrada,0,10)){ ?>
                <script>
                    $(function notificacio(){
                        new PNotify({
                            title: "INCORRECTO !!!",
                            type: "error",
                            text: "YA REGISTRASTE TU ENTRADA !!!",
                            styling: "bootstrap3" 
                        })
                    })
                </script>
            <?php 
//si no se encuentra la entrada con fecha actual se rigistra la asistencia
            }else{
                $entrada="INSERT INTO tblasistencia (DNI,ENTRADA) VALUES ( ?, ?)";
                $stmt_insert = $cn->prepare($entrada);
                $resultado = $stmt_insert->execute([$dni,$fechaentrada]);
                if($resultado==true){ ?>
                    <script>
                        $(function notificacio(){
                            new PNotify({
                                title: "CORRECTO",
                                type: "success",
                                text: "Se ha registrado correctamente",
                                styling: "bootstrap3" 
                            })
                        })
                    </script>
                <?php }
                else{ ?>
                    <script>
                        $(function notificacio(){
                            new PNotify({
                                title: "ERROR !!!",
                                type: "error",
                                text: "Ups. ocurrio un error",
                                styling: "bootstrap3" 
                            })
                        })
                    </script>
                <?php        
                }
            }
        } 
        else { ?>
            <script>
                $(function notificacio(){
                    new PNotify({
                        title: "NO EXISTE!!",
                        type: "error",
                        text: "El DNI no existe, intente nuevamente",
                        styling: "bootstrap3" 
                    })
                })
            </script>
        <?php }
    }
    else { ?>
        <script>
            $(function notificacio(){
                new PNotify({
                    title: "INCORRECTO",
                    type: "error",
                    text: "Ingrese su DNI",
                    styling: "bootstrap3" 
                })
            })
        </script>
    <?php } 
// en el siguiente script evitamos duplicidades de registro 
    ?>

        <script>
            setTimeout(() => {
                window.history.replaceState(null,null, window.location.pathname);
            }, 0);
        </script>    
<?php }

?>