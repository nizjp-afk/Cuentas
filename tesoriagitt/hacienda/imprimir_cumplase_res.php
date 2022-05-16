<?php
 error_reporting ( E_ERROR );
   //conexion
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
   // include('conexion/extras.php');
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	$saf = $_GET['saf'];
	//$fecha_cons=$_GET['consul'];	
	
	$ssql = "SELECT * FROM `control_fecha`";
     if (!($r_cf= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
	$f_cf=mysql_fetch_array($r_cf);
	$nro =$f_cf['nro_ti'];
	$nroaux=$nro;
	$nro=$nro+1;
	
	 $ssql = "SELECT * FROM op_pendiente_tmp where nro_ti='$nroaux' order by Saf,Ejercicio  ";
	 if (!($r_op= mysql_query($ssql, $conexion_mysql)))
		{
		  
		  //.....................................................................
		  // informa del error producido
		  $cuerpo1  = "al intentar buscar area";
		 
		  //.....................................................................
		}
	$cant = mysql_num_rows($r_op);
if ($cant>0)
	   {//llave 1
	
	
	$ssql = "UPDATE `control_fecha` SET nro_ti='$nro'";
     if (!($r_cf= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
	
	
	
	 $ssql = "SELECT * FROM op_pendiente_tmp where nro_ti='$nroaux' group by Ejercicio order by Ejercicio ";
     if (!($r_ope= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }

	
//////////////fin de consulta en base///////////

   $f=strftime("%Y-%m-%d");
   $dia = date("d/m/Y");
   $hora =date("h:i");

//echo "paso";exit; 		
define('FPDF_FONTPATH','font/');
require('../fpdf.php');

//Connect to your database
//Create new pdf file
$pdf=new FPDF('L','mm','A4');
//$pdf=new FPDF('P','mm','A4'); // imprime hoja horizontal
//$pdf=new FPDF('P','mm','Legal');//imprime hoja vertical

while ($f_ope=mysql_fetch_array($r_ope))
  { //llave 2
  
  $Ejercicio =$f_ope['Ejercicio'];
//Open file
$pdf->Open();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();

$y_axis_initial = 17;
// imprime el titulo de la pagina
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($y_axis_initial);
$pdf->Image('../img/tgp_01.jpg',30,6,25);
$pdf->Image('../img/tgp_02.jpg',75,6,10);

$pdf->SetFont('Arial','B',6);
//$pdf->setX(150);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
//$pdf->setY(25);
$pdf->SetY(15);
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
$pdf->SetY($y_axis_initial+5);
$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
$pdf->SetY($y_axis_initial+10);
$pdf->SetFont('Arial','B',8);
$pdf->cell(0,0,'Nº Autorizacion: '.$nroaux,0,'B','R',0);


//set initial y axis position per page
$y_axis_initial = 30;
$pdf->SetY($y_axis_initial);
$pdf->SetFont('Arial','B',12);
$pdf->SetX(30);
$pdf->cell(0,0,'EJERCICIO: '.$Ejercicio,0,'B','L',0);
$pdf->SetX(150);
$pdf->Cell(0,4,'CUMPLASE','0',0,'L',0);

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',10);
$i=35;
$pdf->SetY($i);
$pdf->SetX(30);
$pdf->Cell(0,4,'','T',0,'L',1);


///////////////////////////////////////////////////////////////////////////////////////

////// DETALLE DEL PRESUPUESTO

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->SetY($i=$i+7);
$pdf->SetX(30);
$pdf->Cell(10,6,'Saf',1,0,'C',1);
$pdf->Cell(15,6,'Formul',1,0,'C',1);
$pdf->Cell(10,6,'Fuente',1,0,'C',1);
$pdf->Cell(10,6,'Clase',1,0,'C',1);
$pdf->Cell(50,6,'Beneficiario',1,0,'C',1);
$pdf->Cell(50,6,'Concepto',1,0,'C',1);
$pdf->Cell(23,6,'Imp. del Form',1,0,'C',1);
$pdf->Cell(23,6,'Pagado',1,0,'C',1);
$pdf->Cell(23,6,'Saldo',1,0,'C',1);
$pdf->Cell(23,6,'Autorizado',1,0,'C',1);
$pdf->Cell(23,6,'Nuevo Saldo',1,0,'C',1);
$ci=0;
$aux=='';
//$y_axis=54;
$row_height = 8;
$InterLigne = 4;
$max=15;
mysql_data_seek($r_op,0);
while($row = mysql_fetch_array($r_op))
  { // llave 3
  $ci=$ci+1;	
  if ($ci == $max)
     { // llave 4
		
		$pdf->AddPage();

		$y_axis_initial = 17;
		// imprime el titulo de la pagina
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',8);
		$pdf->SetY($y_axis_initial);
		$pdf->Image('../img/tgp_01.jpg',30,6,25);
		$pdf->Image('../img/tgp_02.jpg',75,6,10);
		
		$pdf->SetFont('Arial','B',6);
		//$pdf->setX(150);
		// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
		//$pdf->setY(25);
		$pdf->SetY(15);
		$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
		$pdf->SetY($y_axis_initial+5);
		$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
		$pdf->SetY($y_axis_initial+10);
		$pdf->SetFont('Arial','B',8);
		$pdf->cell(0,0,'Nº Autorizacion: '.$nroaux,0,'B','R',0);
		
		
		//set initial y axis position per page
		$y_axis_initial = 30;
		$pdf->SetY($y_axis_initial);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetX(30);
		$pdf->cell(0,0,'EJERCICIO: '.$Ejercicio,0,'B','L',0);
		$pdf->SetX(150);
		$pdf->Cell(0,4,'CUMPLASE','0',0,'L',0);
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',10);
		$i=35;
		$pdf->SetY($i);
		$pdf->SetX(30);
		$pdf->Cell(0,4,'','T',0,'L',1);
		
		
		///////////////////////////////////////////////////////////////////////////////////////
		
		////// DETALLE DEL PRESUPUESTO
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',6);
		$pdf->SetY($i=$i+7);
		$pdf->SetX(30);
		$pdf->Cell(10,6,'Saf',1,0,'C',1);
		$pdf->Cell(15,6,'Formul',1,0,'C',1);
		$pdf->Cell(10,6,'Fuente',1,0,'C',1);
		$pdf->Cell(10,6,'Clase',1,0,'C',1);
		$pdf->Cell(50,6,'Beneficiario',1,0,'C',1);
		$pdf->Cell(50,6,'Concepto',1,0,'C',1);
		$pdf->Cell(23,6,'Imp. del Form',1,0,'C',1);
		$pdf->Cell(23,6,'Pagado',1,0,'C',1);
		$pdf->Cell(23,6,'Saldo',1,0,'C',1);
		$pdf->Cell(23,6,'Autorizado',1,0,'C',1);
		$pdf->Cell(23,6,'Nuevo Saldo',1,0,'C',1);
		
		
		//$y_axis=54;
		$row_height = 10;
		$InterLigne = 4;
	  } //cerrar llave 4
  
	  
    //If the current row is the last one, create new page and print column title
    if($row['Ejercicio']==$Ejercicio)
	  { //llave 5
	   $saf = $row['Saf'];
	   if ($aux=='')
	     { //llave 6
	    	  $aux=$saf;
		 } //llave 6
	   if($aux==$saf)
	     {//llave 7
		  $formul = $row['Numero_OP'];
		  $fuente = $row['Fuente'];
		  $clase = $row['Clase'];
		  $beneficiario = $row['Beneficiario'];
		  $concepto = $row['Concepto'];
		  $importe = $row['Imp_orden'];
		  $pagado = $row['Total_Pagado'];
		  $saldo = $row['Saldos'];
		  $autorizado = $row['autorizado'];
		  
		  $nuevo_saldo=$saldo-$autorizado;
		  
		  $tot_importe=$tot_importe+$importe;
		  
		  $tot_pagado=$tot_pagado+$pagado;
		  
		  $tot_saldo=$tot_saldo+$saldo;
		  
		  $tot_auto=$tot_auto+$autorizado;
		  
		  $tot_nuevo_sal=$tot_nuevo_sal+$nuevo_saldo;
    
   
   
		$pdf->SetFont('courier','',9);
		$pdf->SetY($i=$i+9);
		$pdf->SetX(30);
        $pdf->Cell(10,6,$saf,1,0,'C',1);
		$pdf->Cell(15,6,$formul,1,0,'C',1);
		$pdf->Cell(10,6,$fuente,1,0,'C',1);
		$pdf->Cell(10,6,$clase,1,0,'C',1);
		$pdf->Cell(50,6,$beneficiario,1,0,'L',1);
		$pdf->Cell(50,6,$concepto,1,0,'L',1);
		$pdf->Cell(23,6,number_format($importe,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($pagado,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($saldo,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($autorizado,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($nuevo_saldo,2),1,0,'R',1);

	//$pdf->line(15,$y_axis,205,$y_axis); 
   
	$y_axis = $y_axis + $row_height;
	
		 } //llave 7
	else
	  { //llave 7 else
		
		$pdf->SetY($i=$i+9);
		$pdf->SetX(125);   
		$pdf->Cell(50,6,'TOTAL DEL SERVICIO :'.$aux,1,0,'L',1);
		$pdf->Cell(23,6,number_format($tot_importe,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($tot_pagado,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($tot_saldo,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($tot_auto,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($tot_nuevo_sal,2),1,0,'R',1);
		
  	    $tot_gral_importe=$tot_gral_importe+$tot_importe;
	    
		$tot_gral_pagado=$tot_gral_pagado+$tot_pagado;
	    
		$tot_gral_saldo=$tot_gral_saldo+$tot_saldo;
	    
		$tot_gral_auto=$tot_gral_auto+$tot_auto;
	    
		$tot_gral_nuevo_sal=$tot_gral_nuevo_sal+$tot_nuevo_sal;
		
		
		
		  $tot_importe=0;
		  $tot_pagado=0;
		  $tot_saldo=0;
		  $tot_auto=0;
		  $tot_nuevo_sal=0;
		  
		  $formul = $row['Numero_OP'];
		  $fuente = $row['Fuente'];
		  $clase = $row['Clase'];
		  $beneficiario = $row['Beneficiario'];
		  $concepto = $row['Concepto'];
		  $importe = $row['Imp_orden'];
		  $pagado = $row['Total_Pagado'];
		  $saldo = $row['Saldos'];
		  $autorizado = $row['autorizado'];
		  
		  $nuevo_saldo=$saldo-$autorizado;
		  
		  $tot_importe=$tot_importe+$importe;
		  
		  $tot_pagado=$tot_pagado+$pagado;
		  
		  $tot_saldo=$tot_saldo+$saldo;
		  
		  $tot_auto=$tot_auto+$autorizado;
		  
		  $tot_nuevo_sal=$tot_nuevo_sal+$nuevo_saldo;
          $ci=$ci+1;	
   
   
		$pdf->SetFont('courier','',9);
		$pdf->SetY($i=$i+9);
		$pdf->SetX(30);
        $pdf->Cell(10,6,$saf,1,0,'C',1);
		$pdf->Cell(15,6,$formul,1,0,'C',1);
		$pdf->Cell(10,6,$fuente,1,0,'C',1);
		$pdf->Cell(10,6,$clase,1,0,'C',1);
		$pdf->Cell(50,6,$beneficiario,1,0,'L',1);
		$pdf->Cell(50,6,$concepto,1,0,'L',1);
		$pdf->Cell(23,6,number_format($importe,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($pagado,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($saldo,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($autorizado,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($nuevo_saldo,2),1,0,'R',1);

	//$pdf->line(15,$y_axis,205,$y_axis); 
   
	$y_axis = $y_axis + $row_height;
		  
	  } //llave 7 else
	  
  	  
  } //llave 5
  

 } //llave 3       
//////////////////////////////////////////////////////////////////////////////////////////////




////////////



    $pdf->SetY($i=$i+9);
		$pdf->SetX(125);   
		$pdf->Cell(50,6,'TOTAL DEL SERVICIO :'.$aux,1,0,'L',1);
		$pdf->Cell(23,6,number_format($tot_importe,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($tot_pagado,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($tot_saldo,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($tot_auto,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($tot_nuevo_sal,2),1,0,'R',1);
  	    $tot_gral_importe=$tot_gral_importe+$tot_importe;
	    $tot_gral_pagado=$tot_gral_pagado+$tot_pagado;
	    $tot_gral_saldo=$tot_gral_saldo+$tot_saldo;
	    $tot_gral_auto=$tot_gral_auto+$tot_auto;
	    $tot_gral_nuevo_sal=$tot_gral_nuevo_sal+$tot_nuevo_sal;
		$aux=$saf;
		  $tot_importe=0;
		  $tot_pagado=0;
		  $tot_saldo=0;
		  $tot_auto=0;
		  $tot_nuevo_sal=0;
		  $aux=0;
        $pdf->SetY($i=$i+9);
		$pdf->SetX(125);   
		$pdf->Cell(50,6,'TOTAL  :',1,0,'L',1);
		$pdf->Cell(23,6,number_format($tot_gral_importe,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($tot_gral_pagado,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($tot_gral_saldo,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($tot_gral_auto,2),1,0,'R',1);
		$pdf->Cell(23,6,number_format($tot_gral_nuevo_sal,2),1,0,'R',1);	
		$pdf->SetFont('courier','B',12);
$pdf->SetY(-10);
$pdf->SetX(180);
$pdf->Cell(60,3,'Firma  ',0,0,'R',1);


$pdf->SetY(-5);
//Select Arial italic 8
$pdf->SetFont('Arial','I',10);
 //Print current and total page numbers
$pdf->Cell(0,10,'Original',0,0,'C'); 


    } //llave 2
	
$pdf->Output();
}//llave 1
else
 {
 ?>
<center><h1>Error!</h1></center>
<meta http-equiv='refresh' content='10;url=javascript:window.history.back()'>
<center><img src="../img/messagebox_critical.png" width="128" height="128" />
<p>Se ha detectado un error.
No hay Ordenes para confirmar  <b>  </p></center>
<code></code>
<code> <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>	  

</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
<?php	  	 
   }
 
?> 
