<?php

//Datos de la conexión
/*
$host = "localhost";
$user = "vivencia_administrador";
$pass = "vivencia2017";
$db   = "vivencia_cris";
*/


$conexion=mysqli_connect("localhost", "root", "");
$db=mysqli_select_db($conexion, "taller");

date_default_timezone_set('America/Argentina/Buenos_Aires');
$alert = false;
$alert_msg = "";
$alert_type = "";
if(isset($_GET['msg'])){
    $alert = true;
    switch ($_GET['msg']){
        case 1:
            $alert_msg = "El usuario fue eliminado correctamente.";
            $alert_type = "success";
            break;
        case 2:
            $alert_msg = "El usuario no fue eliminado correctamente, posiblemente no exista.";
            $alert_type = "danger";
            break;
        case 3:
            $alert_msg = "El usuario fue editado correctamente.";
            $alert_type = "success";
            break;
        case 4:
            $alert_msg = "El usuario no fue editado correctamente, posiblemente no exista.";
            $alert_type = "danger";
            break;
        case 5:
            $alert_msg = "El usuario fue agregado correctamente.";
            $alert_type = "success";
            break;
        case 6:
            $alert_msg = "El usuario no fue agregado correctamente, las contraseñas no coinciden.";
            $alert_type = "danger";
            break;
        case 7:
            $alert_msg = "El usuario no fue agregado correctamente, el correo ya existe.";
            $alert_type = "danger";
            break;
    }
}



/*if (isset($_COOKIE['id_user'])) {
	$consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id_usuario='{$_COOKIE['id_user']}'");
}
*/
	
	//Eliminacion de registro
	
	$consulta_fecha = mysqli_query($conexion, "SELECT created_at, email FROM registros");

	
	while ($registro=mysqli_fetch_assoc($consulta_fecha)) {
		$fecha=$registro['created_at'];
		$email=$registro['email'];
		//echo $mail;
			//echo "Fecha before: ".$fecha;
		//Tomamos la fecha de la base de datos
			//$fecha=date("d-m-Y", strtotime($fecha));
		//echo "Fecha after: ".$fecha;
		$exp_date=strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
		//echo $exp_date;
		//Convertimos la fecha de Y-m-d a d-m-Y.
		//Creamos una variable para la fecha de expiración agregándole la cantidad de días que querramos
		$exp_date= date ( 'd-m-Y' , $exp_date );
		$hoy = date("d-m-Y");
		//echo "<p>Fecha de entrada: ".$fecha."</p>";
		//echo "<p>Exp date: ".$exp_date."</p>";
		//echo "<p>Hoy: ".$hoy."</p>";
		if (strtotime($hoy)>strtotime($exp_date)) {

			$borrar=mysqli_query($conexion, "DELETE * FROM registros WHERE email='".$email."'");
		}
		//La función strtotime($fechax); lo que hace es pasar un formato de fecha inglés a fecha unix que es expesada en segundos-
		// Al ser segundos los podemos comprar con un if y obtener resultado.
	}
 ?>
