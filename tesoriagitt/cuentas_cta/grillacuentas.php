<?php 
/////////////////CONEXION DB///////////////////
$mysqli = new mysqli("localhost", "root", "", "cuentas");
          if ($mysqli->connect_errno) {
              echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
              }
$mysqli->host_info . "\n";
//////////////////////////////////////////////////
error_reporting(E_ALL ^ E_NOTICE);

if ( isset($_POST['cta'], $_POST['banco'], $_POST['saf']) ) 
 {
     $buscar  = $_POST['busquedasaf'];

    $ssql= "SELECT id, cta, banco,saf, denominacion, organismo, fdopropio 
            FROM cuentas
            WHERE saf = '$nrosaf'
            AND (saf LIKE '%$buscar%' and cta LIKE '%$buscar%' and banco LIKE '%$buscar%')";
 }
    $ssql= "SELECT id, cta, banco,saf, denominacion, organismo, fdopropio 
            FROM cuentas
            WHERE saf ='$nrosaf' AND (saf LIKE '%$buscar%')";


 if (!($result = mysqli_query($mysqli,$ssql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar Cuentas";
     
      //.....................................................................
    }	

?>
<!DOCTYPE html>
<html>
<!-- Required meta tags -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<!--datables CSS básico-->
<link rel="stylesheet" type="text/css" href="datatables_custom/datatables/datatables.min.css"/>
<!--datables estilo bootstrap 4 CSS-->  
<link rel="stylesheet"  type="text/css" href="datatables_custom/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">     
<!-- fontawesome -->
<script src="https://kit.fontawesome.com/27464e646d.js" crossorigin="anonymous"></script>

<!-- Datatables -->
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/dt/dt-1.11.5/af-2.3.7/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/cr-1.5.5/date-1.1.2/fc-4.0.2/fh-3.2.2/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sl-1.3.4/sr-1.1.0/datatables.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/af-2.3.7/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/cr-1.5.5/date-1.1.2/fc-4.0.2/fh-3.2.2/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sl-1.3.4/sr-1.1.0/datatables.min.js">
</script>
<!-- CUSTOM CSS -->
<link rel="stylesheet" href="stylesgrillas.css">

<!-- Java Script -->
<script type="text/javascript">
$(document).ready(function() {
    $('#mydatatable tfoot th ').each(function() {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Filtrar.." />');
    });
    var table = $('#mydatatable').DataTable({
        "dom": 'B<"float-left"i>t<"float-left"l><"float-right"p><"clearfix">',
        buttons:[ 
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel" id="excel" ></i>  ',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
			{
				extend:    'pdfHtml5',
				text:      '<i class="fas fa-file-pdf" id="pdf" ></i> ',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-danger'
			},
			{
				extend:    'print',
				text:      '<i class="fa fa-print" id="print"></i> ',
				titleAttr: 'Imprimir',
				className: 'btn btn-info'
			},
		],	 
        "responsive": false,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
        "order": [
            [0, "desc"]
        ],
        "initComplete": function() {
            this.api().columns().every(function() {
                var that = this;

                $('input', this.footer()).on('keyup change', function() {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            })
        }
    });    
});

$(function() {

var $body = $(document);
$body.bind('scroll', function() {
    // "Desactivar" el scroll horizontal
    if ($body.scrollLeft() !== 0) {
        $body.scrollLeft(0);
    }
});

}); 
</script>
    
<body>
    <div class="content">
        <img src="./img/Banner superior.jpg">
    </div>
    <div class="wrapper">
            <div class="table-responsive" id="mydatatable-container">
                <table class="table table-secondary" id="mydatatable">
                    <thead>
                        <tr>
                            <th>Cuenta</th>
                            <th>Banco</th>
                            <th>Saf</th>
                            <th>Denominacion</th>
                            <th>Organismo</th>
                            <th>Verificar</th>
                            <th>Archivos</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Cuenta</th>
                            <th>Banco</th>
                            <th>Saf</th>
                            <th>Denominacion</th>
                            <th>Organismo</th>
                            <th>Verificar</th>
                            <th>Archivos</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
 
 							while($fila=mysqli_fetch_array($result))
         						{
  						?>
                        <tr>
                            <td><?php echo $fila['cta']; ?></td>
                            <td><?php echo $fila['banco'];?></td>
                            <td><?php echo $fila['saf'];?></td>
                            <td><?php echo $fila['denominacion'];?></td>
                            <td><?php echo $fila['organismo'];?></td>
                            <th><a href="indexctas.php?sec=cuentas_cta/validardatos&id=<?php echo $fila['id'];?>"
                                    class="thickbox" title="Verificar cuenta"><button class="bn13"><i
                                            class="fas fa-check-square"></i></button></a></th>               
                            <th><a href="" class="thickbox" title="Subir archivos"><button class="bn14"><i
                                            class="fas fa-file-pdf"></i></button></a></th>
                        </tr>
                        <?php
    						}
 						?>
                    </tbody>
                </table>
            </div>
    </div>
    
     
    <!-- para usar botones en datatables JS -->  
    <script src="datatables_custom/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables_custom/datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables_custom/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables_custom/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables_custom/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
     
    <!-- código JS propìo-->    
    <script type="text/javascript" src="mainn.js"></script>  
</body>
</html>
<?php //include('footer.php'); ?>