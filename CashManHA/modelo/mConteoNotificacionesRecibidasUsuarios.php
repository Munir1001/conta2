<?php

function NumeroNotificacionesRecibidasUsuarios($conectarsistema, $IdUsuarios)
{
	$resultado = mysqli_query($conectarsistema, "CALL ConsultaNotificacionesRecortada_BarraHerramientasPlataforma('" . $IdUsuarios . "');");
	if (mysqli_num_rows($resultado) > 0) {
		$ImpresionConteo = mysqli_num_rows($resultado);
		return $ImpresionConteo;
	} else {
		return 0;
	}
}
