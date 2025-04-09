<?php
class conexion
{
	private $servidor = "localhost"; // NOMBRE SERVIDOR
	private $usuario = "root"; // USUARIO SERVIDOR
	private $clave = ""; // CONTRASEÑA SERVIDOR (SI LO REQUIERE)
	private $base = "cashmanha"; // NOMBRE DE BASE DE DATOS
	public $establecerconexion; // VARIABLE PUBLICA DE CONEXION*/
	// DATOS DE CONECTIVIDAD BD -> SISTEMA
	public function setServidor($obteniendoservidor)
	{
		$this->servidor = $obteniendoservidor;
	}
	public function getServidor()
	{
		return $this->servidor;
	}

	// CONECTAR SISTEMA Y COMPROBACION DE CONEXION
	public function conectar($bd)
	{
		$miconexion = new mysqli($this->servidor, $this->usuario, $this->clave, $bd);
		if ($miconexion->connect_errno) {
			/*echo*/
			$mensaje = "Lo sentimos, ha ocurrido un error de conexion" . $miconexion->connect_error;
		} else {
			/*echo*/
			$mensaje = "Enhorabuena, conexion exitosa";
			$this->establecerconexion = $miconexion;
		}
		return $mensaje;
	}
	// INICIO DE SESION -> TODOS LOS USUARIOS
	public function IniciarSesionUsuarios($conectarsistema, $usuario, $contrasenia) {
		// Preparar la consulta (usando ? como marcadores de posición)
		$stmt = $conectarsistema->prepare("CALL IniciarSesion(?, ?)");
		
		if (!$stmt) {
			die("Error al preparar la consulta: " . $conectarsistema->error);
		}
		
		// Vincular parámetros (s = string)
		$stmt->bind_param("ss", $usuario, $contrasenia);
		
		// Ejecutar la consulta
		$stmt->execute();
		
		// Obtener resultados (si el procedimiento almacenado devuelve datos)
		$resultado = $stmt->get_result();
		
		// Cerrar el statement
		$stmt->close();
		
		return $resultado;
	}
} // CIERRE CLASE CONEXION

// CONECTAR SISTEMA CON BASE DE DATOS {CONEXION PRINCIPAL TODO EL SISTEMA}
$conectando = new conexion();
$conectando->conectar("cashmanha");
$conectarsistema = $conectando->establecerconexion;
/*
	-> CONEXIONES AUXILIARES -> GESTIONES ESPECIFICAS InversGlobal
	DISPONIBLES EN MULTIPLES CONSULTAS REALIZADAS EN UNA SOLA PAGINA
*/
$conectando = new conexion();
$conectando->conectar("cashmanha");
$conectarsistema1 = $conectando->establecerconexion;
$conectando = new conexion();
$conectando->conectar("cashmanha");
$conectarsistema2 = $conectando->establecerconexion;
$conectando = new conexion();
$conectando->conectar("cashmanha");
$conectarsistema3 = $conectando->establecerconexion;
$conectando = new conexion();
$conectando->conectar("cashmanha");
$conectarsistema4 = $conectando->establecerconexion;
$conectando = new conexion();
$conectando->conectar("cashmanha");
$conectarsistema5 = $conectando->establecerconexion;
$conectando = new conexion();
$conectando->conectar("cashmanha");
$conectarsistema6 = $conectando->establecerconexion;
$conectando = new conexion();
$conectando->conectar("cashmanha");
$conectarsistema7 = $conectando->establecerconexion;
