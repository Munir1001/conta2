<?php 

    function NumeroCuotasCanceladadClientes($conectarsistema,$IdUsuarios){
		$resultado=mysqli_query($conectarsistema,"CALL ConteoCuotasCanceladasClientes('".$IdUsuarios."');");
		if(mysqli_num_rows($resultado)>0){
			$ImpresionConteo=mysqli_num_rows($resultado);	
			return $ImpresionConteo;
		}else{
			$ImpresionConteo = 0;
		}
	}
