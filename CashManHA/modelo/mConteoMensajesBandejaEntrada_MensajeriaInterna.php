<?php

function NumeroMensajesRecibidosUsuarios($conectarsistema, $IdUsuarios)
{
	$resultado = mysqli_query($conectarsistema, "CALL ConsultaMensajesBandejaEntradaUsuariosCashmanHa('" . $IdUsuarios . "');");
	if (mysqli_num_rows($resultado) > 0) {
		$ImpresionConteo = mysqli_num_rows($resultado);
		return $ImpresionConteo;
	} else {
		return 0;
	}
}
