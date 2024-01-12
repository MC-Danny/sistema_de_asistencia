<?php
if(!empty($_POST['btnsalida'])){

    if(!empty($_POST['txtdni'])){

        $dni=$_POST['txtdni'];
        $consul="SELECT * FROM tblempleado where DNI=?";
        $entrada = $cn->prepare($consul);
        $entrada->execute([$dni]);
        $existe = $entrada->fetch();
        if($existe==true){
            date_default_timezone_set('America/Lima'); 
            $fechasalida=date("Y-m-d H:i:s");
//buscamos en la base de datos segun su deni que se guardara en la ultima fecha de la entrada entrada 
            $busqueda="SELECT COD_ASIS FROM tblasistencia WHERE DNI=? ORDER BY COD_ASIS DESC LIMIT 1";
            $salida = $cn->prepare($busqueda);
            $salida->execute([$dni]);
            $ordenado = $salida->fetchColumn();
//buscamos en la base de datos que no se haya registrado la salida
            $busfecha="SELECT SALIDA FROM tblasistencia WHERE DNI=? ORDER BY COD_ASIS DESC LIMIT 1";
            $sali = $cn->prepare($busfecha);
            $sali->execute([$dni]);
            $solounasalida = $sali->fetchColumn();
//En esta consulta buscamos la fecha de entrada en la base de datos 
            $busentrada="SELECT ENTRADA FROM tblasistencia WHERE DNI=? ORDER BY COD_ASIS DESC LIMIT 1";
            $entra = $cn->prepare($busentrada);
            $entra->execute([$dni]);
            $entrada = $entra->fetchColumn();

            if(substr($fechasalida,0,10)==substr($solounasalida,0,10)){ ?>
                <script>
                    $(function notificacio(){
                        new PNotify({
                            title: "ERROR !!!",
                            type: "error",
                            text: "YA REGISTRASTE TU SALIDA !!!",
                            styling: "bootstrap3" 
                        })
                    })
                </script>
            <?php 

            }else{
                if(substr($fechasalida,0,10)==substr($entrada,0,10)){
                    $entrada="UPDATE  tblasistencia SET SALIDA= ? WHERE COD_ASIS=?";
                    $stmt_insert = $cn->prepare($entrada);
                    $resultado = $stmt_insert->execute([$fechasalida, $ordenado]);
                    if($resultado==true){ ?>
                        <script>
                            $(function notificacio(){
                                new PNotify({
                                    title: "CORRECTO",
                                    type: "success",
                                    text: "ADIOS !!!, Vuelve pronto",
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
                }else{ ?>
                    <script>
                        $(function notificacio(){
                            new PNotify({
                                title: "INCORRECTO",
                                type: "error",
                                text: "Primero debe registrar su entrada",
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
    <?php } ?>
        <script>
            setTimeout(() => {
                window.history.replaceState(null,null, window.location.pathname);
            }, 0);
        </script>    
<?php }

?> 
