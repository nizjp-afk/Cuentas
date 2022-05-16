<?php
/////////////////CONEXION DB///////////////////
$mysqli = new mysqli("localhost", "root", "", "cuentas");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
$mysqli->host_info . "\n";
//////////////////////////////////////////////////
error_reporting(E_ALL ^ E_NOTICE);

    $id = $_GET['id'];
    $sele = "SELECT a.id id, b.dni dni, b.id_firm ,b.nombre nombre, b.domicilio domicilio, c.id,s.cuit, c.cta, c.banco,c.saf, c.denominacion, c.organismo, c.fdopropio, b.cargo cargo, DATE_FORMAT(a.fechaalta, '%d/%m/%Y') as fechaalta, a.resalta resalta 
    FROM firm_ctas a, firm_datos b, cuentas c, saf s 
    WHERE b.dni = a.dni AND a.idcuenta = c.id AND a.baja = 0 AND c.id = $id AND c.saf = s.servicio ORDER BY b.nombre;";

    $result = mysqli_query($mysqli,$sele);
    $row = mysqli_fetch_assoc($result);  

    $banco = "SELECT * FROM banco order by id";
    $banco_result = mysqli_query($mysqli,$banco);

    $fuente = "SELECT * FROM r_fuente order by id";
    $fuente_result = mysqli_query($mysqli,$fuente);

    $cuenta_b = "SELECT * FROM r_cuentabancaria order by id";
    $cuenta_result = mysqli_query($mysqli,$cuenta_b);

    $tipo_c = "SELECT * FROM r_tipo_cuenta order by id";
    $cuentat_result = mysqli_query($mysqli,$tipo_c);

    $cuenta_t = "SELECT * FROM r_cuenta_tipo order by id";
    $tipoc_result = mysqli_query($mysqli,$cuenta_t);

    $moneda = "SELECT * FROM r_moneda order by id";
    $moneda_result = mysqli_query($mysqli,$moneda);
     
     



        $status = "";
        if(isset($_POST['enviar']))
        {
        $cta= $_POST['cta'];
        $banco= $_POST['banco'];
        $saf= $_POST['saf'];
        $denominacion= $_POST['denominacion'];
        $organismo= $_POST['organismo'];
        $dni= $_POST['dni'];
        $nombre= $_POST['nombre'];
        $domicilio= $_POST['domicilio'];
        $id= $_POST['id'];    
        
        if (mysqli_query($mysqli, $update)=== TRUE) 
        {
        echo '<script type="text/javascript">'; 
        echo 'alert("EDICION CORRECTA. YA PUEDE CERRAR ESTA VENTANA ");'; 
        echo 'window.location = "javascript:history.back(1)";';
        echo '</script>';
        
        }
        else
        {
        
        echo '<script type="text/javascript">'; 
        echo 'alert("ERROR REVISAR SI FALTAN DATOS");'; 
        echo 'window.location = "javascript:history.back(1)";';
        echo '</script>';
        }
        
        }

        else {
 


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="stylesgrillas.css">
    </style>
    <!-- Font awesome icons -->
    <script src="https://kit.fontawesome.com/27464e646d.js" crossorigin="anonymous"></script>
    <!-- END Font awesome icons -->
    <script>
    function Formulario(cantidad, posicion, formRef) {
        this.cantidad = cantidad;
        this.posicion = posicion;
        this.formRef = formRef;

        this.ocultarTodos = function() {
            for (var pagina = 0; pagina <= this.cantidad; pagina++)
                $(this.formRef + " .parte" + pagina).hide();
            console.log("todos ocultos");
        }

        this.mostrar = function(pagina) {
            this.ocultarTodos();
            $(this.formRef + " .parte" + pagina).show();
            console.log("muestra " + pagina);
        }

        this.siguiente = function() {
            console.log("siguiente");
            if (this.posicion < this.cantidad) {
                this.posicion++;
                this.mostrar(this.posicion);
            }
        }

        this.anterior = function() {
            console.log("anterior");
            if (this.posicion > 1) {
                this.posicion--;
                this.mostrar(this.posicion);
            }
        }

        this.constructor = function() {
            this.ocultarTodos();
            this.mostrar(this.posicion);
            $(this.formRef + " .parte1 .ant").attr("disabled", "disabled");
            $(this.formRef + " .parte" + cantidad + " .sig").attr("disabled", "disabled");
        }
    };

    $(function() {

        var miForm = new Formulario(6, 1, "#miform");

        miForm.constructor();

        $(".sig").click(
            function() {
                miForm.siguiente()
            }
        );

        $(".ant").click(
            function() {
                miForm.anterior()
            }
        );
    });
    </script>
    <title>Verificar cuenta</title>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark" id="FirstNav">
        <div class="a" id="FirstD">
            <h4 class="navbar-brand" style="float:center;width: 50%;" >Formulario de reempadronamiento de Cuentas</h4>
        </div>
        <div class="b" id="SecondD">
            <a class="navbar-brand"></a>
        </div>
    </nav>
    <!-- Content Wrapper. Contains page content -->
    <div>
        <div style="float:left;width: 50%;">
            <!-- Content Header (Page header) -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <!-- /.card-header -->
                                <div ng-app class="card-body">
                                    <form action="indexctas.php?sec=cuentas_cta/guardarcta" method="post" id="miform" class="form-control-bg dark" enctype="multipart/form-data">
                                        <div class="parte1">
                                            <h4>Datos del organismo solicitante</h4>
                                            <div>
                                                <label class="dc">Denominacion</label>
                                                <input type="text" placeholder="Introduce tu denominacion..."
                                                    class="form-control" name="denominacion"
                                                    value="<?php echo $row['organismo']?>" required>
                                            </div>
                                            <div>
                                                <label class="d">CUIT N°</label>
                                                <input type="text" placeholder="Introduce tu CUIT..."
                                                    class="form-control" name="cuit" value="<?php echo $row['cuit']?>"
                                                    required>
                                            </div>
                                            <br>
                                            <h4>Datos del titular de la cuenta</h4>
                                            <div>
                                                <label class="dc">Denominacion</label>
                                                <input type="text" placeholder="Introduce tu denominacion..."
                                                    class="form-control" name="nombre"
                                                    value="<?php echo $row['organismo']?>" required>
                                            </div>
                                            <div>
                                                <label class="d">CUIT N°</label>
                                                <input type="text" placeholder="Introduce tu CUIT..."
                                                    class="form-control" name="cuit_titular" value="" required>
                                            </div>
                                            <h4>Domicilio</h4>
                                            <div>
                                                <label class="d">Direccion</label>
                                                <input type="text" placeholder="Introduce tu direccion..."
                                                    class="form-control" name="direccion" value="" required>
                                            </div>
                                            <div>
                                                <label class="d">Localidad</label>
                                                <input type="text" placeholder="Introduce tu localidad..."
                                                    class="form-control" name="localidad"
                                                    value="" required>
                                            </div>
                                            <div>
                                                <label class="d">C.P N°</label>
                                                <input type="text" placeholder="Introduce tu CP..." class="form-control"
                                                    name="codigo_postal" value="" required>
                                            </div>
                                            <br>
                                            <button type="button" class="sig" id="sig" value="Sig"><i
                                                            class="fas fa-arrow-circle-right"></i>&nbsp;Siguiente</button>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- AQUI TERMINA LA PRIMERA PARTE -->
                                        <div class="parte2">
                                            <h3>Clasificacion de la cuenta</h3>
                                                <div>
                                                    <label class="d">Denominacion</label>
                                                    <input type="hidden" value="<?php echo $row['id']?>" name="id">
                                                    <input type="text" placeholder="Introduce tu denominacion..."
                                                        class="form-control" name="denominacion"
                                                        value="<?php echo $row['denominacion'] ?>" required>
                                                </div>
                                                <div>
                                                    <label class="d">Banco</label>
                                                    <select name="banco_id" class="form-control">
                                                        <option> Seleccionar un Banco</option required>
                                                        <?php     
       
                                                            while ($b_row = mysqli_fetch_assoc($banco_result))
                                                            
                                                                {
                                                                    ?>

                                                        <option value="<?php echo $b_row['id']?>">
                                                            <?php echo $b_row['nombre'] ?></option>
                                                        <?php
                                                                        }
                                                                ?>
                                                    </select>
                                                </div>

                                                <div>
                                                    <label class="d">Tipo de cuenta bancaria</label>
                                                    <select name="tipo_cta_id" class="form-control">
                                                        <option> Seleccione una cuenta</option required>
                                                        <?php     
       
                                                            while ($c_row = mysqli_fetch_assoc($cuenta_result))
                                                            
                                                                {
                                                                    ?>

                                                        <option value="<?php echo $c_row['id'] ?>">  <?php echo $c_row['nombre'] ?></option>
                                                        <?php
                                                                        }
                                                                ?>
                                                    </select>
                                                </div>
                                                    <br>
                                                    <div class="form-inline" id="nrocta">
                                                        <label class="d">N° de cta/Moneda</label>
                                                        <br>
                                                        <input type="text" placeholder="Introduce tu nro de cta..."
                                                            class="form-control" name="nro_cuenta"
                                                            value="<?php echo $row['cta'] ?>" required>

                                                            <select name="tipo_moneda_id" class="form-control">
                                                        <option> Seleccione un tipo de moneda</option required>
                                                        <?php     
       
                                                            while ($m_row = mysqli_fetch_assoc($moneda_result))
                                                            
                                                                {
                                                                    ?>

                                                        <option value="<?php echo $m_row['id'] ?>"><?php echo $m_row['alias'] ?> - <?php echo $m_row['nombre'] ?></option>
                                                        <?php
                                                                        }
                                                                ?>
                                                    </select>
                                                    </div>
                                                    <div>
                                                        <label class="d">CBU</label>
                                                        <input type="text" placeholder="Introduce tu CBU..."
                                                            class="form-control" name="cbu"
                                                            value="" required>
                                                    </div>
                                                    <div>

                                                        <label class="d">Fuente de Financiamiento</label>
                                                        <select name="fuente_id" class="form-control" required>
                                                            <option>Seleccionar Fuente de Financiamiento</option>
                                                            <?php     
       
                                                            while ($f_ff = mysqli_fetch_assoc($fuente_result))
                                                                {
                                                                    ?>

                                                            <option value="<?php echo $f_ff['id'] ?>">
                                                                <?php echo $f_ff['ff'] ?> <?php echo $f_ff['detalle'] ?>
                                                            </option>
                                                            <?php
                                                                        }
                                                                ?>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="d">Resolucion de Autorizacion-Alta </label>
                                                        <input type="text" placeholder="Introduce tu CBU..."
                                                            class="form-control" name="resolucion"
                                                            value="<?php echo $row['resalta'] ?>" required>
                                                    </div>
                                                    <div>

                                                        <label class="d">Tipo de cuenta</label>
                                                        <select name="clasificacion_cta" class="form-control" required>
                                                            <option>Seleccionar el tipo de cuenta</option>
                                                            <?php     
       
                                                            while ($t_dc = mysqli_fetch_assoc($tipoc_result))
                                                                {
                                                                    ?>

                                                            <option value="<?php echo $t_dc['id'] ?>">
                                                                <?php echo $t_dc['alias'] ?> - <?php echo $t_dc['nombre'] ?>
                                                            </option>
                                                            <?php
                                                                        }
                                                                ?>
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <button type="button" class="ant" id="ant" value="Ant"><i
                                                            class="fas fa-arrow-circle-left"></i>&nbsp;Anterior</button>
                                                    <button type="button" class="sig" id="sig" value="Sig"><i
                                                            class="fas fa-arrow-circle-right"></i>&nbsp;Siguiente</button>
                                        </div>
                                        <!-- AQUI EMPIEZA LA SEGUNDA PARTE -->
                                        <div class="parte3">
                                            <?php mysqli_data_seek($result,0); $row = mysqli_fetch_assoc($result);  ?>
                                            <h3>Datos del responsable</h3>

                                                <div>
                                                    <label class="d">Nombre y apellido</label>
                                                    <input type="text" placeholder="Introduce tu nombre completo..."
                                                        class="form-control" name="nombre_completo1"
                                                        value="<?php echo $row['nombre'] ?>" required>
                                                </div>
                                                <div>
                                                    <label class="d">DNI/LC/LE N°</label>
                                                    <input type="text" placeholder="<?php echo $row['dni'] ?>"
                                                        class="form-control" name="dni1"
                                                        value="<?php echo $row['dni'] ?>" required>
                                                    <input type="hidden" name="responsable_id" value="<?php echo $row['id_firm'] ?>">
                                                </div>
                                                <div>
                                                    <label class="d">Cargo</label>
                                                    <input type="text" placeholder="Introduce tu cargo..."
                                                        class="form-control" name="cargo1"
                                                        value="<?php echo $row['cargo'] ?>" required>
                                                </div>
                                                <br>
                                                <div>
                                                    <br>
                                                    <button type="button" class="ant" id="ant" value="Ant"><i
                                                            class="fas fa-arrow-circle-left"></i>&nbsp;Anterior</button>
                                                    <button type="button" class="sig" id="sig" value="Sig"><i
                                                            class="fas fa-arrow-circle-right"></i>&nbsp;Siguiente</button>
                                                </div>
                                                <!-- /.card-body -->
                                        </div>
                                        <div class="parte4">
                                            <?php mysqli_data_seek($result,1);   
                                              
                                              $row = mysqli_fetch_assoc($result);  ?>
                                            <h3>Datos del responsable N°2</h3>
                                                <div>
                                                    <label class="d">Nombre y apellido</label>
                                                    <input type="text" placeholder="Introduce tu nombre completo..."
                                                        class="form-control" name="nombre_completo2"
                                                        value="<?php echo $row['nombre'] ?>" required>
                                                </div>
                                                <div>
                                                    <label class="d">DNI/LC/LE N°</label>
                                                    <input type="text" placeholder="Introduce tu DNI..."
                                                        class="form-control" name="dni2"
                                                        value="<?php echo $row['dni'] ?>" required>
                                                        <input type="hidden" name="id_firm" value="<?php echo $row['id_firm'] ?>">
                                                </div>
                                                <div>
                                                    <label class="d">Cargo</label>
                                                    <input type="text" placeholder="Introduce tu nacionalidad..."
                                                        class="form-control" name="cargo2"
                                                        value="<?php echo $row['cargo'] ?>" required>
                                                </div>

                                                <div>
                                                    <br>
                                                    <button type="button" class="ant" id="ant" value="Ant"><i
                                                            class="fas fa-arrow-circle-left"></i>&nbsp;Anterior</button>
                                                    <button type="button" class="sig" id="sig" value="Sig"><i
                                                            class="fas fa-arrow-circle-right"></i>&nbsp;Siguiente</button>
                                                </div>
                                                <!-- /.card-body -->
                                        </div>
                                        <div class="parte5">
                                            <?php mysqli_data_seek($result,2);   
                                              
                                              $row = mysqli_fetch_assoc($result);  ?>
                                            <h3>Datos del responsable N°3</h3>
                                                <div>
                                                    <label class="d">Nombre y apellido</label>
                                                    <input type="text" placeholder="Introduce tu nombre completo..."
                                                        class="form-control" name="nombre_completo3"
                                                        value="<?php echo $row['nombre'] ?>">
                                                </div>
                                                <div>
                                                    <label class="d">DNI/LC/LE N°</label>
                                                    <input type="text" placeholder="Introduce tu DNI..."
                                                        class="form-control" name="dni3"
                                                        value="<?php echo $row['dni'] ?>">
                                                </div>
                                                <div>
                                                    <label class="d">Cargo</label>
                                                    <input type="text" placeholder="Introduce tu nacionalidad..."
                                                        class="form-control" name="cargo3"
                                                        value="<?php echo $row['cargo'] ?>">
                                                </div>

                                                <div>
                                                    <br>
                                                    <button type="button" class="ant" id="ant" value="Ant"><i
                                                            class="fas fa-arrow-circle-left"></i>&nbsp;Anterior</button>
                                                    <button type="button" class="sig" id="sig" value="Sig"><i
                                                            class="fas fa-arrow-circle-right"></i>&nbsp;Siguiente</button>
                                                </div>
                                        <!-- /.card-body -->
                                        </div>
                                        <div class="parte6">
                                            <?php mysqli_data_seek($result,3);   
                                              
                                              $row = mysqli_fetch_assoc($result);  ?>
                                            <h3>Datos del responsable N°4</h3>
                                                <div>
                                                    <label class="d">Nombre y apellido</label>
                                                    <input type="text" placeholder="Introduce tu nombre completo..."
                                                        class="form-control" name="nombre_completo4"
                                                        value="<?php echo $row['nombre'] ?>">
                                                </div>
                                                <div>
                                                    <label class="d">DNI/LC/LE N°</label>
                                                    <input type="text" placeholder="Introduce tu DNI..."
                                                        class="form-control" name="dni4"
                                                        value="<?php echo $row['dni']?>">
                                                        <input type="hidden" name="id_firm" value="<?php echo $row['id_firm'] ?>">
                                                </div>
                                                <div>
                                                    <label class="d">Cargo</label>
                                                    <input type="text" placeholder="Introduce tu Nacionalidad..."
                                                        class="form-control" name="cargo4"
                                                        value="<?php echo $row['cargo'] ?>">
                                                </div>
                                                <br>
                                                <div>
                                                    <button type="button" class="ant" id="ant" value="Ant"><i
                                                            class="fas fa-arrow-circle-left"></i>&nbsp;Anterior</button>

                                                    <button type="button" class="sig" id="sig" value="Sig"><i
                                                            class="fas fa-arrow-circle-right"></i>&nbsp;Siguiente</button>
                                                    <br>
                                                </div>

                                                <!-- /.card-body -->
                                        </div>
                                        
                                        <!-- /.card-body -->
                                </div>                                           
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Content Wrapper. Contains page content -->
        <div style="float:left;width: 50%;">
            <!-- Content Header (Page header) -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary" id="files">
                                <div class="izquierda">
                                    <div class="d">
                                        <h5 class="title">Documentacion que se debe adjuntar a la solicitud</h5>
                                    </div>
                                    <!-- /.card-header -->
                                    <div ng-app class="card-body">
                                        <h5 class="d">1-Fotocopia de DNI/LC/LE del o los responsables.</h5>
                                        <h5 class="d">2-Fotocopia del acto administrativo de designacion de cada
                                            responsable.</h5>
                                        <h5 class="d">3-Firma del responsable del organismo peticionante.</h5>
                                        <h5 class="d">4-Firma del responsable del servicio de administracion financiera
                                            del
                                            cual
                                            depende.</h5>
                                            <h5 class="d">5-Resolucion de Autorizacion del Alta.</h5>
                                        <h5 class="d">6-Subir toda la documentacion en un archivo con formato .PDF <span
                                                style="color:red;"></span></h5>
                                        <h5 class="d"><span style="color:red;">AVISO: TODA LA DOCUMENTACION ES
                                                OBLIGATORIA,
                                                SIN EXCEPCIONES</span></h5>
                                        <!-- /.card -->
                                        <div style="clear:both"></div>
                                        <br>
                                        <div class="parte7">
                                            <h4>Subir Documentacion</h3>

                                                <div>
                                                    <label class="d">Seleccionar documentacion</label>
                                                    <input type="file" name="file[]" id="file[]" multiple="" class="form-control"
                                                        aria-label="file example" required>
                                                    <div class="invalid-feedback">Example invalid form file
                                                        feedback
                                                    </div>
                                                </div>
                                                <br>
                                                <input type="submit" value="Enviar Documentacion" class="btn btn-info"
                                                    name="submit">
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <!-- /.content-wrapper -->
    </div>
    </form>
    <?php } ?>
    </div>
</body>
</html>
<!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted" id="footer">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block" id="span">
            <span>Ponte en contacto con nosotros</span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
            <a href="#" class="me-4 text-reset">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="me-4 text-reset">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="me-4 text-reset">
                <i class="fab fa-google"></i>
            </a>
        </div>
        <!-- Right -->
    </section>
    <!-- Section: Social media -->
    <!-- Section: Links  -->
    <section class="font">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <br>
                    <br>
                    <p>
                        <img class="footerimg" src="img/LOGOGOBIERNO.png" alt="">
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-5 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h5 class="text-uppercase fw-bold mb-4">
                        Contacto
                    </h5>
                    <p><i class="fas fa-home me-3"></i> Av. San Nicolás de Bari 612,La Rioja Argentina</p>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        tgp.informatica@tgplarioja.com.ar
                    </p>
                    <p><i class="fas fa-phone me-3"></i> +543804553164</p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);" id="copyright">
        © 2022 Copyright: Tesoreria General de la Provincia de la Rioja
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->