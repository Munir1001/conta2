<?php
/*
    IMPORTANTE: LOS ROLES DE USUARIOS SE CLASIFICAN POR SU ID NUMERICO ENTERO
    -----------------------------------------------
    [ 1 ] -> USUARIOS ADMINISTRADORES
    [ 2 ] -> USUARIOS PRESIDENCIA
    [ 3 ] -> USUARIOS GERENCIA
    [ 4 ] -> USUARIOS ATENCION AL CLIENTE
    [ 5 ] -> USUARIOS CLIENTES
    ----------------------------------------------
    SE PUEDEN REGISTRAR MAS ROLES SEGUN NECESIDADES PERO SE DEBEN REALIZAR LAS RESPECTIVAS ADECUACIONES
*/
class GestionesClientes
{
    // Propiedades privadas para todos los datos
    private $conexion;

    // Configuración de cuenta de usuarios
    private $IdUsuarios;
    private $NombresUsuarios;
    private $ApellidosUsuarios;
    private $CodigoUsuarios;
    private $CorreoUsuarios;
    private $IdRolUsuarios;
    private $FotoUsuarios;
    private $EstadoUsuarios;

    // Detalles de usuarios
    private $duiUsuarios;
    private $NitUsuarios;
    private $TelefonoUsuarios;
    private $CelularUsuarios;
    private $TelefonoTrabajoUsuarios;
    private $DireccionUsuarios;
    private $EmpresaUsuarios;
    private $CargoEmpresaUsuarios;
    private $DireccionTrabajoUsuarios;
    private $FechaNacimientoUsuarios;
    private $GeneroUsuarios;
    private $EstadoCivilUsuarios;
    private $FotoduiFrontalUsuarios;
    private $FotoduiReversoUsuarios;

    private $FotoNitUsuarios;
    private $FotoFirmaUsuarios;

    // Roles de usuarios
    private $NombreRolUsuario;
    private $DescripcionRolUsuario;

    // Productos
    private $IdProductos;
    private $CodigoProductos;
    private $NombreProductos;
    private $DescripcionProductos;
    private $RequisitosProductos;
    private $EstadoProductos;

    // Créditos
    private $IdCreditos;
    private $IdCreditosAuxiliar;
    private $TipoClienteCreditos;
    private $MontoFinanciamientoCreditos;
    private $TasaInteresCreditos;
    private $TiempoPlazoCreditos;
    private $CuotaMensualCreditos;
    private $FechaIngresoSolicitudCreditos;
    private $SalarioClienteCreditos;
    private $SaldoActualCreditos;
    private $EstadoActualCreditos;
    private $ObservacionesEmpleadosCreditos;
    private $ObservacionesGerenciaCreditos;
    private $ObservacionesPresidenciaCreditos;
    private $EmpleadoRegistroCredito;
    private $ProgresoInicialSolicitudCreditos;
    private $ProgresoPagoCreditos;
    private $ComprobarEstadoCuotasMensuales;
    private $EstadoCrediticioClientes;
    private $Comprobacion_ProcesoFinalizadoClientes;
    private $Comprobacion_EnviarAlHistoricoClientes;
    private $Comprobacion_HabilitarNuevasSolicitudesCrediticias;
    private $TipoAmortizacion;
    private $TipoPago;

    // Referencias personales/laborales
    private $IdReferenciasClientes;
    private $NombresReferenciaPersonal;
    private $ApellidosReferenciaPersonal;
    private $EmpresaReferenciaPersonal;
    private $ProfesionOficioReferenciaPersonal;
    private $TelefonoReferenciaPersonal;
    private $NombresReferenciaLaboral;
    private $ApellidosReferenciaLaboral;
    private $EmpresaReferenciaLaboral;
    private $ProfesionOficioReferenciaLaboral;
    private $TelefonoReferenciaLaboral;

    // Vehículos
    private $IdDatosVehiculos;
    private $NumeroPlaca;
    private $ClaseVehiculo;
    private $AnioVehiculo;
    private $CapacidadVehiculo;
    private $NumeroAsientosVehiculo;
    private $MarcaVehiculo;
    private $ModeloVehiculo;
    private $NumeroMotor;
    private $NumeroChasisGrabado;
    private $NumeroChasisVin;
    private $ColorVehiculo;

    // Cuotas
    private $IdCuotasClientes;
    private $IdCuotasClientesHistorico;
    private $MontoCuotaCancelar;
    private $EstadoCuotaClientes;
    private $MontoCapitalClientes;
    private $FechaVencimientoCuotasClientes;
    private $ComprobarIncumplimientoCuotasClientes;
    private $DiasIncumplimientoCuotasClientes;

    // Reportes
    private $IdReportePlataforma;
    private $NombreReportePlataforma;
    private $DescripcionReportePlataforma;
    private $FotoReportePlataforma;
    private $FechaRegistroReportePlataforma;
    private $FechaActualizacionReportePlataforma;
    private $EstadoReportePlataforma;
    private $ComentarioActualizacionReportePlataforma;
    private $EmpleadoGestionandoReportePlataforma;

    // Transacciones
    private $IdTransaccionCreditosClientes;
    private $ReferenciaTransaccionCreditosClientes;
    private $MontoTransaccionCreditosClientes;
    private $FechaTransaccionCreditosClientes;
    private $EmpleadoGestionTransaccionCreditosClientes;

    // Mensajería
    private $IdMensajeria;
    private $IdUsuarioDestinatarioMensajeria;
    private $NombreMensajeria;
    private $AsuntoMensajeria;
    private $DetalleMensajeria;
    private $FechaMensajeria;

    // Estadísticas
    private $NumeroUsuariosRegistrados;
    private $NumeroProductosRegistrados;
    private $NumeroReportesFallosPlataformaRegistrados;
    private $NumeroSolicitudesRecuperacionesRegistrados;
    private $NumeroCuotasClientesRegistradas;
    private $NumeroTransaccionesClientesRegistradas;
    private $NumeroCuentasAhorroClientesRegistradas;
    private $NumeroCuotasPagadasTarde;
    private $NumeroCuotasPagadasCanceladas;
    private $NumeroTransferenciasProcesadas;
    private $NumeroCuotasVencidas;

    // Históricos
    private $IdCreditoHistoricoClientes;
    private $EstadoCreditoHistoricoClientes;

    // Cuentas de ahorro
    private $IdCuentaAhorroClientes;
    private $NumeroCuentaAhorroClientes;
    private $SaldoCuentaAhorroClientes;
    private $EstadoCuentaAhorroClientes;
    private $FechaAperturaCuentaAhorroClientes;

    // Transferencias
    private $IdTransaccionesDepositosRetirosCuentasTransferencias;
    private $NumeroCuentaAhorroClientesTransferencias;
    private $NombresClienteCuentaAhorroClientesTransferencias;
    private $ApellidosClienteCuentaAhorroClientesTransferencias;
    private $IdCuentaAhorroTransferenciaDestinoClientes;
    // Transacciones cuentas
    private $IdTransaccionesDepositosRetirosCuentas;
    private $UltimoIdTransaccionesDepositosRetirosCuentas;
    private $ReferenciaTransaccionDepositosRetirosCuentas;
    private $MontoDepositosRetirosCuentas;
    private $FechaTransaccionDepositosRetirosCuentas;
    private $EmpleadoGestionTransaccionDepositosRetirosCuentas;
    private $TipoTransaccionDepositosRetirosCuentas;
    private $SaldoNuevoTransaccionDepositosRetirosCuentas;
    private $EstadoTransaccionDepositosRetirosCuentas;

    // Totales
    private $TotalCuotasCanceladasCreditosClientes;
    private $TotalTransaccionesProcesadas_AtencionClientes;
    private $TotalSolicitudesCreditosProcesadas_AtencionClientes;
    private $TotalIngresosTransaccionesCreditos_AtencionClientes;

    // Contratos
    private $NombreCopiaContratosSuscritosCreditosClientes;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($conexion)
    {
        $this->conexion = $conexion;

        // Verificar la conexión
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    // FUNCIONES PARA OBTENER DATOS DE USUARIOS
    /*
            << MI PERFIL >>
            -> CONFIGURACION DE LA CUENTA USUARIOS
        */
    // ID UNICO USUARIOS
    public function setIdUsuarios($valor)
    {
        if (is_numeric($valor)) {
            $this->IdUsuarios = (int)$valor;
        }
    }

    public function getIdUsuarios()
    {
        return $this->IdUsuarios;
    }
    // NOMBRES USUARIOS
    public function setNombresUsuarios($valor_retorno)
    {
        $this->NombresUsuarios = $valor_retorno;
    }
    public function getNombresUsuarios()
    {
        return $this->NombresUsuarios;
    }
    // APELLIDOS USUARIOS
    public function setApellidosUsuarios($valor_retorno)
    {
        $this->ApellidosUsuarios = $valor_retorno;
    }
    public function getApellidosUsuarios()
    {
        return $this->ApellidosUsuarios;
    }
    // CODIGO USUARIOS
    public function setCodigoUsuarios($valor_retorno)
    {
        $this->CodigoUsuarios = $valor_retorno;
    }
    public function getCodigoUsuarios()
    {
        return $this->CodigoUsuarios;
    }
    // CORREO USUARIOS
    public function setCorreoUsuarios($valor_retorno)
    {
        $this->CorreoUsuarios = $valor_retorno;
    }
    public function getCorreoUsuarios()
    {
        return $this->CorreoUsuarios;
    }
    // FOTO USUARIOS
    public function setFotoUsuarios($valor_retorno)
    {
        $this->FotoUsuarios = $valor_retorno;
    }
    public function getFotoUsuarios()
    {
        return $this->FotoUsuarios;
    }
    // ID ROL USUARIOS
    public function setIdRolUsuarios($valor_retorno)
    {
        $this->IdRolUsuarios = $valor_retorno;
    }
    public function getIdRolUsuarios()
    {
        return $this->IdRolUsuarios;
    }
    // ESTADO USUARIOS
    public function setEstadoUsuarios($valor_retorno)
    {
        $this->EstadoUsuarios = $valor_retorno;
    }
    public function getEstadoUsuarios()
    {
        return $this->EstadoUsuarios;
    }
    /*
            << MI PERFIL >>
            -> DETALLES DE USUARIOS
        */
    // dui USUARIOS
    public function setduiUsuarios($valor_retorno)
    {
        $this->duiUsuarios = $valor_retorno;
    }
    public function getduiUsuarios()
    {
        return $this->duiUsuarios;
    }
    // NIT USUARIOS
    public function setNitUsuarios($valor_retorno)
    {
        $this->NitUsuarios = $valor_retorno;
    }
    public function getNitUsuarios()
    {
        return $this->NitUsuarios;
    }
    // TELEFONO USUARIOS
    public function setTelefonoUsuarios($valor_retorno)
    {
        $this->TelefonoUsuarios = $valor_retorno;
    }
    public function getTelefonoUsuarios()
    {
        return $this->TelefonoUsuarios;
    }
    // CELULAR USUARIOS
    public function setCelularUsuarios($valor_retorno)
    {
        $this->CelularUsuarios = $valor_retorno;
    }
    public function getCelularUsuarios()
    {
        return $this->CelularUsuarios;
    }
    // TELEFONO TRABAJO USUARIOS
    public function setTelefonoTrabajoUsuarios($valor_retorno)
    {
        $this->TelefonoTrabajoUsuarios = $valor_retorno;
    }
    public function getTelefonoTrabajoUsuarios()
    {
        return $this->TelefonoTrabajoUsuarios;
    }
    // DIRECCION USUARIOS
    public function setDireccionUsuarios($valor_retorno)
    {
        $this->DireccionUsuarios = $valor_retorno;
    }
    public function getDireccionUsuarios()
    {
        return $this->DireccionUsuarios;
    }
    // EMPRESA USUARIOS
    public function setEmpresaUsuarios($valor_retorno)
    {
        $this->EmpresaUsuarios = $valor_retorno;
    }
    public function getEmpresaUsuarios()
    {
        return $this->EmpresaUsuarios;
    }
    // CARGO DESEMPEÑADO EMPRESA USUARIOS
    public function setCargoEmpresaUsuarios($valor_retorno)
    {
        $this->CargoEmpresaUsuarios = $valor_retorno;
    }
    public function getCargoEmpresaUsuarios()
    {
        return $this->CargoEmpresaUsuarios;
    }
    // DIRECCION TRABAJO USUARIOS
    public function setDireccionTrabajoUsuarios($valor_retorno)
    {
        $this->DireccionTrabajoUsuarios = $valor_retorno;
    }
    public function getDireccionTrabajoUsuarios()
    {
        return $this->DireccionTrabajoUsuarios;
    }
    // FECHA DE NACIMIENTO USUARIOS
    public function setFechaNacimientoUsuarios($valor_retorno)
    {
        $this->FechaNacimientoUsuarios = $valor_retorno;
    }
    public function getFechaNacimientoUsuarios()
    {
        return $this->FechaNacimientoUsuarios;
    }
    // GENERO USUARIOS
    public function setGeneroUsuarios($valor_retorno)
    {
        $this->GeneroUsuarios = $valor_retorno;
    }
    public function getGeneroUsuarios()
    {
        return $this->GeneroUsuarios;
    }
    // GENERO USUARIOS
    public function setEstadoCivilUsuarios($valor_retorno)
    {
        $this->EstadoCivilUsuarios = $valor_retorno;
    }
    public function getEstadoCivilUsuarios()
    {
        return $this->EstadoCivilUsuarios;
    }
    // FOTO dui USUARIOS - FRONTAL
    public function setFotoduiFrontalUsuarios($valor_retorno)
    {
        $this->FotoduiFrontalUsuarios = $valor_retorno;
    }
    public function getFotoduiFrontalUsuarios()
    {
        return $this->FotoduiFrontalUsuarios;
    }
    // FOTO dui USUARIOS - REVERSO
    public function setFotoduiReversoUsuarios($valor_retorno)
    {
        $this->FotoduiReversoUsuarios = $valor_retorno;
    }

    public function getFotoduiReversoUsuarios()
    {
        return $this->FotoduiReversoUsuarios;
    }
    // FOTO NIT USUARIOS
    public function setFotoNitUsuarios($valor_retorno)
    {
        $this->FotoNitUsuarios = $valor_retorno;
    }
    public function getFotoNitUsuarios()
    {
        return $this->FotoNitUsuarios;
    }
    // FOTO FIRMA USUARIOS
    public function setFotoFirmaUsuarios($valor_retorno)
    {
        $this->FotoFirmaUsuarios = $valor_retorno;
    }
    public function getFotoFirmaUsuarios()
    {
        return $this->FotoFirmaUsuarios;
    }
    /*
            << ROLES DE USUARIOS CASHMAN HA >>
            -> CONSULTA GENERAL DE ROLES DE USUARIOS REGISTRADOS
        */
    // NOMBRE GENERAL ROL DE USUARIO
    public function setNombreRolUsuario($valor_retorno)
    {
        $this->NombreRolUsuario = $valor_retorno;
    }
    public function getNombreRolUsuario()
    {
        return $this->NombreRolUsuario;
    }
    // DESCRIPCION COMPLETA ROL DE USUARIO
    public function setDescripcionRolUsuario($valor_retorno)
    {
        $this->DescripcionRolUsuario = $valor_retorno;
    }
    public function getDescripcionRolUsuario()
    {
        return $this->DescripcionRolUsuario;
    }
    /*
            << PRODUCTOS CASHMAN HA >>
            -> CONSULTA GENERAL DE PRODUCTOS REGISTRADOS [SIN ASOCIACION A CLIENTES]
        */
    // ID UNICO REFERENCIA DE PRODUCTOS
    public function setIdProductos($valor_retorno)
    {
        $this->IdProductos = $valor_retorno;
    }
    public function getIdProductos()
    {
        return $this->IdProductos;
    }
    // CODIGO UNICO DE PRODUCTOS
    public function setCodigoProductos($valor_retorno)
    {
        $this->CodigoProductos = $valor_retorno;
    }
    public function getCodigoProductos()
    {
        return $this->CodigoProductos;
    }
    // NOMBRE DE PRODUCTOS
    public function setNombreProductos($valor_retorno)
    {
        $this->NombreProductos = $valor_retorno;
    }
    public function getNombreProductos()
    {
        return $this->NombreProductos;
    }
    // DESCRIPCION DE PRODUCTOS
    public function setDescripcionProductos($valor_retorno)
    {
        $this->DescripcionProductos = $valor_retorno;
    }
    public function getDescripcionProductos()
    {
        return $this->DescripcionProductos;
    }
    // REQUISITOS DE PRODUCTOS
    public function setRequisitosProductos($valor_retorno)
    {
        $this->RequisitosProductos = $valor_retorno;
    }
    public function getRequisitosProductos()
    {
        return $this->RequisitosProductos;
    }
    // ESTADO DE PRODUCTOS
    public function setEstadoProductos($valor_retorno)
    {
        $this->EstadoProductos = $valor_retorno;
    }
    public function getEstadoProductos()
    {
        return $this->EstadoProductos;
    }
    /*
            << CREDITOS CASHMAN HA >>
            -> CONSULTA UNICAMENTE DE ID UNICO DE CREDITO SOLICITADO POR CLIENTES
            ESTA CONSULTA ES AUXILIAR UNICAMENTE UTILIZADA EN LA SECCION DE INGRESO DE REFERENCIAS PERSONALES - LABORALES DE LOS CLIENTES
        */
    // ID UNICO DE REFERENCIAS REGISTRADAS CLIENTES
    public function setIdReferenciasClientes($valor_retorno)
    {
        $this->IdReferenciasClientes = $valor_retorno;
    }
    public function getIdReferenciasClientes()
    {
        return $this->IdReferenciasClientes;
    }
    /*
            << CREDITOS CASHMAN HA >>
            -> CONSULTA COMPLETA DE SOLICITUDES NUEVAS INGRESADAS SEGUN ID DE CLIENTES [NO AUXILIAR]
        */
    // ID UNICO DE CREDITO SOLICITADO [REGISTRADO]
    public function setIdCreditos($valor_retorno)
    {
        $this->IdCreditos = $valor_retorno;
    }
    public function getIdCreditos()
    {
        return $this->IdCreditos;
    }
    // TIPO DE CLIENTE CREDITOS
    public function setTipoClienteCreditos($valor_retorno)
    {
        $this->TipoClienteCreditos = $valor_retorno;
    }
    public function getTipoClienteCreditos()
    {
        return $this->TipoClienteCreditos;
    }
    // MONTO FINANCIAMIENTO CREDITOS
    public function setMontoFinanciamientoCreditos($valor_retorno)
    {
        $this->MontoFinanciamientoCreditos = $valor_retorno;
    }
    public function getMontoFinanciamientoCreditos()
    {
        return $this->MontoFinanciamientoCreditos;
    }


    public function setTipoAmortizacion($valor_retorno)
    {
        $this->TipoAmortizacion = $valor_retorno;
    }

    public function getTipoAmortizacion()
    {
        return $this->TipoAmortizacion;
    }

    public function setTipoPago($valor_retorno)
    {
        $this->TipoPago = $valor_retorno;
    }

    public function getTipoPago()
    {
        return $this->TipoPago;
    }



    // TASA DE INTERES CREDITOS
    public function setTasaInteresCreditos($valor_retorno)
    {
        $this->TasaInteresCreditos = $valor_retorno;
    }
    public function getTasaInteresCreditos()
    {
        return $this->TasaInteresCreditos;
    }
    // PLAZO FINANCIAMIENTO CREDITOS
    public function setTiempoPlazoCreditos($valor_retorno)
    {
        $this->TiempoPlazoCreditos = $valor_retorno;
    }
    public function getTiempoPlazoCreditos()
    {
        return $this->TiempoPlazoCreditos;
    }
    // CUOTA MENSUAL ASIGNADA CREDITOS
    public function setCuotaMensualCreditos($valor_retorno)
    {
        $this->CuotaMensualCreditos = $valor_retorno;
    }
    public function getCuotaMensualCreditos()
    {
        return $this->CuotaMensualCreditos;
    }

    // FECHA INGRESO SOLICITUD CREDITOS
    public function setFechaIngresoSolicitudCreditos($valor_retorno)
    {
        $this->FechaIngresoSolicitudCreditos = $valor_retorno;
    }
    public function getFechaIngresoSolicitudCreditos()
    {
        return $this->FechaIngresoSolicitudCreditos;
    }
    // SALARIO CLIENTE CREDITOS
    public function setSalarioClienteCreditos($valor_retorno)
    {
        $this->SalarioClienteCreditos = $valor_retorno;
    }
    public function getSalarioClienteCreditos()
    {
        return $this->SalarioClienteCreditos;
    }
    // SALDO ACTUAL CLIENTE CREDITOS
    public function setSaldoActualCreditos($valor_retorno)
    {
        $this->SaldoActualCreditos = $valor_retorno;
    }
    public function getSaldoActualCreditos()
    {
        return $this->SaldoActualCreditos;
    }
    // ESTADO ACTUAL CLIENTE CREDITOS
    public function setEstadoActualCreditos($valor_retorno)
    {
        $this->EstadoActualCreditos = $valor_retorno;
    }
    public function getEstadoActualCreditos()
    {
        return $this->EstadoActualCreditos;
    }
    // OBSERVACIONES REGISTRADAS POR EMPLEADOS CREDITOS
    public function setObservacionesEmpleadosCreditos($valor_retorno)
    {
        $this->ObservacionesEmpleadosCreditos = $valor_retorno;
    }
    public function getObservacionesEmpleadosCreditos()
    {
        return $this->ObservacionesEmpleadosCreditos;
    }
    // OBSERVACIONES REGISTRADAS POR GERENCIA CREDITOS
    public function setObservacionesGerenciaCreditos($valor_retorno)
    {
        $this->ObservacionesGerenciaCreditos = $valor_retorno;
    }
    public function getObservacionesGerenciaCreditos()
    {
        return $this->ObservacionesGerenciaCreditos;
    }
    // OBSERVACIONES REGISTRADAS POR PRESIDENCIA CREDITOS
    public function setObservacionesPresidenciaCreditos($valor_retorno)
    {
        $this->ObservacionesPresidenciaCreditos = $valor_retorno;
    }
    public function getObservacionesPresidenciaCreditos()
    {
        return $this->ObservacionesPresidenciaCreditos;
    }
    // EMPLEADO QUE REGISTRO SOLICITUD DE NUEVOS CREDITOS
    public function setEmpleadoRegistroCredito($valor_retorno)
    {
        $this->EmpleadoRegistroCredito = $valor_retorno;
    }
    public function getEmpleadoRegistroCredito()
    {
        return $this->EmpleadoRegistroCredito;
    }
    // PROGRESO INICIAL SOLICITUD CREDITO CLIENTES
    public function setProgresoInicialSolicitudCreditos($valor_retorno)
    {
        $this->ProgresoInicialSolicitudCreditos = $valor_retorno;
    }
    public function getProgresoInicialSolicitudCreditos()
    {
        return $this->ProgresoInicialSolicitudCreditos;
    }
    // PROGRESO ACTUAL PAGO CREDITO CLIENTES
    public function setProgresoPagoCreditos($valor_retorno)
    {
        $this->ProgresoPagoCreditos = $valor_retorno;
    }
    public function getProgresoPagoCreditos()
    {
        return $this->ProgresoPagoCreditos;
    }
    // COMPROBACION ESTADO CUOTAS MENSUALES -> SI LOS EMPLEADOS YA HAN GENERADO O NO LAS RESPECTIVAS CUOTAS MENSUALES DENTRO DEL ESTADO DE CUENTA INICIAL CLIENTES
    public function setComprobarEstadoCuotasMensuales($valor_retorno)
    {
        $this->ComprobarEstadoCuotasMensuales = $valor_retorno;
    }
    public function getComprobarEstadoCuotasMensuales()
    {
        return $this->ComprobarEstadoCuotasMensuales;
    }
    // ESTADO CREDITICIO DE CLIENTES
    public function setEstadoCrediticioClientes($valor_retorno)
    {
        $this->EstadoCrediticioClientes = $valor_retorno;
    }
    public function getEstadoCrediticioClientes()
    {
        return $this->EstadoCrediticioClientes;
    }
    // COMPROBACION PROCESO FINALIZADO DE CLIENTES -> NUEVAS SOLICITUDES CREDITICIAS
    public function setComprobacion_ProcesoFinalizadoClientes($valor_retorno)
    {
        $this->Comprobacion_ProcesoFinalizadoClientes = $valor_retorno;
    }
    public function getComprobacion_ProcesoFinalizadoClientes()
    {
        return $this->Comprobacion_ProcesoFinalizadoClientes;
    }
    // COMPROBACION PROCESO FINALIZADO DE CLIENTES -> DISPONIBILIDAD DE ENVIO CUOTAS Y SOLICITUD CREDITICIA AL HISTORICO [CONDICION-> ESTADO DE CREDITO CANCELADO]
    public function setComprobacion_EnviarAlHistoricoClientes($valor_retorno)
    {
        $this->Comprobacion_EnviarAlHistoricoClientes = $valor_retorno;
    }
    public function getComprobacion_EnviarAlHistoricoClientes()
    {
        return $this->Comprobacion_EnviarAlHistoricoClientes;
    }
    // COMPROBACION PROCESO FINALIZADO DE CLIENTES -> HABILITAR NUEVAMENTE SOLICITUDES CREDITICIAS A CLIENTES QUE TUVIERON SOLICITUD DE CREDITOS ACTIVAS Y HA SIDO CANCELADA [CASO CONTRARIO NO PROCEDE LA HABILITACION DE NUEVOS CREDITOS]
    public function setComprobacion_HabilitarNuevasSolicitudesCrediticias($valor_retorno)
    {
        $this->Comprobacion_HabilitarNuevasSolicitudesCrediticias = $valor_retorno;
    }
    public function getComprobacion_HabilitarNuevasSolicitudesCrediticias()
    {
        return $this->Comprobacion_HabilitarNuevasSolicitudesCrediticias;
    }
    /*
            << REFERENCIAS PERSONALES - LABORALES CREDITOS CASHMAN HA >>
            -> CONSULTA DE EXISTENCIAS REGISTRO DE REFERENCIAS LABORALES Y PERSONALES, PARA POSTERIOR TRATAMIENTO DENTRO DEL SISTEMA
        */
    // NOMBRES DE REFERENCIAS PERSONALES
    public function setNombresReferenciaPersonal($valor_retorno)
    {
        $this->NombresReferenciaPersonal = $valor_retorno;
    }
    public function getNombresReferenciaPersonal()
    {
        return $this->NombresReferenciaPersonal;
    }
    // APELLIDOS DE REFERENCIAS PERSONALES
    public function setApellidosReferenciaPersonal($valor_retorno)
    {
        $this->ApellidosReferenciaPersonal = $valor_retorno;
    }
    public function getApellidosReferenciaPersonal()
    {
        return $this->ApellidosReferenciaPersonal;
    }
    // EMPRESA DE REFERENCIAS PERSONALES
    public function setEmpresaReferenciaPersonal($valor_retorno)
    {
        $this->EmpresaReferenciaPersonal = $valor_retorno;
    }
    public function getEmpresaReferenciaPersonal()
    {
        return $this->EmpresaReferenciaPersonal;
    }
    // PROFESION U OFICIO DE REFERENCIAS PERSONALES
    public function setProfesionOficioReferenciaPersonal($valor_retorno)
    {
        $this->ProfesionOficioReferenciaPersonal = $valor_retorno;
    }
    public function getProfesionOficioReferenciaPersonal()
    {
        return $this->ProfesionOficioReferenciaPersonal;
    }
    // TELEFONO DE REFERENCIAS PERSONALES
    public function setTelefonoReferenciaPersonal($valor_retorno)
    {
        $this->TelefonoReferenciaPersonal = $valor_retorno;
    }
    public function getTelefonoReferenciaPersonal()
    {
        return $this->TelefonoReferenciaPersonal;
    }
    // NOMBRES DE REFERENCIAS LABORALES
    public function setNombresReferenciaLaboral($valor_retorno)
    {
        $this->NombresReferenciaLaboral = $valor_retorno;
    }
    public function getNombresReferenciaLaboral()
    {
        return $this->NombresReferenciaLaboral;
    }
    // APELLIDOS DE REFERENCIAS LABORALES
    public function setApellidosReferenciaLaboral($valor_retorno)
    {
        $this->ApellidosReferenciaLaboral = $valor_retorno;
    }
    public function getApellidosReferenciaLaboral()
    {
        return $this->ApellidosReferenciaLaboral;
    }
    // EMPRESA DE REFERENCIAS LABORALES
    public function setEmpresaReferenciaLaboral($valor_retorno)
    {
        $this->EmpresaReferenciaLaboral = $valor_retorno;
    }
    public function getEmpresaReferenciaLaboral()
    {
        return $this->EmpresaReferenciaLaboral;
    }
    // PROFESION U OFICIO DE REFERENCIAS LABORALES
    public function setProfesionOficioReferenciaLaboral($valor_retorno)
    {
        $this->ProfesionOficioReferenciaLaboral = $valor_retorno;
    }
    public function getProfesionOficioReferenciaLaboral()
    {
        return $this->ProfesionOficioReferenciaLaboral;
    }
    // TELEFONO DE REFERENCIAS LABORALES
    public function setTelefonoReferenciaLaboral($valor_retorno)
    {
        $this->TelefonoReferenciaLaboral = $valor_retorno;
    }
    public function getTelefonoReferenciaLaboral()
    {
        return $this->TelefonoReferenciaLaboral;
    }
    /*
            << REFERENCIAS PERSONALES -> LABORALES CASHMAN HA >>
            -> CONSULTA GENERAL DE REFERENCIAS REGISTRADAS DE CLIENTES
        */
    // ID UNICO DE REFERENCIAS
    public function setIdCreditoAuxiliar($valor_retorno)
    {
        $this->IdCreditosAuxiliar = $valor_retorno;
    }
    public function getIdCreditoAuxiliar()
    {
        return $this->IdCreditosAuxiliar;
    }
    /*
            << CONSULTA DE DATOS DE VEHICULOS -> PRESTAMOS DE VEHICULOS APROBADOS  >>
            -> VALIDO PARA USO DE DATOS CONTRATOS Y PORTAL DE CLIENTES
        */
    // ID UNICO DE REGISTRO DATOS CREDITICIOS ASOCIADOS A PRODUCTO EN CUESTION
    public function setIdDatosVehiculos($valor_retorno)
    {
        $this->IdDatosVehiculos = $valor_retorno;
    }
    public function getIdDatosVehiculos()
    {
        return $this->IdDatosVehiculos;
    }
    // NUMERO DE PLACA VEHICULOS
    public function setNumeroPlaca($valor_retorno)
    {
        $this->NumeroPlaca = $valor_retorno;
    }
    public function getNumeroPlaca()
    {
        return $this->NumeroPlaca;
    }
    // CLASE DE VEHICULOS
    public function setClaseVehiculo($valor_retorno)
    {
        $this->ClaseVehiculo = $valor_retorno;
    }
    public function getClaseVehiculo()
    {
        return $this->ClaseVehiculo;
    }
    // AÑO DE VEHICULOS
    public function setAnioVehiculo($valor_retorno)
    {
        $this->AnioVehiculo = $valor_retorno;
    }
    public function getAnioVehiculo()
    {
        return $this->AnioVehiculo;
    }
    // CAPACIDAD DE VEHICULOS
    public function setCapacidadVehiculo($valor_retorno)
    {
        $this->CapacidadVehiculo = $valor_retorno;
    }
    public function getCapacidadVehiculo()
    {
        return $this->CapacidadVehiculo;
    }
    // NUMERO DE ASIENTOS DE VEHICULOS
    public function setNumeroAsientosVehiculo($valor_retorno)
    {
        $this->NumeroAsientosVehiculo = $valor_retorno;
    }
    public function getNumeroAsientosVehiculo()
    {
        return $this->NumeroAsientosVehiculo;
    }
    // MARCA DE VEHICULOS
    public function setMarcaVehiculo($valor_retorno)
    {
        $this->MarcaVehiculo = $valor_retorno;
    }
    public function getMarcaVehiculo()
    {
        return $this->MarcaVehiculo;
    }
    // MODELO DE VEHICULOS
    public function setModeloVehiculo($valor_retorno)
    {
        $this->ModeloVehiculo = $valor_retorno;
    }
    public function getModeloVehiculo()
    {
        return $this->ModeloVehiculo;
    }
    // NUMERO DE MOTOR DE VEHICULOS
    public function setNumeroMotor($valor_retorno)
    {
        $this->NumeroMotor = $valor_retorno;
    }
    public function getNumeroMotor()
    {
        return $this->NumeroMotor;
    }
    // NUMERO DE CHASIS GRABADO DE VEHICULOS
    public function setNumeroChasisGrabado($valor_retorno)
    {
        $this->NumeroChasisGrabado = $valor_retorno;
    }
    public function getNumeroChasisGrabado()
    {
        return $this->NumeroChasisGrabado;
    }
    // NUMERO DE CHASIS VIN DE VEHICULOS
    public function setNumeroChasisVin($valor_retorno)
    {
        $this->NumeroChasisVin = $valor_retorno;
    }
    public function getNumeroChasisVin()
    {
        return $this->NumeroChasisVin;
    }
    // COLOR DE VEHICULOS
    public function setColorVehiculo($valor_retorno)
    {
        $this->ColorVehiculo = $valor_retorno;
    }
    public function getColorVehiculo()
    {
        return $this->ColorVehiculo;
    }
    /*
            << CONSULTA DE DATOS CUOTAS GENERADAS CLIENTES  >>
                -> VALIDO PARA PORTAL DE CLIENTES, Y DEMAS PORTALES ESPECIFICOS DONDE SE REQUIERA DICHA CONSULTA
        */
    // ID UNICO DE ORDEN DE PAGO CUOTAS CLIENTES -> ASOCIADOS A PRODUCTO -> CREDITO
    public function setIdCuotasClientes($valor_retorno)
    {
        $this->IdCuotasClientes = $valor_retorno;
    }
    public function getIdCuotasClientes()
    {
        return $this->IdCuotasClientes;
    }
    // ID DE TRANSACCIONES CREDITOS HISTORICOS -> VISUALIZAR COMPROBANTE DE PAGO
    public function setIdCuotasClientesHistorico($valor_retorno)
    {
        $this->IdCuotasClientesHistorico = $valor_retorno;
    }
    public function getIdCuotasClientesHistorico()
    {
        return $this->IdCuotasClientesHistorico;
    }
    // MONTO A CANCELAR ASIGNADO A CLIENTES -> CUOTAS MENSUALES GENERADAS
    public function setMontoCuotaCancelar($valor_retorno)
    {
        $this->MontoCuotaCancelar = $valor_retorno;
    }
    public function getMontoCuotaCancelar()
    {
        return $this->MontoCuotaCancelar;
    }
    // ESTADO DE CUOTAS MENSUALES -> CUOTAS MENSUALES GENERADAS
    public function setEstadoCuotaClientes($valor_retorno)
    {
        $this->EstadoCuotaClientes = $valor_retorno;
    }
    public function getEstadoCuotaClientes()
    {
        return $this->EstadoCuotaClientes;
    }
    // MONTO ASIGNADO PAGARÉ CAPITAL DE CREDITOS CLIENTES
    public function setMontoCapitalClientes($valor_retorno)
    {
        $this->MontoCapitalClientes = $valor_retorno;
    }
    public function getMontoCapitalClientes()
    {
        return $this->MontoCapitalClientes;
    }
    // FECHA DE VENCIMIENTO CUOTAS MENSUALES CREDITOS CLIENTES
    public function setFechaVencimientoCuotasClientes($valor_retorno)
    {
        $this->FechaVencimientoCuotasClientes = $valor_retorno;
    }
    public function getFechaVencimientoCuotasClientes()
    {
        return $this->FechaVencimientoCuotasClientes;
    }
    // COMPROBACION DE INCUMPLIMIETO CUOTAS CLIENTES -> PARA GENERAR CARGO POR MORA DIARIO
    public function setComprobarIncumplimientoCuotasClientes($valor_retorno)
    {
        $this->ComprobarIncumplimientoCuotasClientes = $valor_retorno;
    }
    public function getComprobarIncumplimientoCuotasClientes()
    {
        return $this->ComprobarIncumplimientoCuotasClientes;
    }
    // COMPROBACION DE INCUMPLIMIETO CUOTAS CLIENTES -> PARA GENERAR CARGO POR MORA DIARIO
    public function setDiasIncumplimientoCuotasClientes($valor_retorno)
    {
        $this->DiasIncumplimientoCuotasClientes = $valor_retorno;
    }
    public function getDiasIncumplimientoCuotasClientes()
    {
        return $this->DiasIncumplimientoCuotasClientes;
    }
    /*
            << CONSULTA DE DATOS REPORTES FALLOS PLATAFORMA ESPECIFICA  >>
                -> VALIDO EXCLUSIVAMENTE PARA USUARIOS ADMINISTRADORES, YA QUE DENTRO DE SU VISTA ES POSIBLE GESTIONAR DICHOS REPORTES
        */
    // ID UNICO DE REPORTES FALLOS PLATAFORMA
    public function setIdReportePlataforma($valor_retorno)
    {
        $this->IdReportePlataforma = $valor_retorno;
    }
    public function getIdReportePlataforma()
    {
        return $this->IdReportePlataforma;
    }
    // NOMBRES DE REPORTES FALLOS PLATAFORMA
    public function setNombreReportePlataforma($valor_retorno)
    {
        $this->NombreReportePlataforma = $valor_retorno;
    }
    public function getNombreReportePlataforma()
    {
        return $this->NombreReportePlataforma;
    }
    // DESCRIPCION COMPLETA DE REPORTES FALLOS PLATAFORMA
    public function setDescripcionReportePlataforma($valor_retorno)
    {
        $this->DescripcionReportePlataforma = $valor_retorno;
    }
    public function getDescripcionReportePlataforma()
    {
        return $this->DescripcionReportePlataforma;
    }
    // FOTOGRAFIA -> CAPTURA DE PANTALLA DE REPORTES FALLOS PLATAFORMA
    public function setFotoReportePlataforma($valor_retorno)
    {
        $this->FotoReportePlataforma = $valor_retorno;
    }
    public function getFotoReportePlataforma()
    {
        return $this->FotoReportePlataforma;
    }
    // FECHA DE REGISTRO U INGRESO DE REPORTES FALLOS PLATAFORMA
    public function setFechaRegistroReportePlataforma($valor_retorno)
    {
        $this->FechaRegistroReportePlataforma = $valor_retorno;
    }
    public function getFechaRegistroReportePlataforma()
    {
        return $this->FechaRegistroReportePlataforma;
    }
    // FECHA DE ACTUALIZACION U MODIFICACION DE REPORTES FALLOS PLATAFORMA
    public function setFechaActualizacionReportePlataforma($valor_retorno)
    {
        $this->FechaActualizacionReportePlataforma = $valor_retorno;
    }
    public function getFechaActualizacionReportePlataforma()
    {
        return $this->FechaActualizacionReportePlataforma;
    }
    // ESTADO DE REPORTES FALLOS PLATAFORMA
    public function setEstadoReportePlataforma($valor_retorno)
    {
        $this->EstadoReportePlataforma = $valor_retorno;
    }
    public function getEstadoReportePlataforma()
    {
        return $this->EstadoReportePlataforma;
    }
    // COMENTARIO DE ACTUALIZACION DE REPORTES FALLOS PLATAFORMA
    public function setComentarioActualizacionReportePlataforma($valor_retorno)
    {
        $this->ComentarioActualizacionReportePlataforma = $valor_retorno;
    }
    public function getComentarioActualizacionReportePlataforma()
    {
        return $this->ComentarioActualizacionReportePlataforma;
    }
    // USUARIO UNICO DE EMPLEADOS QUE GESGTIONAN REPORTES FALLOS PLATAFORMA
    public function setEmpleadoGestionandoReportePlataforma($valor_retorno)
    {
        $this->EmpleadoGestionandoReportePlataforma = $valor_retorno;
    }
    public function getEmpleadoGestionandoReportePlataforma()
    {
        return $this->EmpleadoGestionandoReportePlataforma;
    }
    /*
            << CONSULTA DE TRANSACCIONES DE CREDITOS APROBADOS CLIENTES  >>
                -> CONSULTA DE ESTADO DE CUOTAS, PROCESAMIENTO DE PAGOS DE CUOTAS SEGUN PRODUCTO, CREDITO Y CLIENTE ASOCIADO. VALIDO PARA TODOS LOS USUARIOS ADMINISTRATIVOS Y CLIENTES
        */
    // ID UNICO DE TRANSACCIONES CREDITOS CLIENTES
    public function setIdTransaccionCreditosClientes($valor_retorno)
    {
        $this->IdTransaccionCreditosClientes = $valor_retorno;
    }
    public function getIdTransaccionCreditosClientes()
    {
        return $this->IdTransaccionCreditosClientes;
    }
    // NUMERO REFERENCIA UNICA TRANSACCIONES CREDITOS CLIENTES
    public function setReferenciaTransaccionCreditosClientes($valor_retorno)
    {
        $this->ReferenciaTransaccionCreditosClientes = $valor_retorno;
    }
    public function getReferenciaTransaccionCreditosClientes()
    {
        return $this->ReferenciaTransaccionCreditosClientes;
    }
    // MONTO CANCELADO TRANSACCIONES CREDITOS CLIENTES
    public function setMontoTransaccionCreditosClientes($valor_retorno)
    {
        $this->MontoTransaccionCreditosClientes = $valor_retorno;
    }
    public function getMontoTransaccionCreditosClientes()
    {
        return $this->MontoTransaccionCreditosClientes;
    }
    // FECHA DE REGISTRO TRANSACCIONES CREDITOS CLIENTES
    public function setFechaTransaccionCreditosClientes($valor_retorno)
    {
        $this->FechaTransaccionCreditosClientes = $valor_retorno;
    }
    public function getFechaTransaccionCreditosClientes()
    {
        return $this->FechaTransaccionCreditosClientes;
    }
    // FECHA DE REGISTRO TRANSACCIONES CREDITOS CLIENTES
    public function setEmpleadoGestionTransaccionCreditosClientes($valor_retorno)
    {
        $this->EmpleadoGestionTransaccionCreditosClientes = $valor_retorno;
    }
    public function getEmpleadoGestionTransaccionCreditosClientes()
    {
        return $this->EmpleadoGestionTransaccionCreditosClientes;
    }
    /*
            << CONSULTA DE MENSAJERIA InversGlobal USUARIOS >>
                -> DETALLE COMPLETO DE MENSAJES RECIBIDOS [BANDEJA DE ENTRADA] Y LECTURA COMPLETA INDIVIDUAL DE MENSAJE RECIBIDO [DETALLE DE MENSAJERIA]
        */
    // ID UNICO DE MENSAJE REGISTRADO
    public function setIdMensajeria($valor_retorno)
    {
        $this->IdMensajeria = $valor_retorno;
    }
    public function getIdMensajeria()
    {
        return $this->IdMensajeria;
    }
    // ID UNICO DE USUARIO DE DESTINO MENSAJE REGISTRADO
    public function setIdUsuarioDestinatarioMensajeria($valor_retorno)
    {
        $this->IdUsuarioDestinatarioMensajeria = $valor_retorno;
    }
    public function getIdUsuarioDestinatarioMensajeria()
    {
        return $this->IdUsuarioDestinatarioMensajeria;
    }
    // NOMBRE DE MENSAJE REGISTRADO
    public function setNombreMensajeria($valor_retorno)
    {
        $this->NombreMensajeria = $valor_retorno;
    }
    public function getNombreMensajeria()
    {
        return $this->NombreMensajeria;
    }
    // ASUNTO DE MENSAJE REGISTRADO
    public function setAsuntoMensajeria($valor_retorno)
    {
        $this->AsuntoMensajeria = $valor_retorno;
    }
    public function getAsuntoMensajeria()
    {
        return $this->AsuntoMensajeria;
    }
    // DETALLE COMPLETO DE MENSAJE REGISTRADO
    public function setDetalleMensajeria($valor_retorno)
    {
        $this->DetalleMensajeria = $valor_retorno;
    }
    public function getDetalleMensajeria()
    {
        return $this->DetalleMensajeria;
    }
    // FECHA DE REGISTRO DE MENSAJE REGISTRADO
    public function setFechaMensajeria($valor_retorno)
    {
        $this->FechaMensajeria = $valor_retorno;
    }
    public function getFechaMensajeria()
    {
        return $this->FechaMensajeria;
    }
    /*
            << CONSULTA DATOS NUMEROS REGISTROS ESPECIFICOS >>
                -> DETALLE DE SOLICITUDES REGISTRADAS -> TOTALES DE REGISTROS VALIDOS PARA EL INICIO DE INTERFAZ ADMINISTRADORES
        */
    // NUMERO DE USUARIOS REGISTRADOS
    public function setNumeroUsuariosRegistrados($valor_retorno)
    {
        $this->NumeroUsuariosRegistrados = $valor_retorno;
    }
    public function getNumeroUsuariosRegistrados()
    {
        return $this->NumeroUsuariosRegistrados;
    }
    // NUMERO DE PRODUCTOS REGISTRADOS
    public function setNumeroProductosRegistrados($valor_retorno)
    {
        $this->NumeroProductosRegistrados = $valor_retorno;
    }
    public function getNumeroProductosRegistrados()
    {
        return $this->NumeroProductosRegistrados;
    }
    // NUMERO DE REPORTES DE FALLOS PLATAFORMA REGISTRADOS {TICKETS DE SOPORTE}
    public function setNumeroReportesFallosPlataformaRegistrados($valor_retorno)
    {
        $this->NumeroReportesFallosPlataformaRegistrados = $valor_retorno;
    }
    public function getNumeroReportesFallosPlataformaRegistrados()
    {
        return $this->NumeroReportesFallosPlataformaRegistrados;
    }
    // NUMERO DE SOLICITUDES DE RECUPERACION DE CONTRASEÑAS REGISTRADAS
    public function setNumeroSolicitudesRecuperacionesRegistrados($valor_retorno)
    {
        $this->NumeroSolicitudesRecuperacionesRegistrados = $valor_retorno;
    }
    public function getNumeroSolicitudesRecuperacionesRegistrados()
    {
        return $this->NumeroSolicitudesRecuperacionesRegistrados;
    }
    // NUMERO DE CUOTAS CLIENTES REGISTRADAS
    public function setNumeroCuotasClientesRegistradas($valor_retorno)
    {
        $this->NumeroCuotasClientesRegistradas = $valor_retorno;
    }
    public function getNumeroCuotasClientesRegistradas()
    {
        return $this->NumeroCuotasClientesRegistradas;
    }
    // NUMERO DE TRANSACCIONES CLIENTES REGISTRADAS
    public function setNumeroTransaccionesClientesRegistradas($valor_retorno)
    {
        $this->NumeroTransaccionesClientesRegistradas = $valor_retorno;
    }
    public function getNumeroTransaccionesClientesRegistradas()
    {
        return $this->NumeroTransaccionesClientesRegistradas;
    }
    /*
            << CONSULTA DATOS NUMEROS REGISTROS ESPECIFICOS >>
                -> DETALLE DE SOLICITUDES REGISTRADAS -> TOTALES DE REGISTROS VALIDOS PARA EL INICIO DE INTERFAZ PRESIDENCIA
        */
    // NUMERO DE CUENTAS DE AHORRO CLIENTES REGISTRADAS
    public function setNumeroCuentasAhorroClientesRegistradas($valor_retorno)
    {
        $this->NumeroCuentasAhorroClientesRegistradas = $valor_retorno;
    }
    public function getNumeroCuentasAhorroClientesRegistradas()
    {
        return $this->NumeroCuentasAhorroClientesRegistradas;
    }
    /*
            << CONSULTA DATOS NUMEROS REGISTROS ESPECIFICOS >>
                -> DETALLE DE SOLICITUDES REGISTRADAS -> TOTALES DE REGISTROS VALIDOS PARA EL INICIO DE INTERFAZ GERENCIA
        */
    // NUMERO DE CUOTAS PAGADAS TARDE [-> ESTADO PT]
    public function setNumeroCuotasPagadasTarde($valor_retorno)
    {
        $this->NumeroCuotasPagadasTarde = $valor_retorno;
    }
    public function getNumeroCuotasPagadasTarde()
    {
        return $this->NumeroCuotasPagadasTarde;
    }
    // NUMERO DE CUOTAS CANCELADAS
    public function setNumeroCuotasPagadasCanceladas($valor_retorno)
    {
        $this->NumeroCuotasPagadasCanceladas = $valor_retorno;
    }
    public function getNumeroCuotasPagadasCanceladas()
    {
        return $this->NumeroCuotasPagadasCanceladas;
    }
    // NUMERO DE CUOTAS VENCIDAS
    public function setNumeroCuotasVencidas($valor_retorno)
    {
        $this->NumeroCuotasVencidas = $valor_retorno;
    }
    public function getNumeroCuotasVencidas()
    {
        return $this->NumeroCuotasVencidas;
    }
    // NUMERO DE TRANSFERENCIAS PROCESADAS
    public function setNumeroTransferenciasProcesadas($valor_retorno)
    {
        $this->NumeroTransferenciasProcesadas = $valor_retorno;
    }
    public function getNumeroTransferenciasProcesadas()
    {
        return $this->NumeroTransferenciasProcesadas;
    }
    /*
            << CONSULTA DATOS CREDITOS CANCELADOS CLIENTES -> GENERAR FINIQUITO DE CANCELACION >>
                -> DETALLE COMPLETO DE CREDITO CANCELADO CLIENTES
        */
    // ID UNICO DE HISTORICO CREDITOS CLIENTES REGISTRADO
    public function setIdCreditoHistoricoClientes($valor_retorno)
    {
        $this->IdCreditoHistoricoClientes = $valor_retorno;
    }
    public function getIdCreditoHistoricoClientes()
    {
        return $this->IdCreditoHistoricoClientes;
    }
    // ESTADO DE HISTORICO CREDITOS CLIENTES REGISTRADO
    public function setEstadoCreditoHistoricoClientes($valor_retorno)
    {
        $this->EstadoCreditoHistoricoClientes = $valor_retorno;
    }
    public function getEstadoCreditoHistoricoClientes()
    {
        return $this->EstadoCreditoHistoricoClientes;
    }
    /*
            << CONSULTA DATOS CUENTAS DE AHORRO CLIENTES InversGlobal >>
                -> DETALLE COMPLETO DE CUENTA DE AHORRO REGISTRADA, ASOCIADA A CLIENTES
        */
    // ID UNICO DE CUENTA DE AHORRO REGISTRADA
    public function setIdCuentaAhorroClientes($valor_retorno)
    {
        $this->IdCuentaAhorroClientes = $valor_retorno;
    }
    public function getIdCuentaAhorroClientes()
    {
        return $this->IdCuentaAhorroClientes;
    }
    // NUMERO UNICO DE CUENTA DE AHORRO REGISTRADA
    public function setNumeroCuentaAhorroClientes($valor_retorno)
    {
        $this->NumeroCuentaAhorroClientes = $valor_retorno;
    }
    public function getNumeroCuentaAhorroClientes()
    {
        return $this->NumeroCuentaAhorroClientes;
    }
    // SALDO DISPONIBLE DE CUENTA DE AHORRO REGISTRADA
    public function setSaldoCuentaAhorroClientes($valor_retorno)
    {
        $this->SaldoCuentaAhorroClientes = $valor_retorno;
    }
    public function getSaldoCuentaAhorroClientes()
    {
        return $this->SaldoCuentaAhorroClientes;
    }
    // ESTADO ACTUAL DE CUENTA DE AHORRO REGISTRADA
    public function setEstadoCuentaAhorroClientes($valor_retorno)
    {
        $this->EstadoCuentaAhorroClientes = $valor_retorno;
    }
    public function getEstadoCuentaAhorroClientes()
    {
        return $this->EstadoCuentaAhorroClientes;
    }
    // FECHA DE APERTURA CUENTA DE AHORRO REGISTRADA
    public function setFechaAperturaCuentaAhorroClientes($valor_retorno)
    {
        $this->FechaAperturaCuentaAhorroClientes = $valor_retorno;
    }
    public function getFechaAperturaCuentaAhorroClientes()
    {
        return $this->FechaAperturaCuentaAhorroClientes;
    }
    /*
            << CONSULTA DATOS CUENTAS DE AHORRO CLIENTES InversGlobal >>
                -> DETALLE DE CLIENTES -> TRANSFERENCIAS A OTRAS CUENTAS
        */
    // ID UNICO DE CUENTA DE AHORRO REGISTRADA
    public function setIdTransaccionesDepositosRetirosCuentasTransferencias($valor_retorno)
    {
        $this->IdTransaccionesDepositosRetirosCuentasTransferencias = $valor_retorno;
    }
    public function getIdTransaccionesDepositosRetirosCuentasTransferencias()
    {
        return $this->IdTransaccionesDepositosRetirosCuentasTransferencias;
    }
    // NUMERO UNICO DE CUENTA DE AHORRO REGISTRADA
    public function setNumeroCuentaAhorroClientesTransferencias($valor_retorno)
    {
        $this->NumeroCuentaAhorroClientesTransferencias = $valor_retorno;
    }
    public function getNumeroCuentaAhorroClientesTransferencias()
    {
        return $this->NumeroCuentaAhorroClientesTransferencias;
    }
    // NOMBRES DE CLIENTE DE CUENTA DE AHORRO REGISTRADA
    public function setNombresClienteCuentaAhorroClientesTransferencias($valor_retorno)
    {
        $this->NombresClienteCuentaAhorroClientesTransferencias = $valor_retorno;
    }
    public function getNombresClienteCuentaAhorroClientesTransferencias()
    {
        return $this->NombresClienteCuentaAhorroClientesTransferencias;
    }
    // APELLIDOS DE CLIENTE DE CUENTA DE AHORRO REGISTRADA
    public function setApellidosClienteCuentaAhorroClientesTransferencias($valor_retorno)
    {
        $this->ApellidosClienteCuentaAhorroClientesTransferencias = $valor_retorno;
    }
    public function getApellidosClienteCuentaAhorroClientesTransferencias()
    {
        return $this->ApellidosClienteCuentaAhorroClientesTransferencias;
    }
    /*
            << CONSULTA DATOS TRANSACCIONES REALIZADAS CUENTAS DE CLIENTES InversGlobal >>
                -> DETALLE COMPLETO DE TRANSACCIONES CUENTAS DE AHORROS Y PLAZO FIJO
        */
    // ID UNICO DE TRANSACCION CUENTA DE AHORRO / PLAZO FIJO
    public function setIdTransaccionesDepositosRetirosCuentas($valor_retorno)
    {
        $this->IdTransaccionesDepositosRetirosCuentas = $valor_retorno;
    }
    public function getIdTransaccionesDepositosRetirosCuentas()
    {
        return $this->IdTransaccionesDepositosRetirosCuentas;
    }
    // ID UNICO DE TRANSACCION CUENTA DE AHORRO / PLAZO FIJO
    public function setUltimoIdTransaccionesDepositosRetirosCuentas($valor_retorno)
    {
        $this->UltimoIdTransaccionesDepositosRetirosCuentas = $valor_retorno;
    }
    public function getUltimoIdTransaccionesDepositosRetirosCuentas()
    {
        return $this->UltimoIdTransaccionesDepositosRetirosCuentas;
    }
    // NUMERO DE REFERENCIA TRANSACCION CUENTA DE AHORRO / PLAZO FIJO
    public function setReferenciaTransaccionDepositosRetirosCuentas($valor_retorno)
    {
        $this->ReferenciaTransaccionDepositosRetirosCuentas = $valor_retorno;
    }
    public function getReferenciaTransaccionDepositosRetirosCuentas()
    {
        return $this->ReferenciaTransaccionDepositosRetirosCuentas;
    }
    // MONTO DEPOSITADO TRANSACCION CUENTA DE AHORRO / PLAZO FIJO
    public function setMontoDepositosRetirosCuentas($valor_retorno)
    {
        $this->MontoDepositosRetirosCuentas = $valor_retorno;
    }
    public function getMontoDepositosRetirosCuentas()
    {
        return $this->MontoDepositosRetirosCuentas;
    }
    // MONTO DEPOSITADO TRANSACCION CUENTA DE AHORRO / PLAZO FIJO
    public function setFechaTransaccionDepositosRetirosCuentas($valor_retorno)
    {
        $this->FechaTransaccionDepositosRetirosCuentas = $valor_retorno;
    }
    public function getFechaTransaccionDepositosRetirosCuentas()
    {
        return $this->FechaTransaccionDepositosRetirosCuentas;
    }
    // EMPLEADO QUE REALIZO GESTION TRANSACCION CUENTA DE AHORRO / PLAZO FIJO
    public function setEmpleadoGestionTransaccionDepositosRetirosCuentas($valor_retorno)
    {
        $this->EmpleadoGestionTransaccionDepositosRetirosCuentas = $valor_retorno;
    }
    public function getEmpleadoGestionTransaccionDepositosRetirosCuentas()
    {
        return $this->EmpleadoGestionTransaccionDepositosRetirosCuentas;
    }
    // TIPO DE TRANSACCION CUENTA DE AHORRO / PLAZO FIJO
    public function setTipoTransaccionDepositosRetirosCuentas($valor_retorno)
    {
        $this->TipoTransaccionDepositosRetirosCuentas = $valor_retorno;
    }
    public function getTipoTransaccionDepositosRetirosCuentas()
    {
        return $this->TipoTransaccionDepositosRetirosCuentas;
    }
    // SALDO NUEVO DE CUENTAS TRANSACCIONES CUENTA DE AHORRO / PLAZO FIJO
    public function setSaldoNuevoTransaccionDepositosRetirosCuentas($valor_retorno)
    {
        $this->SaldoNuevoTransaccionDepositosRetirosCuentas = $valor_retorno;
    }
    public function getSaldoNuevoTransaccionDepositosRetirosCuentas()
    {
        return $this->SaldoNuevoTransaccionDepositosRetirosCuentas;
    }
    // ESTADO DE TRANSACCION DE CUENTAS DE AHORRO / PLAZO FIJO
    public function setEstadoTransaccionDepositosRetirosCuentas($valor_retorno)
    {
        $this->EstadoTransaccionDepositosRetirosCuentas = $valor_retorno;
    }
    public function getEstadoTransaccionDepositosRetirosCuentas()
    {
        return $this->EstadoTransaccionDepositosRetirosCuentas;
    }
    /*
            << CONSULTA DATOS TRANSFERENCIAS CLIENTES -> CUENTAS DE DESTINO FINAL InversGlobal >>
        */
    // ID UNICO DE CUENTA AHORRO REGISTRADA -> TRANSFERENCIA DE DESTINO FINAL
    public function setIdCuentaAhorroTransferenciaDestinoClientes($valor_retorno)
    {
        $this->IdCuentaAhorroTransferenciaDestinoClientes = $valor_retorno;
    }
    public function getIdCuentaAhorroTransferenciaDestinoClientes()
    {
        return $this->IdCuentaAhorroTransferenciaDestinoClientes;
    }
    // TOTAL DE CUOTAS CANCELADAS -> INFORMACION INTERFAZ DE INICIO CLIENTES
    public function setTotalCuotasCanceladasCreditosClientes($valor_retorno)
    {
        $this->TotalCuotasCanceladasCreditosClientes = $valor_retorno;
    }
    public function getTotalCuotasCanceladasCreditosClientes()
    {
        return $this->TotalCuotasCanceladasCreditosClientes;
    }
    /*
            << CONSULTA DATOS TRANSACCIONES -> INTERFAZ DE EMPLEADOS ATENCION AL CLIENTE >>
        */
    // TOTAL DE TRANSACCIONES PROCESADAS -> SEGUN CODIGO UNICO DE EMPLEADOS
    public function setTotalTransaccionesProcesadas_AtencionClientes($valor_retorno)
    {
        $this->TotalTransaccionesProcesadas_AtencionClientes = $valor_retorno;
    }
    public function getTotalTransaccionesProcesadas_AtencionClientes()
    {
        return $this->TotalTransaccionesProcesadas_AtencionClientes;
    }
    // TOTAL DE SOLICITUDES CREDITOS PROCESADAS -> SEGUN CODIGO UNICO DE EMPLEADOS
    public function setTotalSolicitudesCreditosProcesadas_AtencionClientes($valor_retorno)
    {
        $this->TotalSolicitudesCreditosProcesadas_AtencionClientes = $valor_retorno;
    }
    public function getTotalSolicitudesCreditosProcesadas_AtencionClientes()
    {
        return $this->TotalSolicitudesCreditosProcesadas_AtencionClientes;
    }
    // TOTAL DE INGRESOS TRANSACCIONES CREDITOS PROCESADAS -> SEGUN CODIGO UNICO DE EMPLEADOS
    public function setTotalIngresosTransaccionesCreditos_AtencionClientes($valor_retorno)
    {
        $this->TotalIngresosTransaccionesCreditos_AtencionClientes = $valor_retorno;
    }
    public function getTotalIngresosTransaccionesCreditos_AtencionClientes()
    {
        return $this->TotalIngresosTransaccionesCreditos_AtencionClientes;
    }
    /*
            << CONSULTA DATOS COPIA CONTRATOS CREDITOS CLIENTES -> TODOS LOS USUARIOS QUE POSEAN UN PRODUCTO ASOCIADO >>
        */
    // NOMBRE COPIA CONTRATO CREDITOS CLIENTES
    public function setNombreCopiaContratosSuscritosCreditosClientes($valor_retorno)
    {
        $this->NombreCopiaContratosSuscritosCreditosClientes = $valor_retorno;
    }
    public function getNombreCopiaContratosSuscritosCreditosClientes()
    {
        return $this->NombreCopiaContratosSuscritosCreditosClientes;
    }
    // CONSULTAR CONFIGURACION CUENTA DE USUARIOS -> MI PERFIL
    /**
     * Consulta la configuración de cuenta de un usuario
     * 
     * @param mysqli $conectarsistema1 Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultarConfiguracionCuentaUsuarios(mysqli $conectarsistema1, int $IdUsuarios): bool
    {
        // Inicializar todos los valores por defecto
        $this->setIdUsuarios(0);
        $this->setNombresUsuarios('');
        $this->setApellidosUsuarios('');
        $this->setCodigoUsuarios('');
        $this->setCorreoUsuarios('');
        $this->setFotoUsuarios('');
        $this->setEstadoUsuarios('');

        try {
            // Validar ID de usuario
            if ($IdUsuarios <= 0) {
                throw new InvalidArgumentException("ID de usuario inválido");
            }

            $stmt = $conectarsistema1->prepare("CALL ConsultarConfiguracionCuentaUsuarios(?)");
            if (!$stmt) {
                throw new Exception("Error al preparar la consulta: " . $conectarsistema1->error);
            }

            $stmt->bind_param("i", $IdUsuarios);
            if (!$stmt->execute()) {
                throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();

                // Asignar valores con validación
                $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
                $this->setNombresUsuarios((string)($Gestiones['nombres'] ?? ''));
                $this->setApellidosUsuarios((string)($Gestiones['apellidos'] ?? ''));
                $this->setCodigoUsuarios((string)($Gestiones['codigousuario'] ?? ''));
                $this->setCorreoUsuarios((string)($Gestiones['correo'] ?? ''));
                $this->setFotoUsuarios((string)($Gestiones['fotoperfil'] ?? ''));
                $this->setEstadoUsuarios((string)($Gestiones['estado_usuario'] ?? ''));
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultarConfiguracionCuentaUsuarios: " . $e->getMessage());
            return false;
        }
    }
    // CONSULTAR DETALLES DE USUARIOS -> MI PERFIL
    /**
     * Consulta los detalles de un usuario
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultarDetallesUsuarios(mysqli $conectarsistema, int $IdUsuarios): bool
    {
        // Inicializar todos los valores por defecto
        $this->setduiUsuarios('');
        $this->setNitUsuarios('');
        $this->setTelefonoUsuarios('');
        $this->setCelularUsuarios('');
        $this->setTelefonoTrabajoUsuarios('');
        $this->setDireccionUsuarios('');
        $this->setEmpresaUsuarios('');
        $this->setCargoEmpresaUsuarios('');
        $this->setDireccionTrabajoUsuarios('');
        $this->setFechaNacimientoUsuarios('');
        $this->setGeneroUsuarios('');
        $this->setEstadoCivilUsuarios('');

        try {
            // Validar ID de usuario
            if ($IdUsuarios <= 0) {
                throw new InvalidArgumentException("ID de usuario inválido");
            }

            $stmt = $conectarsistema->prepare("CALL ConsultarPerfilUsuarios(?)");
            if (!$stmt) {
                throw new Exception("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("i", $IdUsuarios);
            if (!$stmt->execute()) {
                throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();

                // Asignar valores con validación
                $this->setduiUsuarios((string)($Gestiones['dui'] ?? ''));
                $this->setNitUsuarios((string)($Gestiones['nit'] ?? ''));
                $this->setTelefonoUsuarios((string)($Gestiones['telefono'] ?? ''));
                $this->setCelularUsuarios((string)($Gestiones['celular'] ?? ''));
                $this->setTelefonoTrabajoUsuarios((string)($Gestiones['telefonotrabajo'] ?? ''));
                $this->setDireccionUsuarios((string)($Gestiones['direccion'] ?? ''));
                $this->setEmpresaUsuarios((string)($Gestiones['empresa'] ?? ''));
                $this->setCargoEmpresaUsuarios((string)($Gestiones['cargo'] ?? ''));
                $this->setDireccionTrabajoUsuarios((string)($Gestiones['direcciontrabajo'] ?? ''));
                $this->setFechaNacimientoUsuarios((string)($Gestiones['fechanacimiento'] ?? ''));
                $this->setGeneroUsuarios((string)($Gestiones['genero'] ?? ''));
                $this->setEstadoCivilUsuarios((string)($Gestiones['estadocivil'] ?? ''));
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultarDetallesUsuarios: " . $e->getMessage());
            return false;
        }
    }
    // ACTUALIZACION DATOS CONFIGURACION CUENTA USUARIOS NIVEL -> ADMINISTRADORES [CON FOTO]
    public function ActualizacionConfiguracionCuentaAdministradores(
        mysqli $conectarsistema,
        int $IdUsuarios,
        string $NombresUsuarios,
        string $ApellidosUsuarios,
        string $CodigoUsuarios,
        string $CorreoUsuarios,
        string $ContraseniaUsuarios,
        string $FotoPerfilUsuarios
    ): string {
        $stmt = $conectarsistema->prepare("CALL ActualizarConfiguracionCuentasAdministradoresConFoto(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "issssss",
            $IdUsuarios,
            $NombresUsuarios,
            $ApellidosUsuarios,
            $CodigoUsuarios,
            $CorreoUsuarios,
            $ContraseniaUsuarios,
            $FotoPerfilUsuarios
        );

        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado ? "OK" : "ERROR";
    }
    // ACTUALIZACION DATOS CONFIGURACION CUENTA USUARIOS NIVEL -> PRESIDENCIA [CON FOTO]
    public function ActualizacionConfiguracionCuentaPresidencia($conectarsistema, $IdUsuarios, $NombresUsuarios, $ApellidosUsuarios, $CodigoUsuarios, $CorreoUsuarios, $ContraseniaUsuarios, $FotoPerfilUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ActualizarConfiguracionCuentasPresidenciaConFoto('" . $IdUsuarios . "','" . $NombresUsuarios . "','" . $ApellidosUsuarios . "','" . $CodigoUsuarios . "','" . $CorreoUsuarios . "','" . $ContraseniaUsuarios . "','" . $FotoPerfilUsuarios . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // ACTUALIZACION DATOS CONFIGURACION CUENTA USUARIOS NIVEL -> GERENCIA [CON FOTO]
    public function ActualizacionConfiguracionCuentaGerencia($conectarsistema, $IdUsuarios, $NombresUsuarios, $ApellidosUsuarios, $CorreoUsuarios, $ContraseniaUsuarios, $FotoPerfilUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ActualizarConfiguracionCuentasGerenciaConFoto('" . $IdUsuarios . "','" . $NombresUsuarios . "','" . $ApellidosUsuarios . "','" . $CorreoUsuarios . "','" . $ContraseniaUsuarios . "','" . $FotoPerfilUsuarios . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // ACTUALIZACION DATOS CONFIGURACION CUENTA USUARIOS NIVEL -> CLIENTES [CON FOTO]
    public function ActualizacionConfiguracionCuentaClientes($conectarsistema, $IdUsuarios, $NombresUsuarios, $ApellidosUsuarios, $CorreoUsuarios, $ContraseniaUsuarios, $FotoPerfilUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ActualizarConfiguracionCuentasClientesConFoto('" . $IdUsuarios . "','" . $NombresUsuarios . "','" . $ApellidosUsuarios . "','" . $CorreoUsuarios . "','" . $ContraseniaUsuarios . "','" . $FotoPerfilUsuarios . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // ACTUALIZACION DATOS CONFIGURACION CUENTA USUARIOS NIVEL -> ADMINISTRADORES [SIN FOTO]
    public function ActualizacionConfiguracionCuentaAdministradoresSinFoto($conectarsistema, $IdUsuarios, $NombresUsuarios, $ApellidosUsuarios, $CodigoUsuarios, $ContraseniaUsuarios, $CorreoUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ActualizarConfiguracionCuentasAdministradoresSinFoto('" . $IdUsuarios . "','" . $NombresUsuarios . "','" . $ApellidosUsuarios . "','" . $CodigoUsuarios . "','" . $ContraseniaUsuarios . "','" . $CorreoUsuarios . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // ACTUALIZACION DATOS CONFIGURACION CUENTA USUARIOS NIVEL -> PRESIDENCIA [SIN FOTO]
    public function ActualizacionConfiguracionCuentaPresidenciaSinFoto($conectarsistema, $IdUsuarios, $NombresUsuarios, $ApellidosUsuarios, $CodigoUsuarios, $ContraseniaUsuarios, $CorreoUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ActualizarConfiguracionCuentasPresidenciaSinFoto('" . $IdUsuarios . "','" . $NombresUsuarios . "','" . $ApellidosUsuarios . "','" . $CodigoUsuarios . "','" . $ContraseniaUsuarios . "','" . $CorreoUsuarios . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // ACTUALIZACION DATOS CONFIGURACION CUENTA USUARIOS NIVEL -> GERENCIA [SIN FOTO]
    public function ActualizacionConfiguracionCuentaGerenciaSinFoto($conectarsistema, $IdUsuarios, $NombresUsuarios, $ApellidosUsuarios, $ContraseniaUsuarios, $CorreoUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ActualizarConfiguracionCuentasGerenciaSinFoto('" . $IdUsuarios . "','" . $NombresUsuarios . "','" . $ApellidosUsuarios . "','" . $ContraseniaUsuarios . "','" . $CorreoUsuarios . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // ACTUALIZACION DATOS CONFIGURACION CUENTA USUARIOS NIVEL -> CLIENTES [SIN FOTO]
    public function ActualizacionConfiguracionCuentaClientesSinFoto($conectarsistema, $IdUsuarios, $NombresUsuarios, $ApellidosUsuarios, $ContraseniaUsuarios, $CorreoUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ActualizarConfiguracionCuentasClientesSinFoto('" . $IdUsuarios . "','" . $NombresUsuarios . "','" . $ApellidosUsuarios . "','" . $ContraseniaUsuarios . "','" . $CorreoUsuarios . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // ACTUALIZACION DETALLES PERFIL DE USUARIOS -> TODOS LOS USUARIOS
    public function ActualizacionDetallesPerfilUsuarios($conectarsistema, $IdUsuarios, $duiUsuarios, $NitUsuarios, $TelefonoUsuarios, $CelularUsuarios, $TelefonoTrabajoUsuarios, $DireccionUsuarios, $EmpresaUsuarios, $CargoEmpresaUsuarios, $DireccionTrabajoUsuarios, $FechaNacimientoUsuarios, $GeneroUsuarios, $EstadoCivilUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ActualizarDetallesUsuarios('" . $IdUsuarios . "','" . $duiUsuarios . "','" . $NitUsuarios . "','" . $TelefonoUsuarios . "','" . $CelularUsuarios . "','" . $TelefonoTrabajoUsuarios . "','" . $DireccionUsuarios . "','" . $EmpresaUsuarios . "','" . $CargoEmpresaUsuarios . "','" . $DireccionTrabajoUsuarios . "','" . $FechaNacimientoUsuarios . "','" . $GeneroUsuarios . "','" . $EstadoCivilUsuarios . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // CONSULTAR DETALLE COMPLETO INICIOS DE SESIONES -> PERFIL DE USUARIOS [TODOS LOS USUARIOS]
    public function ConsultarIniciosDeSesionesUsuarios($conectarsistema, $IdUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ReporteCompletoIniciosdeSesionesUsuarios('" . $IdUsuarios . "');");
        return $resultado;
    }
    // REGISTRAR NUEVOS USUARIOS -> USO EXCLUSIVO ROL [ADMINISTRADORES]
    public function RegistroClientesAdministradores(
        mysqli $conectarsistema,
        string $NombresUsuarios,
        string $ApellidosUsuarios,
        string $CodigoUsuarios,
        string $ContraseniaUsuarios,
        string $CorreoUsuarios,
        int $IdRolUsuarios,
        string $QuienRegistroUsuario
    ): string {
        $stmt = $conectarsistema->prepare("CALL RegistrarNuevosClientesAdministradores(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssssss",
            $NombresUsuarios,
            $ApellidosUsuarios,
            $CodigoUsuarios,
            $ContraseniaUsuarios,
            $CorreoUsuarios,
            $IdRolUsuarios,
            $QuienRegistroUsuario
        );

        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado ? "OK" : "ERROR";
    }
    // CONSULTAR DETALLE COMPLETO USUARIOS PERFIL INCOMPLETO
    // VALIDO PARA ROLES -> ADMINISTRADORES, ATENCION AL CLIENTE
    public function ConsultarUsuariosPerfilIncompleto($conectarsistema, $QuienRegistroUsuario)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaUsuariosPerfilIncompleto('" . $QuienRegistroUsuario . "')");
        return $resultado;
    }
    // REGISTRO DETALLES DE USUARIOS [NUEVOS USUARIOS] -> TODOS LOS USUARIOS
    public function RegistroNuevosDetallesPerfilUsuarios($conectarsistema, $duiUsuarios, $NitUsuarios, $TelefonoUsuarios, $CelularUsuarios, $TelefonoTrabajoUsuarios, $DireccionUsuarios, $EmpresaUsuarios, $CargoEmpresaUsuarios, $DireccionTrabajoUsuarios, $FechaNacimientoUsuarios, $GeneroUsuarios, $EstadoCivilUsuarios, $FotoduiUsuariosFrontal, $FotoduiUsuariosReverso, $FotoNitUsuarios, $FotoFirmaUsuarios, $IdUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL RegistrarDetallesUsuarios_Clientes('" . $duiUsuarios . "','" . $NitUsuarios . "','" . $TelefonoUsuarios . "','" . $CelularUsuarios . "','" . $TelefonoTrabajoUsuarios . "','" . $DireccionUsuarios . "','" . $EmpresaUsuarios . "','" . $CargoEmpresaUsuarios . "','" . $DireccionTrabajoUsuarios . "','" . $FechaNacimientoUsuarios . "','" . $GeneroUsuarios . "','" . $EstadoCivilUsuarios . "','" . $FotoduiUsuariosFrontal . "','" . $FotoduiUsuariosReverso . "','" . $FotoNitUsuarios . "','" . $FotoFirmaUsuarios . "','" . $IdUsuarios . "')");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // CONSULTA GENERAL DE USUARIOS REGISTRADOS [SIN FILTRO DE ROL] -> ADMINISTRADORES
    public function ConsultarUsuariosRegistradosAdministradores($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaGeneralUsuariosRegistrados()");
        return $resultado;
    }
    // CONSULTA GENERAL DE USUARIOS REGISTRADOS [INACTIVOS] -> ADMINISTRADORES
    public function ConsultarUsuariosInactivosAdministradores($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaGeneralUsuariosInactivos()");
        return $resultado;
    }
    // CONSULTA GENERAL DE USUARIOS REGISTRADOS [BLOQUEADOS] -> ADMINISTRADORES
    public function ConsultarUsuariosBloqueadosAdministradores($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaGeneralUsuariosBloqueados()");
        return $resultado;
    }
    // CONSULTAR CONFIGURACION DE CUENTA Y DETALLES USUARIOS COMPLETA -> MODIFICAR USUARIOS
    /**
     * Consulta los detalles completos de un usuario para modificación
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario a consultar
     * @return bool True si la consulta fue exitosa, false en caso de error
     * @throws InvalidArgumentException Si el ID de usuario no es válido
     */
    public function ConsultarDetallesCompletosModificarUsuarios(mysqli $conectarsistema, int $IdUsuarios): bool
    {
        // Inicializar todas las propiedades con valores por defecto
        $this->setIdUsuarios(0);
        $this->setNombresUsuarios('');
        $this->setApellidosUsuarios('');
        $this->setCodigoUsuarios('');
        $this->setCorreoUsuarios('');
        $this->setIdRolUsuarios(0);
        $this->setFotoUsuarios('');
        $this->setEstadoUsuarios('');
        $this->setduiUsuarios('');
        $this->setNitUsuarios('');
        $this->setTelefonoUsuarios('');
        $this->setCelularUsuarios('');
        $this->setTelefonoTrabajoUsuarios('');
        $this->setDireccionUsuarios('');
        $this->setEmpresaUsuarios('');
        $this->setCargoEmpresaUsuarios('');
        $this->setDireccionTrabajoUsuarios('');
        $this->setFechaNacimientoUsuarios('');
        $this->setGeneroUsuarios('');
        $this->setEstadoCivilUsuarios('');
        $this->setFotoduiFrontalUsuarios('');
        $this->setFotoduiReversoUsuarios('');
        $this->setFotoNitUsuarios('');
        $this->setFotoFirmaUsuarios('');

        try {
            // Validar ID de usuario
            if ($IdUsuarios <= 0) {
                throw new InvalidArgumentException("El ID de usuario debe ser un valor positivo");
            }

            // Preparar la consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultaGeneralCompletaUsuarios(?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            // Vincular parámetro y ejecutar
            $stmt->bind_param("i", $IdUsuarios);
            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            // Obtener resultados
            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();

                // Asignar valores con validación y conversión de tipos
                $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
                $this->setNombresUsuarios($this->sanitizeString($Gestiones['nombres'] ?? ''));
                $this->setApellidosUsuarios($this->sanitizeString($Gestiones['apellidos'] ?? ''));
                $this->setCodigoUsuarios($this->sanitizeString($Gestiones['codigousuario'] ?? ''));
                $this->setCorreoUsuarios($this->sanitizeEmail($Gestiones['correo'] ?? ''));
                $this->setIdRolUsuarios((int)($Gestiones['idrol'] ?? 0));
                $this->setFotoUsuarios($this->sanitizeString($Gestiones['fotoperfil'] ?? ''));
                $this->setEstadoUsuarios($this->sanitizeString($Gestiones['estado_usuario'] ?? ''));
                $this->setduiUsuarios($this->sanitizeString($Gestiones['dui'] ?? ''));
                $this->setNitUsuarios($this->sanitizeString($Gestiones['nit'] ?? ''));
                $this->setTelefonoUsuarios($this->sanitizePhone($Gestiones['telefono'] ?? ''));
                $this->setCelularUsuarios($this->sanitizePhone($Gestiones['celular'] ?? ''));
                $this->setTelefonoTrabajoUsuarios($this->sanitizePhone($Gestiones['telefonotrabajo'] ?? ''));
                $this->setDireccionUsuarios($this->sanitizeString($Gestiones['direccion'] ?? ''));
                $this->setEmpresaUsuarios($this->sanitizeString($Gestiones['empresa'] ?? ''));
                $this->setCargoEmpresaUsuarios($this->sanitizeString($Gestiones['cargo'] ?? ''));
                $this->setDireccionTrabajoUsuarios($this->sanitizeString($Gestiones['direcciontrabajo'] ?? ''));
                $this->setFechaNacimientoUsuarios($this->sanitizeDate($Gestiones['fechanacimiento'] ?? ''));
                $this->setGeneroUsuarios($this->sanitizeString($Gestiones['genero'] ?? ''));
                $this->setEstadoCivilUsuarios($this->sanitizeString($Gestiones['estadocivil'] ?? ''));
                $this->setFotoduiFrontalUsuarios($this->sanitizeString($Gestiones['fotoduifrontal'] ?? ''));
                $this->setFotoduiReversoUsuarios($this->sanitizeString($Gestiones['fotoduireverso'] ?? ''));
                $this->setFotoNitUsuarios($this->sanitizeString($Gestiones['fotonit'] ?? ''));
                $this->setFotoFirmaUsuarios($this->sanitizeString($Gestiones['fotofirma'] ?? ''));
            }

            // Liberar recursos
            $stmt->close();
            return true;
        } catch (Exception $e) {
            // Registrar el error
            error_log("Error en ConsultarDetallesCompletosModificarUsuarios: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Métodos auxiliares para sanitización (deberían estar en la clase)
     */
    private function sanitizeString(string $input): string
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    private function sanitizeEmail(string $input): string
    {
        $email = filter_var(trim($input), FILTER_SANITIZE_EMAIL);
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : '';
    }

    private function sanitizePhone(string $input): string
    {
        return preg_replace('/[^0-9+-]/', '', trim($input));
    }

    private function sanitizeDate(string $input): string
    {
        return date('Y-m-d', strtotime(trim($input))) === trim($input) ? trim($input) : '';
    }
    // MODIFICAR USUARIOS -> USO EXCLUSIVO ROL [ADMINISTRADORES]
    public function ModificarUsuariosClientesAdministradores($conectarsistema, $IdUsuarios, $NombresUsuarios, $ApellidosUsuarios, $CodigoUsuarios, $CorreoUsuarios, $IdRolUsuarios, $EstadoUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ModificarConfiguracionCuentaUsuarios_Administradores('" . $IdUsuarios . "','" . $NombresUsuarios . "','" . $ApellidosUsuarios . "','" . $CodigoUsuarios . "','" . $CorreoUsuarios . "','" . $IdRolUsuarios . "','" . $EstadoUsuarios . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // MODIFICAR DETALLES DE USUARIOS -> TODOS LOS USUARIOS
    public function ModificarDetallesUsuariosClientes($conectarsistema, $IdUsuarios, $duiUsuarios, $NitUsuarios, $TelefonoUsuarios, $CelularUsuarios, $TelefonoTrabajoUsuarios, $DireccionUsuarios, $EmpresaUsuarios, $CargoEmpresaUsuarios, $DireccionTrabajoUsuarios, $FechaNacimientoUsuarios, $GeneroUsuarios, $EstadoCivilUsuarios, $FotoduiUsuariosFrontal, $FotoduiUsuariosReverso, $FotoNitUsuarios, $FotoFirmaUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ModificarDetallesUsuarios_Clientes('" . $IdUsuarios . "','" . $duiUsuarios . "','" . $NitUsuarios . "','" . $TelefonoUsuarios . "','" . $CelularUsuarios . "','" . $TelefonoTrabajoUsuarios . "','" . $DireccionUsuarios . "','" . $EmpresaUsuarios . "','" . $CargoEmpresaUsuarios . "','" . $DireccionTrabajoUsuarios . "','" . $FechaNacimientoUsuarios . "','" . $GeneroUsuarios . "','" . $EstadoCivilUsuarios . "','" . $FotoduiUsuariosFrontal . "','" . $FotoduiUsuariosReverso . "','" . $FotoNitUsuarios . "','" . $FotoFirmaUsuarios . "')");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // DESACTIVAR USUARIOS / CLIENTES REGISTRADOS -> ADMINISTRADORES 
    public function DesactivarUsuariosClientes($conectarsistema, $IdUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL DesactivarUsuarios_Clientes('" . $IdUsuarios . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // BLOQUEAR USUARIOS / CLIENTES REGISTRADOS -> ADMINISTRADORES 
    public function BloquearUsuariosClientes($conectarsistema, $IdUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL BloquearUsuarios_Clientes('" . $IdUsuarios . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // REACTIVAR USUARIOS / CLIENTES REGISTRADOS -> ADMINISTRADORES 
    // MANTENIMIENTO VALIDO PARA USUARIOS INACTIVOS Y BLOQUEADOS
    public function ReactivarUsuariosClientes($conectarsistema, $IdUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ReactivarUsuarios_Clientes('" . $IdUsuarios . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // REGISTRO DE NUEVOS ROLES DE USUARIOS -> EXCLUSIVO PARA ADMINISTRADORES 
    public function RegistroNuevosRolesUsuarios(
        mysqli $conectarsistema,
        string $NombreRolUsuario,
        string $DescripcionRolUsuario
    ) {
        $stmt = $conectarsistema->prepare("CALL RegistroNuevosRolesDeUsuarios(?, ?)");
        $stmt->bind_param("ss", $NombreRolUsuario, $DescripcionRolUsuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();

        return $resultado;
    }
    // CONSULTA COMPLETA DE ROLES DE USUARIOS REGISTRADOS -> ADMINISTRADORES UNICAMENTE
    public function ConsultarRolesUsuariosRegistrados(mysqli $conectarsistema)
    {
        $resultado = $conectarsistema->query("CALL ConsultaCompletaRolesDeUsuariosRegistrados()");
        return $resultado;
    }
    // CONSULTAR ROLES DE USUARIOS -> ADMINISTRADORES UNICAMENTE
    public function ConsultaRolesUsuariosEspecifica(mysqli $conectarsistema, int $IdRolUsuarios): bool
    {
        // Inicializar valores por defecto
        $this->setIdRolUsuarios(0);
        $this->setNombreRolUsuario('');
        $this->setDescripcionRolUsuario('');

        try {
            // Validar ID de rol
            if ($IdRolUsuarios <= 0) {
                throw new InvalidArgumentException("ID de rol inválido");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultaEspecificaRolesDeUsuarios(?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("i", $IdRolUsuarios);
            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();

                // Asignar valores con validación
                $this->setIdRolUsuarios((int)($Gestiones['idrol'] ?? 0));
                $this->setNombreRolUsuario($this->sanitizeString($Gestiones['nombrerol'] ?? ''));
                $this->setDescripcionRolUsuario($this->sanitizeString($Gestiones['descripcionrol'] ?? ''));
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultaRolesUsuariosEspecifica: " . $e->getMessage());
            return false;
        }
    }
    // MODIFICAR ROLES DE USUARIOS -> EXCLUSIVO PARA ADMINISTRADORES 
    public function ModificarRolesUsuarios($conectarsistema, $IdRolUsuarios, $NombreRolUsuario, $DescripcionRolUsuario)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ModificarRolesUsuarios('" . $IdRolUsuarios . "','" . $NombreRolUsuario . "','" . $DescripcionRolUsuario . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // ELIMINAR ROLES DE USUARIOS REGISTRADOS -> ADMINISTRADORES 
    public function EliminarRolesUsuarios($conectarsistema, $IdRolUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL EliminarRolesUsuarios('" . $IdRolUsuarios . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    /**
     * Consulta productos generales
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdProductos ID del producto a consultar
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultaGeneralProductos(mysqli $conectarsistema, int $IdProductos): bool
    {
        // Inicializar valores por defecto
        $this->setIdProductos(0);
        $this->setCodigoProductos('');
        $this->setNombreProductos('');
        $this->setDescripcionProductos('');
        $this->setRequisitosProductos('');
        $this->setEstadoProductos('');

        try {
            // Validar ID de producto
            if ($IdProductos <= 0) {
                throw new InvalidArgumentException("ID de producto inválido");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultaGeneralProductosRegistrados(?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("i", $IdProductos);
            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();

                // Asignar valores con validación
                $this->setIdProductos((int)($Gestiones['idproducto'] ?? 0));
                $this->setCodigoProductos($this->sanitizeString($Gestiones['codigo'] ?? ''));
                $this->setNombreProductos($this->sanitizeString($Gestiones['nombreproducto'] ?? ''));
                $this->setDescripcionProductos($this->sanitizeString($Gestiones['descripcionproducto'] ?? ''));
                $this->setRequisitosProductos($this->sanitizeString($Gestiones['requisitosproductos'] ?? ''));
                $this->setEstadoProductos($this->sanitizeString($Gestiones['estado'] ?? ''));
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultaGeneralProductos: " . $e->getMessage());
            return false;
        }
    }
    // REGISTRAR NUEVOS PRODUCTOS CASHMANHA -> USO EXCLUSIVO ROL [ADMINISTRADORES]
    public function RegistroNuevosProductos($conectarsistema, $CodigoProductos, $NombreProductos, $DescripcionProductos, $RequisitosProductos, $EstadoProductos)
    {
        $resultado = mysqli_query($conectarsistema, "CALL RegistrarNuevosProductosCashManHa('" . $CodigoProductos . "','" . $NombreProductos . "','" . $DescripcionProductos . "','" . $RequisitosProductos . "','" . $EstadoProductos . "');");
        return $resultado;
    }
    // CONSULTA GENERAL DE PRODUCTOS REGISTRADOS CASHMANHA [ACTIVOS] -> EMPLEADOS - ADMINISTRADOR
    public function ConsultarProductosCashManHA_Activos($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultarProductosCashManHARegistrados_Activos()");
        return $resultado;
    }
    // CONSULTA GENERAL DE PRODUCTOS REGISTRADOS CASHMANHA [INACTIVOS] -> EMPLEADOS - ADMINISTRADOR
    public function ConsultarProductosCashManHA_Inactivos($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultarProductosCashManHARegistrados_Inactivos()");
        return $resultado;
    }
    // CONSULTA GENERAL DE PRODUCTOS REGISTRADOS CASHMANHA [EXPIRADOS] -> EMPLEADOS - ADMINISTRADOR
    public function ConsultarProductosCashManHA_Expirados($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultarProductosCashManHARegistrados_Expirados()");
        return $resultado;
    }
    // ACTIVAR PRODUCTOS REGISTRADOS -> ADMINISTRADORES, PRESIDENCIA, GERENCIA
    public function ActivarProductosCashmanHa($conectarsistema, $IdProductos)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ActivarProductosCashManHa('" . $IdProductos . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // DESACTIVAR PRODUCTOS REGISTRADOS -> ADMINISTRADORES, PRESIDENCIA, GERENCIA
    public function DesactivarProductosCashmanHa($conectarsistema, $IdProductos)
    {
        $resultado = mysqli_query($conectarsistema, "CALL DesactivarProductosCashmanHa('" . $IdProductos . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // EXPIRAR PRODUCTOS REGISTRADOS -> ADMINISTRADORES, PRESIDENCIA, GERENCIA
    public function ExpirarProductosCashmanHa($conectarsistema, $IdProductos)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ExpirarProductosCashmanHa('" . $IdProductos . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // MODIFICAR PRODUCTOS CASHMANHA -> [ADMINISTRADORES, PRESIDENCIA, GERENCIA]
    public function ModificarProductosRegistrados($conectarsistema, $IdProductos, $CodigoProductos, $NombreProductos, $DescripcionProductos, $RequisitosProductos, $EstadoProductos)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ModificarProductosRegistradosCashManHa('" . $IdProductos . "','" . $CodigoProductos . "','" . $NombreProductos . "','" . $DescripcionProductos . "','" . $RequisitosProductos . "','" . $EstadoProductos . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // CONSULTA LISTADO GENERAL USUARIOS (CLIENTES) -> NUEVAS ASIGNACIONES CREDITOS
    public function ConsultaGeneralClientesNuevosCreditos($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaGeneralListadoClientesNuevosCreditos()");
        return $resultado;
    }
    // CONSULTAR USUARIOS GENERAL -> ASIGNACION DE NUEVOS CREDITOS (GESTOR)
    /**
     * Consulta nuevas asignaciones de créditos para clientes
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultaNuevasAsignacionesCreditosClientes(mysqli $conectarsistema, int $IdUsuarios): bool
    {
        // Inicializar todas las propiedades con valores por defecto
        $this->initializeUserProperties();

        try {
            // Validar ID de usuario
            if ($IdUsuarios <= 0) {
                throw new InvalidArgumentException("ID de usuario inválido");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultaUsuariosGestorNuevosCreditos(?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("i", $IdUsuarios);
            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();
                $this->setUserPropertiesFromResult($Gestiones);
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultaNuevasAsignacionesCreditosClientes: " . $e->getMessage());
            return false;
        }
    }
    /**
     * Inicializa todas las propiedades de usuario con valores por defecto
     */
    private function initializeUserProperties(): void
    {
        // Datos básicos del usuario
        $this->setIdUsuarios(0);
        $this->setNombresUsuarios('');
        $this->setApellidosUsuarios('');
        $this->setCodigoUsuarios('');
        $this->setCorreoUsuarios('');
        $this->setFotoUsuarios('');
        $this->setEstadoUsuarios('');
        $this->setComprobacion_HabilitarNuevasSolicitudesCrediticias(0);

        // Datos personales
        $this->setduiUsuarios('');
        $this->setNitUsuarios('');
        $this->setTelefonoUsuarios('');
        $this->setCelularUsuarios('');
        $this->setTelefonoTrabajoUsuarios('');
        $this->setDireccionUsuarios('');
        $this->setEmpresaUsuarios('');
        $this->setCargoEmpresaUsuarios('');
        $this->setDireccionTrabajoUsuarios('');
        $this->setFechaNacimientoUsuarios('');
        $this->setGeneroUsuarios('');
        $this->setEstadoCivilUsuarios('');

        // Documentos
        $this->setFotoduiFrontalUsuarios('');
        $this->setFotoduiReversoUsuarios('');
        $this->setFotoNitUsuarios('');
        $this->setFotoFirmaUsuarios('');
    }

    /**
     * Establece las propiedades del usuario a partir del resultado de la consulta
     * 
     * @param array $Gestiones Resultado de la consulta
     */
    private function setUserPropertiesFromResult(array $Gestiones): void
    {
        // Datos básicos del usuario
        $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
        $this->setNombresUsuarios($this->sanitizeString($Gestiones['nombres'] ?? ''));
        $this->setApellidosUsuarios($this->sanitizeString($Gestiones['apellidos'] ?? ''));
        $this->setCodigoUsuarios($this->sanitizeString($Gestiones['codigousuario'] ?? ''));
        $this->setCorreoUsuarios($this->sanitizeEmail($Gestiones['correo'] ?? ''));
        $this->setFotoUsuarios($this->sanitizeString($Gestiones['fotoperfil'] ?? ''));
        $this->setEstadoUsuarios($this->sanitizeString($Gestiones['estado_usuario'] ?? ''));
        $this->setComprobacion_HabilitarNuevasSolicitudesCrediticias((int)($Gestiones['habilitarnuevoscreditos'] ?? 0));

        // Datos personales
        $this->setduiUsuarios($this->sanitizeString($Gestiones['dui'] ?? ''));
        $this->setNitUsuarios($this->sanitizeString($Gestiones['nit'] ?? ''));
        $this->setTelefonoUsuarios($this->sanitizePhone($Gestiones['telefono'] ?? ''));
        $this->setCelularUsuarios($this->sanitizePhone($Gestiones['celular'] ?? ''));
        $this->setTelefonoTrabajoUsuarios($this->sanitizePhone($Gestiones['telefonotrabajo'] ?? ''));
        $this->setDireccionUsuarios($this->sanitizeString($Gestiones['direccion'] ?? ''));
        $this->setEmpresaUsuarios($this->sanitizeString($Gestiones['empresa'] ?? ''));
        $this->setCargoEmpresaUsuarios($this->sanitizeString($Gestiones['cargo'] ?? ''));
        $this->setDireccionTrabajoUsuarios($this->sanitizeString($Gestiones['direcciontrabajo'] ?? ''));
        $this->setFechaNacimientoUsuarios($this->sanitizeDate($Gestiones['fechanacimiento'] ?? ''));
        $this->setGeneroUsuarios($this->sanitizeString($Gestiones['genero'] ?? ''));
        $this->setEstadoCivilUsuarios($this->sanitizeString($Gestiones['estadocivil'] ?? ''));

        // Documentos
        $this->setFotoduiFrontalUsuarios($this->sanitizeString($Gestiones['fotoduifrontal'] ?? ''));
        $this->setFotoduiReversoUsuarios($this->sanitizeString($Gestiones['fotoduireverso'] ?? ''));
        $this->setFotoNitUsuarios($this->sanitizeString($Gestiones['fotonit'] ?? ''));
        $this->setFotoFirmaUsuarios($this->sanitizeString($Gestiones['fotofirma'] ?? ''));
    }

    // CONSULTA GENERAL DE PRODUCTOS REGISTRADOS CASHMANHA ACTIVOS -> CAMPO SELECT NUEVOS CREDITOS
    public function ConsultarProductosActivosNuevosCreditos($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultarProductosDisponibles_NuevosCreditos()");
        return $resultado;
    }
    // REGISTRO NUEVAS ASIGNACIONES PRESTAMOS CLIENTES -> [TODOS LOS USUARIOS ADMINISTRATIVOS]
    // VALIDO PARA PRESTAMOS PERSONALES, HIPOTECARIOS Y VEHICULOS
    public function RegistroNuevaAsignacionesCreditosClientes($conectarsistema, $IdUsuarios, $IdProductos, $TipoCliente, $MontoCredito, $InteresCredito, $PlazoCredito, $CuotaMensualCredito, $FechaSolicitud, $SalarioCliente, $SaldoActualCreditos, $ObservacionesCredito, $CodigoEmpleadoGestion, $TipoPago, $TipoAmortizacion)
    {
        // Primero, intentamos insertar el nuevo registro
        $resultado = mysqli_query($conectarsistema, "CALL IngresoSolicitudNuevosPrestamosClientes_NuevasAsignaciones('" . $IdUsuarios . "','" . $IdProductos . "','" . $TipoCliente . "','" . $MontoCredito . "','" . $InteresCredito . "','" . $PlazoCredito . "','" . $CuotaMensualCredito . "','" . $FechaSolicitud . "','" . $SalarioCliente . "','" . $SaldoActualCreditos . "','" . $ObservacionesCredito . "','" . $CodigoEmpleadoGestion . "','" . $TipoPago . "','" . $TipoAmortizacion . "');");

        if ($resultado) {
            // Si la inserción fue exitosa, actualizamos el interés
            $stmt = $conectarsistema->prepare("UPDATE creditos SET interescredito = ? WHERE idusuarios = ? ORDER BY idcreditos DESC LIMIT 1");
            $stmt->bind_param("di", $InteresCredito, $IdUsuarios);
            $actualizacion = $stmt->execute();

            if ($actualizacion) {
                return "OK";
            } else {
                return "ERROR EN ACTUALIZACIÓN";
            }
        } else {
            return "ERROR EN INSERCIÓN";
        }
    }
    // REGISTRO NUEVAS REFERENCIAS PERSONALES / LABORALES -> [TODOS LOS USUARIOS ADMINISTRATIVOS]
    public function RegistroNuevasReferenciasPersonalesLaborales($conectarsistema, $IdCreditos, $IdUsuarios, $IdProductos, $NombresReferenciaPersonal, $ApellidosReferenciaPersonal, $EmpresaReferenciaPersonal, $ProfesionOficioReferenciaPersonal, $TelefonoReferenciaPersonal, $NombresReferenciaLaboral, $ApellidosReferenciaLaboral, $EmpresaReferenciaLaboral, $ProfesionOficioReferenciaLaboral, $TelefonoReferenciaLaboral)
    {
        $resultado = mysqli_query($conectarsistema, "CALL RegistroNuevasReferenciasPersonalesLaboralesClientes('" . $IdCreditos . "','" . $IdUsuarios . "','" . $IdProductos . "','" . $NombresReferenciaPersonal . "','" . $ApellidosReferenciaPersonal . "','" . $EmpresaReferenciaPersonal . "','" . $ProfesionOficioReferenciaPersonal . "','" . $TelefonoReferenciaPersonal . "','" . $NombresReferenciaLaboral . "','" . $ApellidosReferenciaLaboral . "','" . $EmpresaReferenciaLaboral . "','" . $ProfesionOficioReferenciaLaboral . "','" . $TelefonoReferenciaLaboral . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // CONSULTA CONFIRMACION INGRESO REFERENCIAS PERSONALES -> ASOCIADO AL PRODUCTO QUE SE HA GESTIONADO PERVIAMENTE
    public function ConsultaConfirmacionReferenciasPersonalesLaboralesClientes($conectarsistema, $IdUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaConfirmacionIngresoReferenciasPersonalesClientes('" . $IdUsuarios . "')");
        return $resultado;
    }
    // CONSULTA DE ID UNICO DE CREDITO ASIGNADO Y PRODUCTO ASOCIADO CLIENTES
    /**
     * Consulta ID único de créditos para clientes
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultaIdUnicoCreditosClientes(mysqli $conectarsistema, int $IdUsuarios): bool
    {
        // Inicializar propiedades relacionadas con créditos
        $this->setIdCreditoAuxiliar(0);
        $this->setIdProductos(0);
        $this->setNombreProductos('');
        $this->setProgresoInicialSolicitudCreditos('');

        try {
            // Validar ID de usuario
            if ($IdUsuarios <= 0) {
                throw new InvalidArgumentException("ID de usuario inválido");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultaIdUnicoCreditos_ProductosClientes(?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("i", $IdUsuarios);
            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();

                // Asignar valores con validación
                $this->setIdCreditoAuxiliar((int)($Gestiones['idcreditos'] ?? 0));
                $this->setIdProductos((int)($Gestiones['idproducto'] ?? 0));
                $this->setNombreProductos($this->sanitizeString($Gestiones['nombreproducto'] ?? ''));
                $this->setProgresoInicialSolicitudCreditos($this->sanitizeString($Gestiones['progreso_solicitud'] ?? ''));
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultaIdUnicoCreditosClientes: " . $e->getMessage());
            return false;
        }
    }


    // CONSULTA DE ID UNICO DE CREDITO ASIGNADO Y PRODUCTO ASOCIADO CLIENTES
    /**
     * Consulta la existencia de referencias para clientes
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultaExistenciasReferenciasClientes(mysqli $conectarsistema, int $IdUsuarios): bool
    {
        // Inicializar todas las propiedades con valores por defecto
        $this->initializeReferenceProperties();

        try {
            // Validar ID de usuario
            if ($IdUsuarios <= 0) {
                throw new InvalidArgumentException("ID de usuario inválido");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultarExistenciasReferenciasClientesCreditos(?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("i", $IdUsuarios);
            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();
                $this->setReferencePropertiesFromResult($Gestiones);
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultaExistenciasReferenciasClientes: " . $e->getMessage());
            return false;
        }
    }
    /**
     * Inicializa propiedades relacionadas con referencias
     */
    private function initializeReferenceProperties(): void
    {
        $this->setIdReferenciasClientes(0);
        $this->setIdCreditoAuxiliar(0);
        $this->setIdUsuarios(0);
        $this->setIdProductos(0);

        // Referencia personal
        $this->setNombresReferenciaPersonal('');
        $this->setApellidosReferenciaPersonal('');
        $this->setEmpresaReferenciaPersonal('');
        $this->setProfesionOficioReferenciaPersonal('');
        $this->setTelefonoReferenciaPersonal('');

        // Referencia laboral
        $this->setNombresReferenciaLaboral('');
        $this->setApellidosReferenciaLaboral('');
        $this->setEmpresaReferenciaLaboral('');
        $this->setProfesionOficioReferenciaLaboral('');
        $this->setTelefonoReferenciaLaboral('');
    }

    /**
     * Establece propiedades de referencias desde resultados
     */
    private function setReferencePropertiesFromResult(array $Gestiones): void
    {
        $this->setIdReferenciasClientes((int)($Gestiones['idreferencias'] ?? 0));
        $this->setIdCreditoAuxiliar((int)($Gestiones['idcreditos'] ?? 0));
        $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
        $this->setIdProductos((int)($Gestiones['idproducto'] ?? 0));

        // Referencia personal
        $this->setNombresReferenciaPersonal($this->sanitizeString($Gestiones['nombres_referencia1'] ?? ''));
        $this->setApellidosReferenciaPersonal($this->sanitizeString($Gestiones['apellidos_referencia1'] ?? ''));
        $this->setEmpresaReferenciaPersonal($this->sanitizeString($Gestiones['empresa_referencia1'] ?? ''));
        $this->setProfesionOficioReferenciaPersonal($this->sanitizeString($Gestiones['profesion_oficioreferencia1'] ?? ''));
        $this->setTelefonoReferenciaPersonal($this->sanitizePhone($Gestiones['telefono_referencia1'] ?? ''));

        // Referencia laboral
        $this->setNombresReferenciaLaboral($this->sanitizeString($Gestiones['nombres_referencia2'] ?? ''));
        $this->setApellidosReferenciaLaboral($this->sanitizeString($Gestiones['apellidos_referencia2'] ?? ''));
        $this->setEmpresaReferenciaLaboral($this->sanitizeString($Gestiones['empresa_referencia2'] ?? ''));
        $this->setProfesionOficioReferenciaLaboral($this->sanitizeString($Gestiones['profesion_oficioreferencia2'] ?? ''));
        $this->setTelefonoReferenciaLaboral($this->sanitizePhone($Gestiones['telefono_referencia2'] ?? ''));
    }
    // REGISTRO NUEVAS REFERENCIAS PERSONALES / LABORALES -> [TODOS LOS USUARIOS ADMINISTRATIVOS]
    public function ModificarInformacionReferenciasPersonalesLaborales($conectarsistema, $IdReferenciasClientes, $IdCreditos, $IdProductos, $NombresReferenciaPersonal, $ApellidosReferenciaPersonal, $EmpresaReferenciaPersonal, $ProfesionOficioReferenciaPersonal, $TelefonoReferenciaPersonal, $NombresReferenciaLaboral, $ApellidosReferenciaLaboral, $EmpresaReferenciaLaboral, $ProfesionOficioReferenciaLaboral, $TelefonoReferenciaLaboral)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ModificarReferenciasPersonalesLaboralesClientes('" . $IdReferenciasClientes . "','" . $IdCreditos . "','" . $IdProductos . "','" . $NombresReferenciaPersonal . "','" . $ApellidosReferenciaPersonal . "','" . $EmpresaReferenciaPersonal . "','" . $ProfesionOficioReferenciaPersonal . "','" . $TelefonoReferenciaPersonal . "','" . $NombresReferenciaLaboral . "','" . $ApellidosReferenciaLaboral . "','" . $EmpresaReferenciaLaboral . "','" . $ProfesionOficioReferenciaLaboral . "','" . $TelefonoReferenciaLaboral . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // CONSULTA GENERAL DE NUEVAS SOLICITUDES DE CREDITOS -> RECIEN REGISTRADAS CON ESTADO [EN PROCESO]
    public function ConsultarListadoNuevasSolicitudesCreditosClientes($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaUsuariosIngresoNuevasSolicitudesCreditos()");
        return $resultado;
    }
    // CONSULTA GENERAL DE NUEVAS SOLICITUDES DE CREDITOS -> RECIEN REGISTRADAS CON ESTADO [APROBACIOINICIAL] -> LUEGO DE SU PRIMERA REVISION EN GERENCIA
    public function ConsultarListadoNuevasSolicitudesCreditosUltimaRevision($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaUsuariosIngresoNuevasSolicitudesCreditosUltimaRevision()");
        return $resultado;
    }
    // CONSULTA GENERAL DE NUEVAS SOLICITUDES DE CREDITOS -> RECIEN REGISTRADAS CON ESTADO [APROBADAS]
    public function ConsultarListadoSolicitudesCreditosClientesAprobadas($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaSolicitudesCreditosAprobadas()");
        return $resultado;
    }
    /**
     * Consulta para primera revisión de nuevas solicitudes de crédito de clientes
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultaPrimeraRevisionNuevasSolicitudesCreditosClientes(mysqli $conectarsistema, int $IdUsuarios): bool
    {
        return $this->executeCreditQuery(
            $conectarsistema,
            $IdUsuarios,
            "ConsultaNuevasAsignacioneCreditosClientes_PrimeraRevision",
            "Error en ConsultaPrimeraRevisionNuevasSolicitudesCreditosClientes"
        );
    }

    /**
     * Consulta para segunda revisión de nuevas solicitudes de crédito de clientes
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultaSegundaRevisionNuevasSolicitudesCreditosClientes(mysqli $conectarsistema, int $IdUsuarios): bool
    {
        return $this->executeCreditQuery(
            $conectarsistema,
            $IdUsuarios,
            "ConsultaNuevasAsignacioneCreditosClientes_SegundaRevision",
            "Error en ConsultaSegundaRevisionNuevasSolicitudesCreditosClientes"
        );
    }

    /**
     * Consulta para reestructuración de créditos de clientes
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultaReestructuracionNuevasSolicitudesCreditosClientes(mysqli $conectarsistema, int $IdUsuarios): bool
    {
        return $this->executeCreditQuery(
            $conectarsistema,
            $IdUsuarios,
            "ConsultaReestructuracionesCreditosNuevasSolicitudesClientes",
            "Error en ConsultaReestructuracionNuevasSolicitudesCreditosClientes"
        );
    }

    /**
     * Método común para ejecutar consultas de crédito
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @param string $storedProcedure Nombre del procedimiento almacenado
     * @param string $errorContext Contexto para mensajes de error
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    private function executeCreditQuery(mysqli $conectarsistema, int $IdUsuarios, string $storedProcedure, string $errorContext): bool
    {
        // Inicializar todas las propiedades con valores por defecto
        $this->initializeCreditProperties();

        try {
            // Validar ID de usuario
            if ($IdUsuarios <= 0) {
                throw new InvalidArgumentException("ID de usuario inválido");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL $storedProcedure(?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("i", $IdUsuarios);
            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();
                $this->setCreditPropertiesFromResult($Gestiones);
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("$errorContext: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Inicializa todas las propiedades relacionadas con créditos con valores por defecto
     */
    private function initializeCreditProperties(): void
    {
        // Datos básicos del crédito
        $this->setIdUsuarios(0);
        $this->setIdCreditos(0);
        $this->setIdProductos(0);
        $this->setTipoClienteCreditos('');
        $this->setMontoFinanciamientoCreditos(0.0);
        $this->setTasaInteresCreditos(0.0);
        $this->setTipoAmortizacion('');
        $this->setTipoPago('');
        $this->setTiempoPlazoCreditos(0);
        $this->setCuotaMensualCreditos(0.0);
        $this->setFechaIngresoSolicitudCreditos('');
        $this->setSalarioClienteCreditos(0.0);
        $this->setNombreProductos('');
        $this->setProgresoInicialSolicitudCreditos('');
        $this->setEstadoActualCreditos('');
        $this->setObservacionesEmpleadosCreditos('');
        $this->setObservacionesGerenciaCreditos('');
        $this->setEmpleadoRegistroCredito('');
        $this->setCodigoProductos('');

        // Datos del usuario
        $this->setNombresUsuarios('');
        $this->setApellidosUsuarios('');
        $this->setCodigoUsuarios('');
        $this->setFotoUsuarios('');
        $this->setIdRolUsuarios(0);
        $this->setduiUsuarios('');
        $this->setNitUsuarios('');
        $this->setTelefonoUsuarios('');
        $this->setCelularUsuarios('');
        $this->setDireccionUsuarios('');
        $this->setEmpresaUsuarios('');
        $this->setCargoEmpresaUsuarios('');
        $this->setDireccionTrabajoUsuarios('');
        $this->setFechaNacimientoUsuarios('');

        // Referencias personales y laborales
        $this->setNombresReferenciaPersonal('');
        $this->setApellidosReferenciaPersonal('');
        $this->setEmpresaReferenciaPersonal('');
        $this->setProfesionOficioReferenciaPersonal('');
        $this->setTelefonoReferenciaPersonal('');
        $this->setNombresReferenciaLaboral('');
        $this->setApellidosReferenciaLaboral('');
        $this->setEmpresaReferenciaLaboral('');
        $this->setProfesionOficioReferenciaLaboral('');
        $this->setTelefonoReferenciaLaboral('');
    }

    /**
     * Establece las propiedades del crédito a partir del resultado de la consulta
     * 
     * @param array $Gestiones Resultado de la consulta
     */
    private function setCreditPropertiesFromResult(array $Gestiones): void
    {
        // Datos básicos del crédito
        $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
        $this->setIdCreditos((int)($Gestiones['idcreditos'] ?? 0));
        $this->setIdProductos((int)($Gestiones['idproducto'] ?? 0));
        $this->setTipoClienteCreditos($this->sanitizeString($Gestiones['tipocliente'] ?? ''));
        $this->setMontoFinanciamientoCreditos((float)($Gestiones['montocredito'] ?? 0.0));
        $this->setTasaInteresCreditos((float)($Gestiones['interescredito'] ?? 0.0));
        $this->setTipoAmortizacion($this->sanitizeString($Gestiones['tipo_amortizacion'] ?? ''));
        $this->setTipoPago($this->sanitizeString($Gestiones['tipo_pago'] ?? ''));
        $this->setTiempoPlazoCreditos((int)($Gestiones['plazocredito'] ?? 0));
        $this->setCuotaMensualCreditos((float)($Gestiones['cuotamensual'] ?? 0.0));
        $this->setFechaIngresoSolicitudCreditos($this->sanitizeDate($Gestiones['fechasolicitud'] ?? ''));
        $this->setSalarioClienteCreditos((float)($Gestiones['salariocliente'] ?? 0.0));
        $this->setNombreProductos($this->sanitizeString($Gestiones['nombreproducto'] ?? ''));
        $this->setProgresoInicialSolicitudCreditos($this->sanitizeString($Gestiones['progreso_solicitud'] ?? ''));
        $this->setEstadoActualCreditos($this->sanitizeString($Gestiones['estado'] ?? ''));
        $this->setObservacionesEmpleadosCreditos($this->sanitizeString($Gestiones['observaciones'] ?? ''));
        $this->setObservacionesGerenciaCreditos($this->sanitizeString($Gestiones['observacion_gerencia'] ?? ''));
        $this->setEmpleadoRegistroCredito($this->sanitizeString($Gestiones['usuario_empleado'] ?? ''));
        $this->setCodigoProductos($this->sanitizeString($Gestiones['codigo'] ?? ''));

        // Datos del usuario
        $this->setNombresUsuarios($this->sanitizeString($Gestiones['nombres'] ?? ''));
        $this->setApellidosUsuarios($this->sanitizeString($Gestiones['apellidos'] ?? ''));
        $this->setCodigoUsuarios($this->sanitizeString($Gestiones['codigousuario'] ?? ''));
        $this->setFotoUsuarios($this->sanitizeString($Gestiones['fotoperfil'] ?? ''));
        $this->setIdRolUsuarios((int)($Gestiones['idrol'] ?? 0));
        $this->setduiUsuarios($this->sanitizeString($Gestiones['dui'] ?? ''));
        $this->setNitUsuarios($this->sanitizeString($Gestiones['nit'] ?? ''));
        $this->setTelefonoUsuarios($this->sanitizePhone($Gestiones['telefono'] ?? ''));
        $this->setCelularUsuarios($this->sanitizePhone($Gestiones['celular'] ?? ''));
        $this->setDireccionUsuarios($this->sanitizeString($Gestiones['direccion'] ?? ''));
        $this->setEmpresaUsuarios($this->sanitizeString($Gestiones['empresa'] ?? ''));
        $this->setCargoEmpresaUsuarios($this->sanitizeString($Gestiones['cargo'] ?? ''));
        $this->setDireccionTrabajoUsuarios($this->sanitizeString($Gestiones['direcciontrabajo'] ?? ''));
        $this->setFechaNacimientoUsuarios($this->sanitizeDate($Gestiones['fechanacimiento'] ?? ''));

        // Referencias personales y laborales
        $this->setNombresReferenciaPersonal($this->sanitizeString($Gestiones['nombres_referencia1'] ?? ''));
        $this->setApellidosReferenciaPersonal($this->sanitizeString($Gestiones['apellidos_referencia1'] ?? ''));
        $this->setEmpresaReferenciaPersonal($this->sanitizeString($Gestiones['empresa_referencia1'] ?? ''));
        $this->setProfesionOficioReferenciaPersonal($this->sanitizeString($Gestiones['profesion_oficioreferencia1'] ?? ''));
        $this->setTelefonoReferenciaPersonal($this->sanitizePhone($Gestiones['telefono_referencia1'] ?? ''));
        $this->setNombresReferenciaLaboral($this->sanitizeString($Gestiones['nombres_referencia2'] ?? ''));
        $this->setApellidosReferenciaLaboral($this->sanitizeString($Gestiones['apellidos_referencia2'] ?? ''));
        $this->setEmpresaReferenciaLaboral($this->sanitizeString($Gestiones['empresa_referencia2'] ?? ''));
        $this->setProfesionOficioReferenciaLaboral($this->sanitizeString($Gestiones['profesion_oficioreferencia2'] ?? ''));
        $this->setTelefonoReferenciaLaboral($this->sanitizePhone($Gestiones['telefono_referencia2'] ?? ''));
    }
    /*
            -> VALIDO UNICAMENTE PARA GENERADOR DE CUOTAS MENSUALES Y CONTRATOS FINALES CLIENTES
    */
    // CONSULTA DE CREDITOS QUE NECESITAN SER REESTRUCTURADOS -> ASOCIADO AL PRODUCTO QUE SE HA GESTIONADO PERVIAMENTE [GESTIONAR SOLICITUDES]
    /**
     * Consulta datos de solicitudes de créditos aprobados para clientes
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultaDatosSolicitudesCreditosClientesAprobados(mysqli $conectarsistema, int $IdUsuarios): bool
    {
        // Inicializar todas las propiedades con valores por defecto
        $this->initializeCreditApprovedProperties();

        try {
            // Validar ID de usuario
            if ($IdUsuarios <= 0) {
                throw new InvalidArgumentException("ID de usuario inválido");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultaGestionadorCuotasMensualesContratos_CreditosAprobados(?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("i", $IdUsuarios);
            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();
                $this->setCreditApprovedPropertiesFromResult($Gestiones);
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultaDatosSolicitudesCreditosClientesAprobados: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Inicializa todas las propiedades relacionadas con créditos aprobados con valores por defecto
     */
    private function initializeCreditApprovedProperties(): void
    {
        // Datos básicos del crédito
        $this->setIdUsuarios(0);
        $this->setIdCreditos(0);
        $this->setIdProductos(0);
        $this->setTipoClienteCreditos('');
        $this->setMontoFinanciamientoCreditos(0.0);
        $this->setSaldoActualCreditos(0.0);
        $this->setTasaInteresCreditos(0.0);
        $this->setTipoAmortizacion('');
        $this->setTipoPago('');
        $this->setTiempoPlazoCreditos(0);
        $this->setCuotaMensualCreditos(0.0);
        $this->setComprobacion_EnviarAlHistoricoClientes(0);
        $this->setFechaIngresoSolicitudCreditos('');
        $this->setSalarioClienteCreditos(0.0);
        $this->setNombreProductos('');
        $this->setProgresoInicialSolicitudCreditos('');
        $this->setComprobarEstadoCuotasMensuales(0);
        $this->setEstadoActualCreditos('');
        $this->setComprobacion_ProcesoFinalizadoClientes(0);
        $this->setObservacionesEmpleadosCreditos('');
        $this->setObservacionesGerenciaCreditos('');
        $this->setEmpleadoRegistroCredito('');
        $this->setEstadoCrediticioClientes('');
        $this->setCodigoProductos('');

        // Datos del usuario
        $this->setNombresUsuarios('');
        $this->setApellidosUsuarios('');
        $this->setCodigoUsuarios('');
        $this->setFotoUsuarios('');
        $this->setIdRolUsuarios(0);
        $this->setduiUsuarios('');
        $this->setNitUsuarios('');
        $this->setTelefonoUsuarios('');
        $this->setCelularUsuarios('');
        $this->setDireccionUsuarios('');
        $this->setEmpresaUsuarios('');
        $this->setCargoEmpresaUsuarios('');
        $this->setDireccionTrabajoUsuarios('');
        $this->setFechaNacimientoUsuarios('');

        // Referencias personales y laborales
        $this->setNombresReferenciaPersonal('');
        $this->setApellidosReferenciaPersonal('');
        $this->setEmpresaReferenciaPersonal('');
        $this->setProfesionOficioReferenciaPersonal('');
        $this->setTelefonoReferenciaPersonal('');
        $this->setNombresReferenciaLaboral('');
        $this->setApellidosReferenciaLaboral('');
        $this->setEmpresaReferenciaLaboral('');
        $this->setProfesionOficioReferenciaLaboral('');
        $this->setTelefonoReferenciaLaboral('');
    }

    /**
     * Establece las propiedades de créditos aprobados a partir del resultado de la consulta
     * 
     * @param array $Gestiones Resultado de la consulta
     */
    private function setCreditApprovedPropertiesFromResult(array $Gestiones): void
    {
        // Datos básicos del crédito
        $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
        $this->setIdCreditos((int)($Gestiones['idcreditos'] ?? 0));
        $this->setIdProductos((int)($Gestiones['idproducto'] ?? 0));
        $this->setTipoClienteCreditos($this->sanitizeString($Gestiones['tipocliente'] ?? ''));
        $this->setMontoFinanciamientoCreditos((float)($Gestiones['montocredito'] ?? 0.0));
        $this->setSaldoActualCreditos((float)($Gestiones['saldocredito'] ?? 0.0));
        $this->setTasaInteresCreditos((float)($Gestiones['interescredito'] ?? 0.0));
        $this->setTipoAmortizacion($this->sanitizeString($Gestiones['tipo_amortizacion'] ?? ''));
        $this->setTipoPago($this->sanitizeString($Gestiones['tipo_pago'] ?? ''));
        $this->setTiempoPlazoCreditos((int)($Gestiones['plazocredito'] ?? 0));
        $this->setCuotaMensualCreditos((float)($Gestiones['cuotamensual'] ?? 0.0));
        $this->setComprobacion_EnviarAlHistoricoClientes((int)($Gestiones['enviaralhistorico'] ?? 0));
        $this->setFechaIngresoSolicitudCreditos($this->sanitizeDate($Gestiones['fechasolicitud'] ?? ''));
        $this->setSalarioClienteCreditos((float)($Gestiones['salariocliente'] ?? 0.0));
        $this->setNombreProductos($this->sanitizeString($Gestiones['nombreproducto'] ?? ''));
        $this->setProgresoInicialSolicitudCreditos($this->sanitizeString($Gestiones['progreso_solicitud'] ?? ''));
        $this->setComprobarEstadoCuotasMensuales((int)($Gestiones['cuotas_generadas'] ?? 0));
        $this->setEstadoActualCreditos($this->sanitizeString($Gestiones['estado'] ?? ''));
        $this->setComprobacion_ProcesoFinalizadoClientes((int)($Gestiones['proceso_finalizado'] ?? 0));
        $this->setObservacionesEmpleadosCreditos($this->sanitizeString($Gestiones['observaciones'] ?? ''));
        $this->setObservacionesGerenciaCreditos($this->sanitizeString($Gestiones['observacion_gerencia'] ?? ''));
        $this->setEmpleadoRegistroCredito($this->sanitizeString($Gestiones['usuario_empleado'] ?? ''));
        $this->setEstadoCrediticioClientes($this->sanitizeString($Gestiones['estadocrediticio'] ?? ''));
        $this->setCodigoProductos($this->sanitizeString($Gestiones['codigo'] ?? ''));

        // Datos del usuario
        $this->setNombresUsuarios($this->sanitizeString($Gestiones['nombres'] ?? ''));
        $this->setApellidosUsuarios($this->sanitizeString($Gestiones['apellidos'] ?? ''));
        $this->setCodigoUsuarios($this->sanitizeString($Gestiones['codigousuario'] ?? ''));
        $this->setFotoUsuarios($this->sanitizeString($Gestiones['fotoperfil'] ?? ''));
        $this->setIdRolUsuarios((int)($Gestiones['idrol'] ?? 0));
        $this->setduiUsuarios($this->sanitizeString($Gestiones['dui'] ?? ''));
        $this->setNitUsuarios($this->sanitizeString($Gestiones['nit'] ?? ''));
        $this->setTelefonoUsuarios($this->sanitizePhone($Gestiones['telefono'] ?? ''));
        $this->setCelularUsuarios($this->sanitizePhone($Gestiones['celular'] ?? ''));
        $this->setDireccionUsuarios($this->sanitizeString($Gestiones['direccion'] ?? ''));
        $this->setEmpresaUsuarios($this->sanitizeString($Gestiones['empresa'] ?? ''));
        $this->setCargoEmpresaUsuarios($this->sanitizeString($Gestiones['cargo'] ?? ''));
        $this->setDireccionTrabajoUsuarios($this->sanitizeString($Gestiones['direcciontrabajo'] ?? ''));
        $this->setFechaNacimientoUsuarios($this->sanitizeDate($Gestiones['fechanacimiento'] ?? ''));

        // Referencias personales y laborales
        $this->setNombresReferenciaPersonal($this->sanitizeString($Gestiones['nombres_referencia1'] ?? ''));
        $this->setApellidosReferenciaPersonal($this->sanitizeString($Gestiones['apellidos_referencia1'] ?? ''));
        $this->setEmpresaReferenciaPersonal($this->sanitizeString($Gestiones['empresa_referencia1'] ?? ''));
        $this->setProfesionOficioReferenciaPersonal($this->sanitizeString($Gestiones['profesion_oficioreferencia1'] ?? ''));
        $this->setTelefonoReferenciaPersonal($this->sanitizePhone($Gestiones['telefono_referencia1'] ?? ''));
        $this->setNombresReferenciaLaboral($this->sanitizeString($Gestiones['nombres_referencia2'] ?? ''));
        $this->setApellidosReferenciaLaboral($this->sanitizeString($Gestiones['apellidos_referencia2'] ?? ''));
        $this->setEmpresaReferenciaLaboral($this->sanitizeString($Gestiones['empresa_referencia2'] ?? ''));
        $this->setProfesionOficioReferenciaLaboral($this->sanitizeString($Gestiones['profesion_oficioreferencia2'] ?? ''));
        $this->setTelefonoReferenciaLaboral($this->sanitizePhone($Gestiones['telefono_referencia2'] ?? ''));
    }
    /*
            -> VALIDO UNICAMENTE PARA SOLICITUDES DE CREDITOS YA CANCELADAS
        */
    // CONSULTA DE CREDITOS CANCELADOS -> ENVIADOS AL HISTORICO
    /**
     * Consulta datos históricos de solicitudes de crédito para clientes
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @param int $IdCreditos ID del crédito
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultaDatosSolicitudesCreditosClientesHistorico(
        mysqli $conectarsistema,
        int $IdUsuarios,
        int $IdCreditos
    ): bool {
        // Inicializar propiedades con valores por defecto
        $this->initializeCreditHistoryProperties();

        try {
            // Validar parámetros de entrada
            if ($IdUsuarios <= 0 || $IdCreditos <= 0) {
                throw new InvalidArgumentException("ID de usuario o crédito inválido");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultaDatosSolicitudCrediticiaClientes_Historicos(?, ?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("ii", $IdUsuarios, $IdCreditos);
            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();
                $this->setCreditHistoryPropertiesFromResult($Gestiones);
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultaDatosSolicitudesCreditosClientesHistorico: " . $e->getMessage());
            return false;
        }
    }
    /**
     * Inicializa propiedades de historial de créditos
     */
    private function initializeCreditHistoryProperties(): void
    {
        $this->setIdUsuarios(0);
        $this->setIdProductos(0);
        $this->setMontoFinanciamientoCreditos(0.0);
        $this->setTasaInteresCreditos(0.0);
        $this->setTiempoPlazoCreditos(0);
        $this->setCuotaMensualCreditos(0.0);
        $this->setNombreProductos('');
        $this->setEstadoActualCreditos('');
        $this->setNombresUsuarios('');
        $this->setApellidosUsuarios('');
        $this->setFotoUsuarios('');
    }

    /**
     * Establece propiedades de historial de créditos desde resultados
     */
    private function setCreditHistoryPropertiesFromResult(array $Gestiones): void
    {
        $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
        $this->setIdProductos((int)($Gestiones['idproducto'] ?? 0));
        $this->setMontoFinanciamientoCreditos((float)($Gestiones['montocredito'] ?? 0.0));
        $this->setTasaInteresCreditos((float)($Gestiones['interescredito'] ?? 0.0));
        $this->setTiempoPlazoCreditos((int)($Gestiones['plazocredito'] ?? 0));
        $this->setCuotaMensualCreditos((float)($Gestiones['cuotamensual'] ?? 0.0));
        $this->setNombreProductos($this->sanitizeString($Gestiones['nombreproducto'] ?? ''));
        $this->setEstadoActualCreditos($this->sanitizeString($Gestiones['estado'] ?? ''));
        $this->setNombresUsuarios($this->sanitizeString($Gestiones['nombres'] ?? ''));
        $this->setApellidosUsuarios($this->sanitizeString($Gestiones['apellidos'] ?? ''));
        $this->setFotoUsuarios($this->sanitizeString($Gestiones['fotoperfil'] ?? ''));
    }
    // CONSULTA DISPONIBILIDAD ASIGNACION NUEVAS SOLICITUDES CREDITICIAS CLIENTES [HABILITAR ESTADO DE CUENTA]
    /**
     * Consulta disponibilidad para asignación de nuevas solicitudes crediticias
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultarDisponibilidadAsignacionNuevasSolicitudesCrediticias(mysqli $conectarsistema, int $IdUsuarios): bool
    {
        // Inicializar propiedades con valores por defecto
        $this->setIdUsuarios(0);
        $this->setNombresUsuarios('');
        $this->setApellidosUsuarios('');
        $this->setComprobacion_HabilitarNuevasSolicitudesCrediticias(0);

        try {
            // Validar ID de usuario
            if ($IdUsuarios <= 0) {
                throw new InvalidArgumentException("ID de usuario inválido");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ComprobacionRegistroNuevasSolicitudesCrediticias_Clientes(?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("i", $IdUsuarios);
            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();

                // Asignar valores con validación
                $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
                $this->setNombresUsuarios($this->sanitizeString($Gestiones['nombres'] ?? ''));
                $this->setApellidosUsuarios($this->sanitizeString($Gestiones['apellidos'] ?? ''));
                $this->setComprobacion_HabilitarNuevasSolicitudesCrediticias(
                    (int)($Gestiones['habilitarnuevoscreditos'] ?? 0)
                );
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultarDisponibilidadAsignacionNuevasSolicitudesCrediticias: " . $e->getMessage());
            return false;
        }
    }
    // ACTUALIZACION DE DATOS CLIENTES, PRIMERA REVISION DE SOLICITUDES NUEVAS DE CREDITOS -> [TODOS LOS USUARIOS ADMINISTRATIVOS]
    // VALIDO PARA PRESTAMOS PERSONALES, HIPOTECARIOS Y VEHICULOS
    public function ActualizacionPrimeraRevisionNuevaAsignacionesCreditosClientes($conectarsistema, $IdCreditos, $TipoCliente, $MontoCredito, $PlazoCredito, $CuotaMensualCredito, $SalarioCliente, $NuevoSaldoCreditosClientes, $EstadoActualCreditos, $ObservacionesCreditoGerencia, $ProgresoInicialSolicitudCreditos, $FechaUltimaActualizacionRevision, $CodigoEmpleadoGestion, $TipoPago, $TipoAmortizacion)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ActualizacionDatosNuevasSolicitudesCreditos_PrimeraRevision('" . $IdCreditos . "','" . $TipoCliente . "','" . $MontoCredito . "','" . $PlazoCredito . "','" . $CuotaMensualCredito . "','" . $SalarioCliente . "','" . $NuevoSaldoCreditosClientes . "','" . $EstadoActualCreditos . "','" . $ObservacionesCreditoGerencia . "','" . $ProgresoInicialSolicitudCreditos . "','" . $FechaUltimaActualizacionRevision . "','" . $CodigoEmpleadoGestion . "','" . $TipoPago . "','" . $TipoAmortizacion . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // ACTUALIZACION DE DATOS CLIENTES, SEGUNDA REVISION DE SOLICITUDES NUEVAS DE CREDITOS -> [SOLAMENTE PRESIDENCIA Y ADMINISTRADORES]
    // VALIDO PARA PRESTAMOS PERSONALES, HIPOTECARIOS Y VEHICULOS
    public function ActualizacionSegundaRevisionNuevaAsignacionesCreditosClientes($conectarsistema, $IdCreditos, $EstadoActualCreditos, $ObservacionesPresidenciaCreditos, $ProgresoInicialSolicitudCreditos, $FechaUltimaActualizacionRevision, $CodigoEmpleadoGestion)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ActualizacionRevisionFinalPresidencia_SolicitudCreditoClientes('" . $IdCreditos . "','" . $EstadoActualCreditos . "','" . $ObservacionesPresidenciaCreditos . "','" . $ProgresoInicialSolicitudCreditos . "','" . $FechaUltimaActualizacionRevision . "','" . $CodigoEmpleadoGestion . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // CONSULTAR DETALLE COMPLETO INICIOS DE SESIONES -> PERFIL DE USUARIOS [TODOS LOS USUARIOS]
    public function ConsultaEspecificaReestructuracionSolicitudesCreditos($conectarsistema, $EmpleadoRegistroCredito)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaEspecificaSolicitudesReestructuracionCreditosClientes('" . $EmpleadoRegistroCredito . "');");
        return $resultado;
    }
    // REGISTRO CUOTAS MENSUALES NUEVOS CREDITOS CLIENTES -> ASOCIADOS SEGUN PRODUCTO ADQUIRIDO
    public function RegistroAsignacionCuotasMensualesClientes($conectarsistema, $IdCreditos, $IdProductos, $IdUsuarios, $CuotaMensualCredito, $NombreProductos, $MontoCapitalCredito, $FechaSolicitud)
    {
        $resultado = mysqli_query($conectarsistema, "CALL RegistrarCuotasMensualesNuevosCreditosClientes('" . $IdCreditos . "','" . $IdProductos . "','" . $IdUsuarios . "','" . $CuotaMensualCredito . "','" . $NombreProductos . "','" . $MontoCapitalCredito . "','" . $FechaSolicitud . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // REGISTRO DE SOLICITUD CREDITICIA CREDITOS CLIENTES -> ASOCIADOS SEGUN PRODUCTO ADQUIRIDO [HISTORICO -> SOLICITUDES CREDITICIAS CANCELADAS AL 100% POR CLIENTES]
    public function RegistroAsignacionSolicitudCrediticiaClientesHistorico($conectarsistema, $IdUsuarios, $IdProductos, $IdCreditos, $MontoCredito, $InteresCredito, $PlazoCredito, $CuotaMensualCredito, $EstadoActualCreditos)
    {
        $resultado = mysqli_query($conectarsistema, "CALL RegistrarSolicitudesCreditosClientesHistorico_Cancelados('" . $IdUsuarios . "','" . $IdProductos . "','" . $IdCreditos . "','" . $MontoCredito . "','" . $InteresCredito . "','" . $PlazoCredito . "','" . $CuotaMensualCredito . "','" . $EstadoActualCreditos . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // REGISTRO CUOTAS MENSUALES NUEVOS CREDITOS CLIENTES -> ASOCIADOS SEGUN PRODUCTO ADQUIRIDO [HISTORICO -> SOLICITUDES CREDITICIAS CANCELADAS AL 100% POR CLIENTES]
    public function RegistroAsignacionCuotasMensualesClientesHistorico($conectarsistema, $IdCreditos, $IdProductos, $IdUsuarios, $CuotaMensualCredito, $NombreProductos, $MontoCapitalCredito, $FechaSolicitud)
    {
        $resultado = mysqli_query($conectarsistema, "CALL RegistrarCuotasMensualesHistoricoCreditosClientes('" . $IdCreditos . "','" . $IdProductos . "','" . $IdUsuarios . "','" . $CuotaMensualCredito . "','" . $NombreProductos . "','" . $MontoCapitalCredito . "','" . $FechaSolicitud . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // REGISTRO DE DATOS DE VEHICULOS -> PREVIO A GENERAR CONTRATO FINAL CLIENTES -> PRESTAMOS DE VEHICULOS
    public function RegistroInformacionVehiculosCreditos($conectarsistema, $IdCreditos, $IdProductos, $IdUsuarios, $Placa, $Clase, $Anio, $Capacidad, $Asientos, $Marca, $Modelo, $NumeroMotor, $NumeroChasisGrabado, $NumeroChasisVin, $Color)
    {
        $resultado = mysqli_query($conectarsistema, "CALL RegistroInformacionVehiculosCreditosClientes('" . $IdCreditos . "','" . $IdProductos . "','" . $IdUsuarios . "','" . $Placa . "','" . $Clase . "','" . $Anio . "','" . $Capacidad . "','" . $Asientos . "','" . $Marca . "','" . $Modelo . "','" . $NumeroMotor . "','" . $NumeroChasisGrabado . "','" . $NumeroChasisVin . "','" . $Color . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // CONSULTA DE CREDITOS QUE NECESITAN SER REESTRUCTURADOS -> ASOCIADO AL PRODUCTO QUE SE HA GESTIONADO PERVIAMENTE [GESTIONAR SOLICITUDES]
    /**
     * Consulta datos de vehículos para préstamos de clientes
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultaDatosVehiculos_PrestamosdeVehiculos(
        mysqli $conectarsistema,
        int $IdUsuarios
    ): bool {
        // Inicializar todas las propiedades con valores por defecto
        $this->initializeVehicleProperties();

        try {
            // Validar ID de usuario
            if ($IdUsuarios <= 0) {
                throw new InvalidArgumentException("ID de usuario inválido");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultaDatosVehiculos_PrestamosdeVehiculosClientes(?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("i", $IdUsuarios);
            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();
                $this->setVehiclePropertiesFromResult($Gestiones);
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultaDatosVehiculos_PrestamosdeVehiculos: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Inicializa propiedades relacionadas con vehículos
     */
    private function initializeVehicleProperties(): void
    {
        $this->setIdDatosVehiculos(0);
        $this->setIdUsuarios(0);
        $this->setIdCreditos(0);
        $this->setIdProductos(0);
        $this->setNumeroPlaca('');
        $this->setClaseVehiculo('');
        $this->setAnioVehiculo(0);
        $this->setCapacidadVehiculo(0);
        $this->setNumeroAsientosVehiculo(0);
        $this->setMarcaVehiculo('');
        $this->setModeloVehiculo('');
        $this->setNumeroMotor('');
        $this->setNumeroChasisGrabado('');
        $this->setNumeroChasisVin('');
        $this->setColorVehiculo('');
    }

    /**
     * Establece propiedades de vehículos desde resultados
     */
    private function setVehiclePropertiesFromResult(array $Gestiones): void
    {
        $this->setIdDatosVehiculos((int)($Gestiones['iddatosvehiculos'] ?? 0));
        $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
        $this->setIdCreditos((int)($Gestiones['idcreditos'] ?? 0));
        $this->setIdProductos((int)($Gestiones['idproducto'] ?? 0));
        $this->setNumeroPlaca($this->sanitizeVehiclePlate($Gestiones['placa'] ?? ''));
        $this->setClaseVehiculo($this->sanitizeString($Gestiones['clase'] ?? ''));
        $this->setAnioVehiculo((int)($Gestiones['anio'] ?? 0));
        $this->setCapacidadVehiculo((int)($Gestiones['capacidad'] ?? 0));
        $this->setNumeroAsientosVehiculo((int)($Gestiones['asientos'] ?? 0));
        $this->setMarcaVehiculo($this->sanitizeString($Gestiones['marca'] ?? ''));
        $this->setModeloVehiculo($this->sanitizeString($Gestiones['modelo'] ?? ''));
        $this->setNumeroMotor($this->sanitizeVehicleNumber($Gestiones['numeromotor'] ?? ''));
        $this->setNumeroChasisGrabado($this->sanitizeVehicleNumber($Gestiones['chasisgrabado'] ?? ''));
        $this->setNumeroChasisVin($this->sanitizeVehicleNumber($Gestiones['chasisvin'] ?? ''));
        $this->setColorVehiculo($this->sanitizeString($Gestiones['color'] ?? ''));
    }

    private function sanitizeVehiclePlate(string $input): string
    {
        // Sanitiza placas de vehículo (formato específico según país)
        return preg_replace('/[^A-Z0-9-]/', '', strtoupper(trim($input)));
    }

    private function sanitizeVehicleNumber(string $input): string
    {
        // Sanitiza números de motor/chasis (solo alfanuméricos y guiones)
        return preg_replace('/[^A-Z0-9-]/', '', strtoupper(trim($input)));
    }
    // REGISTRAR COPIA DE CONTRATO FINAL CLIENTES -> VALIDO PARA TODOS LOS USUARIOS ADMINISTRATIVOS
    public function RegistroCopiaContratoFinalClientes($conectarsistema, $IdCreditos, $NombreArchivo)
    {
        $resultado = mysqli_query($conectarsistema, "CALL RegistroCopiaContratoClientesFinal('" . $IdCreditos . "','" . $NombreArchivo . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // CONSULTAR LISTADO DE CLIENTES QUE NECESITAN REESTRUCTURAR SU SOLICITUD DE CREDITO
    public function ConsultaGeneralClientesReestructuracionCreditos($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaGeneralReestructuracionCreditosClientes();");
        return $resultado;
    }
    // CONSULTAR LISTADO DE CLIENTES QUE SU SOLICITUD DE CREDITO HA SIDO DENEGADA
    public function ConsultaGeneralCreditosDenegadosClientes($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaGeneralSolicitudesCreditosDenegadasClientes();");
        return $resultado;
    }
    // ELIMINAR SOLICITUDES DE CREDITOS TABLA PRINCIPAL ACTIVAS Y ENVIAR AL HISTORICO ESOS DATOS A LA TABLA SECUNDARIA DE CREDITOS [TODO AUTOMATICAMENTE EN CONJUNTO CON UN DISPARADOR // TRIGGER \\]
    public function EnvioSolicitudesCreditosAlHistoricoCreditos($conectarsistema, $IdCreditos)
    {
        $resultado = mysqli_query($conectarsistema, "CALL EnvioHistoricoSolicitudesCreditos('" . $IdCreditos . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // CONSULTAR LISTADO DE SOLICITUDES CREDITICIAS APROBADAS Y QUE SE ENCUENTRAN EN CURSO SEGUN EL X TIEMPO ESTIPULADO Y ACORDADO CON LOS CLIENTES
    public function ConsultaGeneralCreditosAprobadosActivos($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaListadoGeneralCreditosAprobados_EnCurso();");
        return $resultado;
    }
    // CONSULTA ESPECIFICA DE SOLICITUDES DE CREDITOS APROBADAS EN CURSO [ACTIVAS] ACTUALMENTE
    public function ConsultaDatosSolicitudesCreditosAprobadasActivas($conectarsistema, $IdUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaEspecificaSolicitudesCreditosAprobadas_EnCurso('" . $IdUsuarios . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // CONSULTAR LISTADO DE SOLICITUDES CREDITICIAS APROBADAS Y QUE LOS MISMOS HAN CONCLUIDO CON SU RESPONSABILIDAD CREDITICIA [SALDO FINAL $0.00 USD] -> MOTIVO POR EL CUAL SE DENOMINAN CREDITOS CANCELADOS
    public function ConsultaGeneralCreditosAprobadosCancelados($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultarListadoCreditosClientesCancelados();");
        return $resultado;
    }
    // CONSULTAR LISTADO DE SOLICITUDES CREDITICIAS APROBADAS Y QUE LOS MISMOS HAN CONCLUIDO CON SU RESPONSABILIDAD CREDITICIA [SALDO FINAL $0.00 USD] -> MOTIVO POR EL CUAL SE DENOMINAN CREDITOS CANCELADOS [EXCLUSIVAMENTE PARA PORTAL DE CLIENTES]
    public function ConsultaGeneralCreditosAprobadosCanceladosPortalClientes($conectarsistema, $IdUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultarListadoCreditosClientesCanceladosPortalClientes('" . $IdUsuarios . "');");
        return $resultado;
    }
    // CONSULTA ESPECIFICA DE DATOS CLIENTES -> GENERAR FINIQUITO DE CANCELACION CREDITOS
    /**
     * Consulta datos para generar finiquito de cancelación para clientes
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @param int $IdCreditos ID del crédito
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultaDatosGenerarFiniquitoCancelacionClientes(
        mysqli $conectarsistema,
        int $IdUsuarios,
        int $IdCreditos
    ): bool {
        // Inicializar todas las propiedades con valores por defecto
        $this->initializeSettlementProperties();

        try {
            // Validar parámetros
            if ($IdUsuarios <= 0 || $IdCreditos <= 0) {
                throw new InvalidArgumentException("ID de usuario o crédito inválido");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultarDatosClientes_CreditosCanceladosFiniquitoCancelacion(?, ?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("ii", $IdUsuarios, $IdCreditos);
            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();
                $this->setSettlementPropertiesFromResult($Gestiones);
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultaDatosGenerarFiniquitoCancelacionClientes: " . $e->getMessage());
            return false;
        }
    }
    /**
     * Inicializa propiedades relacionadas con finiquitos
     */
    private function initializeSettlementProperties(): void
    {
        $this->setIdCreditoHistoricoClientes(0);
        $this->setIdUsuarios(0);
        $this->setNombresUsuarios('');
        $this->setApellidosUsuarios('');
        $this->setduiUsuarios('');
        $this->setNitUsuarios('');
        $this->setNombreProductos('');
        $this->setCodigoProductos('');
        $this->setMontoFinanciamientoCreditos(0.0);
        $this->setTasaInteresCreditos(0.0);
        $this->setTiempoPlazoCreditos(0);
        $this->setCuotaMensualCreditos(0.0);
        $this->setEstadoCreditoHistoricoClientes('');
    }
    /**
     * Establece propiedades de finiquitos desde resultados
     */
    private function setSettlementPropertiesFromResult(array $Gestiones): void
    {
        $this->setIdCreditoHistoricoClientes((int)($Gestiones['idhistorico'] ?? 0));
        $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
        $this->setNombresUsuarios($this->sanitizeString($Gestiones['nombres'] ?? ''));
        $this->setApellidosUsuarios($this->sanitizeString($Gestiones['apellidos'] ?? ''));
        $this->setduiUsuarios($this->sanitizeString($Gestiones['dui'] ?? ''));
        $this->setNitUsuarios($this->sanitizeString($Gestiones['nit'] ?? ''));
        $this->setNombreProductos($this->sanitizeString($Gestiones['nombreproducto'] ?? ''));
        $this->setCodigoProductos($this->sanitizeString($Gestiones['codigo'] ?? ''));
        $this->setMontoFinanciamientoCreditos((float)($Gestiones['montocredito'] ?? 0.0));
        $this->setTasaInteresCreditos((float)($Gestiones['interescredito'] ?? 0.0));
        $this->setTiempoPlazoCreditos((int)($Gestiones['plazocredito'] ?? 0));
        $this->setCuotaMensualCreditos((float)($Gestiones['cuotamensual'] ?? 0.0));
        $this->setEstadoCreditoHistoricoClientes($this->sanitizeString($Gestiones['estado'] ?? ''));
    }
    // CONSULTA ESPECIFICA DE CUOTAS GENERADAS CLIENTES InversGlobal -> CREDITOS ACTIVOS [EN CURSO]
    public function ConsultaCompletaCuotasGeneradas_CreditosCanceladosHistoricos($conectarsistema, $IdUsuarios, $IdCreditos)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaCompleta_CuotasGeneradasClientes_CreditosCancelados('" . $IdUsuarios . "','" . $IdCreditos . "');");
        return $resultado;
    }
    // CONSULTA ESPECIFICA DE CUOTAS GENERADAS CLIENTES InversGlobal -> CREDITOS CANCELADOS [HISTORICOS]
    public function ConsultaCompletaCuotasGeneradas_CreditosActivos($conectarsistema, $IdUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaCompleta_CuotasGeneradasClientes_CreditosActivos('" . $IdUsuarios . "');");
        return $resultado;
    }
    // CONSULTA ESPECIFICA -> DETALLE CUOTA A PAGAR [CANCELAR] -> ORDEN DE PAGOS CLIENTES
    /**
     * Consulta cuotas específicas para orden de pago de clientes
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @param int $IdCuotas ID de la cuota
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultarCuotas_OrdenPagoClientes(
        mysqli $conectarsistema,
        int $IdUsuarios,
        int $IdCuotas
    ): bool {
        // Inicializar todas las propiedades con valores por defecto
        $this->initializePaymentOrderProperties();

        try {
            // Validar parámetros de entrada
            if ($IdUsuarios <= 0 || $IdCuotas <= 0) {
                throw new InvalidArgumentException("ID de usuario o cuota inválido");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultaEspecificaCuotasClientes_OrdenPagoSistemaPagos(?, ?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("ii", $IdUsuarios, $IdCuotas);
            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();
                $this->setPaymentOrderPropertiesFromResult($Gestiones);
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultarCuotas_OrdenPagoClientes: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Inicializa propiedades relacionadas con órdenes de pago
     */
    private function initializePaymentOrderProperties(): void
    {
        // Datos de identificación
        $this->setIdCuotasClientes(0);
        $this->setIdUsuarios(0);
        $this->setIdProductos(0);
        $this->setIdCreditos(0);

        // Datos personales del cliente
        $this->setNombresUsuarios('');
        $this->setApellidosUsuarios('');
        $this->setFotoUsuarios('');
        $this->setduiUsuarios('');
        $this->setNitUsuarios('');

        // Datos del crédito
        $this->setMontoFinanciamientoCreditos(0.0);
        $this->setTasaInteresCreditos(0.0);
        $this->setTipoAmortizacion('');
        $this->setTipoPago('');
        $this->setTiempoPlazoCreditos(0);
        $this->setCuotaMensualCreditos(0.0);

        // Datos específicos de la cuota
        $this->setMontoCuotaCancelar(0.0);
        $this->setEstadoCuotaClientes('');
        $this->setNombreProductos('');
        $this->setMontoCapitalClientes(0.0);
        $this->setFechaVencimientoCuotasClientes('');
        $this->setComprobarIncumplimientoCuotasClientes(0);
        $this->setDiasIncumplimientoCuotasClientes(0);
    }

    /**
     * Establece propiedades de órdenes de pago desde resultados
     */
    private function setPaymentOrderPropertiesFromResult(array $Gestiones): void
    {
        // Datos de identificación
        $this->setIdCuotasClientes((int)($Gestiones['idcuotas'] ?? 0));
        $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
        $this->setIdProductos((int)($Gestiones['idproducto'] ?? 0));
        $this->setIdCreditos((int)($Gestiones['idcreditos'] ?? 0));

        // Datos personales del cliente
        $this->setNombresUsuarios($this->sanitizeString($Gestiones['nombres'] ?? ''));
        $this->setApellidosUsuarios($this->sanitizeString($Gestiones['apellidos'] ?? ''));
        $this->setFotoUsuarios($this->sanitizeString($Gestiones['fotoperfil'] ?? ''));
        $this->setduiUsuarios($this->sanitizeString($Gestiones['dui'] ?? ''));
        $this->setNitUsuarios($this->sanitizeString($Gestiones['nit'] ?? ''));

        // Datos del crédito
        $this->setMontoFinanciamientoCreditos((float)($Gestiones['montocredito'] ?? 0.0));
        $this->setTasaInteresCreditos((float)($Gestiones['interescredito'] ?? 0.0));
        $this->setTipoAmortizacion($this->sanitizeString($Gestiones['tipo_amortizacion'] ?? ''));
        $this->setTipoPago($this->sanitizeString($Gestiones['tipo_pago'] ?? ''));
        $this->setTiempoPlazoCreditos((int)($Gestiones['plazocredito'] ?? 0));
        $this->setCuotaMensualCreditos((float)($Gestiones['cuotamensual'] ?? 0.0));

        // Datos específicos de la cuota
        $this->setMontoCuotaCancelar((float)($Gestiones['montocancelar'] ?? 0.0));
        $this->setEstadoCuotaClientes($this->sanitizeString($Gestiones['estadocuota'] ?? ''));
        $this->setNombreProductos($this->sanitizeString($Gestiones['nombreproducto'] ?? ''));
        $this->setMontoCapitalClientes((float)($Gestiones['montocapital'] ?? 0.0));
        $this->setFechaVencimientoCuotasClientes($this->sanitizeDate($Gestiones['fechavencimiento'] ?? ''));
        $this->setComprobarIncumplimientoCuotasClientes((int)($Gestiones['incumplimiento_pago'] ?? 0));
        $this->setDiasIncumplimientoCuotasClientes((int)($Gestiones['dias_incumplimiento'] ?? 0));
    }
    // CONSULTA COMPLETA DE CUOTAS NO PAGADAS -> CLIENTES MOROSOS
    public function ConsultaClientesMorososCuotas($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaListadoGeneralCuotasClientesMorosos();");
        return $resultado;
    }
    // REGISTRO DE REPORTES FALLOS PLATAFORMA (TICKETS) -> DISPONIBLE PARA TODOS LOS USUARIOS
    public function RegistroFallosPlataforma_TicketsUsuarios($conectarsistema, $IdUsuarios, $NombreReportePlataforma, $DescripcionReportePlataforma, $FotoReportePlataforma, $FechaRegistroReportePlataforma, $EstadoReportePlataforma)
    {
        $resultado = mysqli_query($conectarsistema, "CALL RegistroReportesFallosPlataforma('" . $IdUsuarios . "','" . $NombreReportePlataforma . "','" . $DescripcionReportePlataforma . "','" . $FotoReportePlataforma . "','" . $FechaRegistroReportePlataforma . "','" . $EstadoReportePlataforma . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // CONSULTA COMPLETA DE REPORTES DE FALLOS REGISTRADOS POR LOS USUARIOS -> VALIDO EXCLUSIVAMENTE USUARIOS ADMINISTRADORES Y PRESIDENCIA
    public function ConsultaTicketsReportesFallosPlataforma($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaCompleta_ReportesFallosPlataforma();");
        return $resultado;
    }
    // CONSULTA COMPLETA DE REPORTES DE FALLOS REGISTRADOS POR LOS USUARIOS -> VALIDO EXCLUSIVAMENTE USUARIOS ADMINISTRADORES [SOLO LECTURA USUARIOS DE PRESIDENCIA]
    /**
     * Consulta específica de tickets de reportes de fallos en plataforma
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdReportePlataforma ID del reporte
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultaEspecificaTicketsReportesFallosPlataforma(
        mysqli $conectarsistema,
        int $IdReportePlataforma
    ): bool {
        // Inicializar propiedades con valores por defecto
        $this->initializeTicketProperties();

        try {
            // Validar ID de reporte
            if ($IdReportePlataforma <= 0) {
                throw new InvalidArgumentException("ID de reporte inválido");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultaEspecifica_ReportesFallosPlataforma(?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("i", $IdReportePlataforma);
            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();
                $this->setTicketPropertiesFromResult($Gestiones);
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultaEspecificaTicketsReportesFallosPlataforma: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Inicializa propiedades de tickets de reportes
     */
    private function initializeTicketProperties(): void
    {
        $this->setIdReportePlataforma(0);
        $this->setIdUsuarios(0);
        $this->setCodigoUsuarios('');
        $this->setNombreReportePlataforma('');
        $this->setDescripcionReportePlataforma('');
        $this->setFotoReportePlataforma('');
        $this->setFechaRegistroReportePlataforma('');
        $this->setFechaActualizacionReportePlataforma('');
        $this->setEstadoReportePlataforma('');
        $this->setComentarioActualizacionReportePlataforma('');
        $this->setEmpleadoGestionandoReportePlataforma('');
    }

    /**
     * Establece propiedades de tickets desde resultados
     */
    private function setTicketPropertiesFromResult(array $Gestiones): void
    {
        $this->setIdReportePlataforma((int)($Gestiones['idreporte'] ?? 0));
        $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
        $this->setCodigoUsuarios($this->sanitizeString($Gestiones['codigousuario'] ?? ''));
        $this->setNombreReportePlataforma($this->sanitizeString($Gestiones['nombrereporte'] ?? ''));
        $this->setDescripcionReportePlataforma($this->sanitizeString($Gestiones['descripcionreporte'] ?? ''));
        $this->setFotoReportePlataforma($this->sanitizeString($Gestiones['fotoreporte'] ?? ''));
        $this->setFechaRegistroReportePlataforma($this->sanitizeDate($Gestiones['fecharegistroreporte'] ?? ''));
        $this->setFechaActualizacionReportePlataforma($this->sanitizeDate($Gestiones['fechaactualizacionreporte'] ?? ''));
        $this->setEstadoReportePlataforma($this->sanitizeString($Gestiones['estado'] ?? ''));
        $this->setComentarioActualizacionReportePlataforma($this->sanitizeString($Gestiones['comentarioactualizacion'] ?? ''));
        $this->setEmpleadoGestionandoReportePlataforma($this->sanitizeString($Gestiones['empleado_gestion'] ?? ''));
    }

    // ACTUALIZACION DE REPORTES FALLOS PLATAFORMA (TICKETS) -> DISPONIBLE PARA TODOS LOS USUARIOS
    public function ActualizacionFallosPlataforma_TicketsUsuarios($conectarsistema, $IdReportePlataforma, $EstadoReportePlataforma, $ComentarioActualizacionReportePlataforma, $EmpleadoGestionandoReportePlataforma)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ActualizacionTicketsReportesFallosPlataforma('" . $IdReportePlataforma . "','" . $EstadoReportePlataforma . "','" . $ComentarioActualizacionReportePlataforma . "','" . $EmpleadoGestionandoReportePlataforma . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // REGISTRO DE CANCELACION CUOTAS CREDITOS CLIENTES -> PAGO DE CUOTAS -> TRANSACCIONES CREDITOS
    public function PagosCuotasClientes_TransaccionesCreditos($conectarsistema, $IdUsuarios, $IdProductos, $IdCreditos, $IdCuotas, $NumeroReferenciaTransaccion, $MontoCuotaCredito, $DiasIncumplimientoCredito, $EmpleadoGestionTransaccion)
    {
        $resultado = mysqli_query($conectarsistema, "CALL RegistroPagoCuotasCreditosClientes_OrdenPagosCashManHa ('" . $IdUsuarios . "','" . $IdProductos . "','" . $IdCreditos . "','" . $IdCuotas . "','" . $NumeroReferenciaTransaccion . "','" . $MontoCuotaCredito . "','" . $DiasIncumplimientoCredito . "','" . $EmpleadoGestionTransaccion . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // CONSULTA ESPECIFICA -> DATOS CLIENTES FACTURACION -> ORDEN DE PAGOS CLIENTES
    /**
     * Consulta detalles de facturación para órdenes de pago de créditos de clientes
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @param int $IdCuotas ID de la cuota
     * @return bool True si la consulta fue exitosa, false en caso de error
     * @throws InvalidArgumentException Si los parámetros son inválidos
     * @throws RuntimeException Si hay errores en la consulta SQL
     */
    public function ConsultarDetallesFacturacion_OrdenPagosCreditosClientes(
        mysqli $conectarsistema,
        int $IdUsuarios,
        int $IdCuotas
    ): bool {
        // Inicializar propiedades (como en tu código original)
        $this->initializeBillingProperties();

        try {
            // Validaciones más estrictas
            if ($IdUsuarios <= 0 || $IdCuotas <= 0) {
                throw new InvalidArgumentException("IDs de usuario y cuota deben ser positivos");
            }

            // Usar la vista que proporcionaste
            $sql = "SELECT * FROM vista_detallesfacturacioncreditosclientes 
                   WHERE idcuotas = ? AND idusuarios = ? 
                   LIMIT 1"; // Limit por seguridad

            $stmt = $conectarsistema->prepare($sql);
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("ii", $IdCuotas, $IdUsuarios);

            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();
                $this->setBillingPropertiesFromResult($Gestiones);
                return true;
            }

            return false;
        } catch (Exception $e) {
            error_log("Error en ConsultarDetallesFacturacion_OrdenPagosCreditosClientes: " . $e->getMessage());
            return false;
        }
    }

    public function ConsultarPagosCreditosClientesPaginado(
        mysqli $conectarsistema,
        int $idUsuarioLogueado,
        string $busqueda = '',
        string $fechaInicio = '',
        string $fechaFin = '',
        int $pagina = 1,
        int $porPagina = 10
    ): mysqli_result {
        // Validaciones de entrada
        if ($idUsuarioLogueado <= 0) {
            throw new InvalidArgumentException("ID de usuario inválido");
        }

        if ($pagina <= 0 || $porPagina <= 0 || $porPagina > 100) {
            throw new InvalidArgumentException("Parámetros de paginación inválidos");
        }

        // Validar formato de fechas
        if (!empty($fechaInicio) && !DateTime::createFromFormat('Y-m-d', $fechaInicio)) {
            throw new InvalidArgumentException("Formato de fecha inicio inválido");
        }

        if (!empty($fechaFin) && !DateTime::createFromFormat('Y-m-d', $fechaFin)) {
            throw new InvalidArgumentException("Formato de fecha fin inválido");
        }

        $offset = ($pagina - 1) * $porPagina;

        try {
            // Preparar consulta con parámetros seguros
            $sql = "SELECT 
                    c.idcuotas, 
                    u.nombres, 
                    u.apellidos, 
                    t.referencia, 
                    c.montocancelar, 
                    t.fecha,
                    c.nombreproducto
                FROM cuotas c
                JOIN usuarios u ON c.idusuarios = u.idusuarios
                JOIN transacciones t ON t.idcuotas = c.idcuotas
                WHERE c.idusuarios = ?";

            $params = ["i", $idUsuarioLogueado];

            // Agregar condiciones de búsqueda
            if (!empty($busqueda)) {
                $sql .= " AND (u.nombres LIKE ? OR u.apellidos LIKE ? OR t.referencia LIKE ? OR c.idcuotas LIKE ?)";
                $busquedaParam = "%" . $busqueda . "%";
                $params[0] .= "ssss";
                array_push($params, $busquedaParam, $busquedaParam, $busquedaParam, $busquedaParam);
            }

            if (!empty($fechaInicio) && !empty($fechaFin)) {
                $sql .= " AND DATE(t.fecha) BETWEEN ? AND ?";
                $params[0] .= "ss";
                array_push($params, $fechaInicio, $fechaFin);
            }

            $sql .= " ORDER BY t.fecha DESC LIMIT ? OFFSET ?";
            $params[0] .= "ii";
            array_push($params, $porPagina, $offset);

            $stmt = $conectarsistema->prepare($sql);
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            // Bind dinámico de parámetros
            $stmt->bind_param(...$params);

            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            return $stmt->get_result();
        } catch (Exception $e) {
            error_log("Error en ConsultarPagosCreditosClientesPaginado: " . $e->getMessage());
            throw $e; // Relanzar para manejo superior
        }
    }
    public function ContarTotalPagosCreditosClientes(
        mysqli $conectarsistema,
        int $idUsuarioLogueado,
        string $busqueda = '',
        string $fechaInicio = '',
        string $fechaFin = ''
    ): int {
        // Validaciones de entrada (igual que en la función anterior)
        if ($idUsuarioLogueado <= 0) {
            throw new InvalidArgumentException("ID de usuario inválido");
        }

        try {
            $sql = "SELECT COUNT(*) as total
                FROM cuotas c
                JOIN usuarios u ON c.idusuarios = u.idusuarios
                JOIN transacciones t ON t.idcuotas = c.idcuotas
                WHERE c.idusuarios = ?";

            $params = ["i", $idUsuarioLogueado];

            // Agregar condiciones de búsqueda (igual que en la función anterior)
            if (!empty($busqueda)) {
                $sql .= " AND (u.nombres LIKE ? OR u.apellidos LIKE ? OR t.referencia LIKE ? OR c.idcuotas LIKE ?)";
                $busquedaParam = "%" . $busqueda . "%";
                $params[0] .= "ssss";
                array_push($params, $busquedaParam, $busquedaParam, $busquedaParam, $busquedaParam);
            }

            if (!empty($fechaInicio) && !empty($fechaFin)) {
                $sql .= " AND DATE(t.fecha) BETWEEN ? AND ?";
                $params[0] .= "ss";
                array_push($params, $fechaInicio, $fechaFin);
            }

            $stmt = $conectarsistema->prepare($sql);
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            // Bind dinámico de parámetros
            $stmt->bind_param(...$params);

            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();
            $fila = $resultado->fetch_assoc();

            return (int)$fila['total'];
        } catch (Exception $e) {
            error_log("Error en ContarTotalPagosCreditosClientes: " . $e->getMessage());
            throw $e; // Relanzar para manejo superior
        }
    }

    /**
     * Inicializa propiedades relacionadas con facturación
     */
    private function initializeBillingProperties(): void
    {
        // IDs y referencias
        $this->setIdCuotasClientes(0);
        $this->setIdCreditos(0);
        $this->setIdUsuarios(0);
        $this->setIdProductos(0);

        // Datos personales
        $this->setNombresUsuarios('');
        $this->setApellidosUsuarios('');
        $this->setduiUsuarios('');
        $this->setNitUsuarios('');

        // Datos financieros
        $this->setCuotaMensualCreditos(0.0);
        $this->setMontoCuotaCancelar(0.0);
        $this->setNombreProductos('');
        $this->setCodigoProductos('');
        $this->setMontoCapitalClientes(0.0);

        // Fechas y transacciones
        $this->setFechaVencimientoCuotasClientes('');
        $this->setReferenciaTransaccionCreditosClientes('');
        $this->setFechaTransaccionCreditosClientes('');
        $this->setDiasIncumplimientoCuotasClientes(0);
        $this->setEmpleadoGestionTransaccionCreditosClientes('');
    }

    /**
     * Establece propiedades de facturación desde resultados
     */
    private function setBillingPropertiesFromResult(array $Gestiones): void
    {
        // IDs y referencias
        $this->setIdCuotasClientes((int)($Gestiones['idcuotas'] ?? 0));
        $this->setIdCreditos((int)($Gestiones['idcreditos'] ?? 0));
        $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
        $this->setIdProductos((int)($Gestiones['idproducto'] ?? 0));

        // Datos personales
        $this->setNombresUsuarios($this->sanitizeString($Gestiones['nombres'] ?? ''));
        $this->setApellidosUsuarios($this->sanitizeString($Gestiones['apellidos'] ?? ''));
        $this->setduiUsuarios($this->sanitizeDocumentNumber($Gestiones['dui'] ?? ''));
        $this->setNitUsuarios($this->sanitizeDocumentNumber($Gestiones['nit'] ?? ''));

        // Datos financieros
        $this->setCuotaMensualCreditos((float)($Gestiones['cuotamensual'] ?? 0.0));
        $this->setMontoCuotaCancelar((float)($Gestiones['montocancelar'] ?? 0.0));
        $this->setNombreProductos($this->sanitizeString($Gestiones['nombreproducto'] ?? ''));
        $this->setCodigoProductos($this->sanitizeString($Gestiones['codigo'] ?? ''));
        $this->setMontoCapitalClientes((float)($Gestiones['montocapital'] ?? 0.0));

        // Fechas y transacciones
        $this->setFechaVencimientoCuotasClientes($this->sanitizeDate($Gestiones['fechavencimiento'] ?? ''));
        $this->setReferenciaTransaccionCreditosClientes($this->sanitizeString($Gestiones['referencia'] ?? ''));
        $this->setFechaTransaccionCreditosClientes($this->sanitizeDateTime($Gestiones['fecha'] ?? ''));
        $this->setDiasIncumplimientoCuotasClientes((int)($Gestiones['dias_incumplimiento'] ?? 0));
        $this->setEmpleadoGestionTransaccionCreditosClientes($this->sanitizeString($Gestiones['empleado_gestion'] ?? ''));
    }


    // CONSULTA ESPECIFICA -> DATOS CLIENTES FACTURACION -> ORDEN DE PAGOS CLIENTES
    /**
     * Consulta detalles de facturación históricos para órdenes de pago de créditos de clientes
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @param int $IdCuotas ID de la cuota
     * @param int $IdCreditoHistoricoClientes ID del crédito histórico
     * @return bool True si la consulta fue exitosa, false en caso de error
     * @throws InvalidArgumentException Si los parámetros son inválidos
     * @throws RuntimeException Si hay errores en la consulta SQL
     */
    public function ConsultarDetallesFacturacion_OrdenPagosCreditosClientes_Historicos(
        mysqli $conectarsistema,
        int $IdUsuarios,
        int $IdCuotas,
        int $IdCreditoHistoricoClientes
    ): bool {
        // Inicializar todas las propiedades con valores por defecto
        $this->initializeHistoricalBillingProperties();

        try {
            // Validar parámetros de entrada
            if ($IdUsuarios <= 0 || $IdCuotas <= 0 || $IdCreditoHistoricoClientes <= 0) {
                throw new InvalidArgumentException("IDs de usuario, cuota o crédito histórico inválidos");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL MostrarDetallesDatosClientes_FacturacionCreditosHistoricos(?, ?, ?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            // Orden de parámetros corregido para coincidir con el procedimiento almacenado
            $stmt->bind_param("iii", $IdCuotas, $IdUsuarios, $IdCreditoHistoricoClientes);

            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();
                $this->setHistoricalBillingPropertiesFromResult($Gestiones);
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultarDetallesFacturacion_OrdenPagosCreditosClientes_Historicos: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Inicializa propiedades relacionadas con facturación histórica
     */
    private function initializeHistoricalBillingProperties(): void
    {
        // IDs y referencias
        $this->setIdCuotasClientes(0);
        $this->setIdCuotasClientesHistorico(0);
        $this->setIdCreditos(0);
        $this->setIdUsuarios(0);
        $this->setIdProductos(0);

        // Datos personales
        $this->setNombresUsuarios('');
        $this->setApellidosUsuarios('');
        $this->setduiUsuarios('');
        $this->setNitUsuarios('');

        // Datos financieros
        $this->setCuotaMensualCreditos(0.0);
        $this->setMontoCuotaCancelar(0.0);
        $this->setNombreProductos('');
        $this->setCodigoProductos('');
        $this->setMontoCapitalClientes(0.0);

        // Fechas y transacciones
        $this->setFechaVencimientoCuotasClientes('');
        $this->setReferenciaTransaccionCreditosClientes('');
        $this->setFechaTransaccionCreditosClientes('');
        $this->setDiasIncumplimientoCuotasClientes(0);
        $this->setEmpleadoGestionTransaccionCreditosClientes('');
    }

    /**
     * Establece propiedades de facturación histórica desde resultados
     */
    private function setHistoricalBillingPropertiesFromResult(array $Gestiones): void
    {
        // IDs y referencias
        $this->setIdCuotasClientes((int)($Gestiones['idcuotas'] ?? 0));
        $this->setIdCuotasClientesHistorico((int)($Gestiones['idhistorico'] ?? 0));
        $this->setIdCreditos((int)($Gestiones['idcreditos'] ?? 0));
        $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
        $this->setIdProductos((int)($Gestiones['idproducto'] ?? 0));

        // Datos personales
        $this->setNombresUsuarios($this->sanitizeString($Gestiones['nombres'] ?? ''));
        $this->setApellidosUsuarios($this->sanitizeString($Gestiones['apellidos'] ?? ''));
        $this->setduiUsuarios($this->sanitizeDocumentNumber($Gestiones['dui'] ?? ''));
        $this->setNitUsuarios($this->sanitizeDocumentNumber($Gestiones['nit'] ?? ''));

        // Datos financieros
        $this->setCuotaMensualCreditos((float)($Gestiones['cuotamensual'] ?? 0.0));
        $this->setMontoCuotaCancelar((float)($Gestiones['montocancelar'] ?? 0.0));
        $this->setNombreProductos($this->sanitizeString($Gestiones['nombreproducto'] ?? ''));
        $this->setCodigoProductos($this->sanitizeString($Gestiones['codigo'] ?? ''));
        $this->setMontoCapitalClientes((float)($Gestiones['montocapital'] ?? 0.0));

        // Fechas y transacciones
        $this->setFechaVencimientoCuotasClientes($this->sanitizeDate($Gestiones['fechavencimiento'] ?? ''));
        $this->setReferenciaTransaccionCreditosClientes($this->sanitizeString($Gestiones['referencia'] ?? ''));
        $this->setFechaTransaccionCreditosClientes($this->sanitizeDateTime($Gestiones['fecha'] ?? ''));
        $this->setDiasIncumplimientoCuotasClientes((int)($Gestiones['dias_incumplimiento'] ?? 0));
        $this->setEmpleadoGestionTransaccionCreditosClientes($this->sanitizeString($Gestiones['empleado_gestion'] ?? ''));
    }
    // CONSULTA ESPECIFICA -> DATOS CLIENTES FACTURACION -> ORDEN DE PAGOS CLIENTES
    public function ConsultaTransacciones_PagosCreditosClientes($conectarsistema, $IdUsuarios, $IdCuotas)
    {
        $resultado = mysqli_query($conectarsistema, "CALL MostrarDetallesDatosClientes_FacturacionCreditosCashManHa('" . $IdUsuarios . "','" . $IdCuotas . "');");
        $Gestiones = mysqli_fetch_array($resultado); // RECORRIDO EN BUSCA DE REGISTRO CONSULTADO
        // EXTRAER DETALLES DE USUARIOS SOLAMENTE SI EXISTEN REGISTROS QUE SE SEAN ASOCIADOS
        // AL USUARIO QUE ESTA SIENDO CONSULTADO EN CUESTION Y NO SEA CONSULTA VACIA [NULA]
        if (mysqli_num_rows($resultado) > 0) {
            // OBTENER VALORES EXTRAIDOS EN LA CONSULTA
            $this->setIdTransaccionCreditosClientes($Gestiones['idtransaccion']);
            $this->setIdUsuarios($Gestiones['idusuarios']);
            $this->setIdCuotasClientes($Gestiones['idcuotas']);
            $this->setReferenciaTransaccionCreditosClientes($Gestiones['referencia']);
            $this->setMontoTransaccionCreditosClientes($Gestiones['monto']);
            $this->setFechaTransaccionCreditosClientes($Gestiones['fecha']);
        } // CIERRE if(mysqli_num_rows($resultado)>0){
    }
    // CONSULTA BANDEJA DE ENTRADA -> MENSAJERIA USUARIOS CASHMAN HA
    public function ConsultarMensajesBandejaEntradaUsuarios($conectarsistema, $IdUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaMensajesBandejaEntradaUsuariosCashmanHa('" . $IdUsuarios . "');");
        return $resultado;
    }
    // CONSULTA DETALLES DE MENSAJERIAS BANDEJA DE ENTRADA -> MENSAJERIA USUARIOS CASHMAN HA
    /**
     * Consulta detalles de mensajes en la bandeja de entrada de usuarios
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @param int $IdMensaje ID del mensaje
     * @return bool True si la consulta fue exitosa, false en caso de error
     * @throws InvalidArgumentException Si los parámetros son inválidos
     * @throws RuntimeException Si hay errores en la consulta SQL
     */
    public function ConsultarDetallesMensajesBandejaEntradaUsuarios(
        mysqli $conectarsistema,
        int $IdUsuarios,
        int $IdMensaje
    ): bool {
        // Inicializar todas las propiedades con valores por defecto
        $this->initializeMessageProperties();

        try {
            // Validar parámetros de entrada
            if ($IdUsuarios <= 0 || $IdMensaje <= 0) {
                throw new InvalidArgumentException("ID de usuario o mensaje inválido");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultarDetallesMensajesBandejaEntradaUsuariosCashmanHa(?, ?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("ii", $IdUsuarios, $IdMensaje);
            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();
                $this->setMessagePropertiesFromResult($Gestiones);
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultarDetallesMensajesBandejaEntradaUsuarios: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Inicializa propiedades relacionadas con mensajes
     */
    private function initializeMessageProperties(): void
    {
        $this->setIdMensajeria(0);
        $this->setIdUsuarios(0);
        $this->setNombresUsuarios('');
        $this->setApellidosUsuarios('');
        $this->setCodigoUsuarios('');
        $this->setFotoUsuarios('');
        $this->setNombreMensajeria('');
        $this->setAsuntoMensajeria('');
        $this->setDetalleMensajeria('');
        $this->setFechaMensajeria('');
    }

    /**
     * Establece propiedades de mensajes desde resultados
     */
    private function setMessagePropertiesFromResult(array $Gestiones): void
    {
        $this->setIdMensajeria((int)($Gestiones['idmensajeria'] ?? 0));
        $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
        $this->setNombresUsuarios($this->sanitizeString($Gestiones['nombres'] ?? ''));
        $this->setApellidosUsuarios($this->sanitizeString($Gestiones['apellidos'] ?? ''));
        $this->setCodigoUsuarios($this->sanitizeString($Gestiones['codigousuario'] ?? ''));
        $this->setFotoUsuarios($this->sanitizeString($Gestiones['fotoperfil'] ?? ''));
        $this->setNombreMensajeria($this->sanitizeString($Gestiones['nombremensaje'] ?? ''));
        $this->setAsuntoMensajeria($this->sanitizeString($Gestiones['asuntomensaje'] ?? ''));
        $this->setDetalleMensajeria($this->sanitizeMessageContent($Gestiones['detallemensaje'] ?? ''));
        $this->setFechaMensajeria($this->sanitizeDateTime($Gestiones['fechamensaje'] ?? ''));
    }

    private function sanitizeMessageContent(string $input): string
    {
        // Sanitiza contenido del mensaje permitiendo algunos tags básicos si es necesario
        $allowedTags = '<p><br><strong><em><ul><ol><li>';
        $sanitized = strip_tags(trim($input), $allowedTags);
        return htmlspecialchars($sanitized, ENT_QUOTES, 'UTF-8');
    }
    private function sanitizeDateTime(string $input): string
    {
        // Valida formato de fecha y hora (YYYY-MM-DD HH:MM:SS)
        if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', trim($input))) {
            return trim($input);
        }
        return '';
    }

    // CONSULTA DE TODOS LOS USUARIOS REGISTRADOS DISPONIBLES PARA ENVIO DE MENSAJERIA INTERNA CASHMAN HA
    public function ConsultarListadoUsuariosCompleto_MensajeriaCashmanHa($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaNombresCompletos_EnviarMensajeriaNuevaUsuariosCashManHa();");
        return $resultado;
    }
    // REGISTRO DE NUEVOS MENSAJES -> ENVIO MENSAJERIA INTERNA InversGlobal
    public function EnvioNuevosMensajes_MensajeriaInternaCashmanHa($conectarsistema, $IdUsuarios, $NombreMensajeria, $AsuntoMensajeria, $DetalleMensajeria, $IdUsuarioDestinatarioMensajeria)
    {
        $resultado = mysqli_query($conectarsistema, "CALL RegistroNuevosMensajesUsuarios_MensajeriaCashManHa ('" . $IdUsuarios . "','" . $NombreMensajeria . "','" . $AsuntoMensajeria . "','" . $DetalleMensajeria . "','" . $IdUsuarioDestinatarioMensajeria . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // OCULTAR MENSAJES RECIBIDOS -> MENSAJERIA INTERNA InversGlobal 
    public function OcultarMensajes_MensajeriaInternaCashmanHa($conectarsistema, $IdMensajeria)
    {
        $resultado = mysqli_query($conectarsistema, "CALL OcultarMensajesRecibidos_MensajeriaInternaUsuariosCashManHa ('" . $IdMensajeria . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // CONSULTAR LISTADO GENERAL DE NOTIFICACIONES RECIBIDAS -> VALIDO PARA TODOS LOS USUARIOS
    public function MostrarListadoNotificacionesRecibidasUsuarios($conectarsistema, $IdUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultarNotificacionesRecibidasUsuarios('" . $IdUsuarios . "');");
        return $resultado;
    }
    // CONSULTAR LISTADO GENERAL DE NOTIFICACIONES RECIBIDAS -> VALIDO PARA TODOS LOS USUARIOS
    public function OcultarMisNotificacionesUsuarios($conectarsistema, $IdNotificaciones)
    {
        $resultado = mysqli_query($conectarsistema, "CALL OcultarNotificacionesRecibidasUsuarios('" . $IdNotificaciones . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // OCULTAR NOTIFICACIONES RECIBIDAS -> VALIDO PARA TODOS LOS USUARIOS
    public function MostrarListadoNotificacionesRecortadaRecibidasUsuarios($conectarsistema, $IdUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaNotificacionesRecortada_BarraHerramientasPlataforma('" . $IdUsuarios . "');");
        return $resultado;
    }
    // CONSULTA DETALLES REGISTROS -> TOTALES INTERFAZ ADMINISTRADORES
    public function ConsultarDetallesRegistros_Administradores(mysqli $conectarsistema): bool
    {
        // Initialize default values
        $this->setNumeroUsuariosRegistrados(0);
        $this->setNumeroProductosRegistrados(0);
        $this->setNumeroReportesFallosPlataformaRegistrados(0);
        $this->setNumeroSolicitudesRecuperacionesRegistrados(0);
        $this->setNumeroCuotasClientesRegistradas(0);
        $this->setNumeroTransaccionesClientesRegistradas(0);

        try {
            // Prepare and execute stored procedure
            $resultado = mysqli_query($conectarsistema, "CALL ConsultaDatosGenerales_InicioPlataformaAdministradores();");

            if (!$resultado) {
                throw new Exception("Database query failed: " . mysqli_error($conectarsistema));
            }

            $Gestiones = mysqli_fetch_assoc($resultado); // Using fetch_assoc for clarity

            if ($Gestiones && mysqli_num_rows($resultado) > 0) {
                // Validate and set each value
                $this->setNumeroUsuariosRegistrados((int)($Gestiones['numero_usuarios_registrados'] ?? 0));
                $this->setNumeroProductosRegistrados((int)($Gestiones['numero_productos_registrados'] ?? 0));
                $this->setNumeroReportesFallosPlataformaRegistrados((int)($Gestiones['numero_reportes_registrados'] ?? 0));
                $this->setNumeroSolicitudesRecuperacionesRegistrados((int)($Gestiones['numero_solicitudes_recuperaciones'] ?? 0));
                $this->setNumeroCuotasClientesRegistradas((int)($Gestiones['numero_cuotas'] ?? 0));
                $this->setNumeroTransaccionesClientesRegistradas((int)($Gestiones['numero_transacciones'] ?? 0));
            }

            // Free result and return success
            if (is_object($resultado)) {
                mysqli_free_result($resultado);
            }

            return true;
        } catch (Exception $e) {
            // Log the error (in a real application, use a proper logging system)
            error_log($e->getMessage());
            return false;
        }
    }
    // CONSULTA DETALLES REGISTROS -> TOTALES INTERFAZ PRESIDENCIA
    /**
     * Consulta los detalles de registros para la interfaz de Presidencia
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultarDetallesRegistros_Presidencia(mysqli $conectarsistema): bool
    {
        // Inicializar valores por defecto
        $this->setNumeroProductosRegistrados(0);
        $this->setNumeroCuotasClientesRegistradas(0);
        $this->setNumeroTransaccionesClientesRegistradas(0);
        $this->setNumeroCuentasAhorroClientesRegistradas(0);

        try {
            // Ejecutar procedimiento almacenado
            $resultado = mysqli_query($conectarsistema, "CALL ConsultaDatosGenerales_InicioPlataformaPresidencia();");

            if (!$resultado) {
                throw new Exception("Error en consulta Presidencia: " . mysqli_error($conectarsistema));
            }

            $Gestiones = mysqli_fetch_assoc($resultado);

            if ($Gestiones && mysqli_num_rows($resultado) > 0) {
                // Asignar valores con validación y conversión de tipos
                $this->setNumeroProductosRegistrados((int)($Gestiones['numero_productos_registrados'] ?? 0));
                $this->setNumeroCuotasClientesRegistradas((int)($Gestiones['numero_cuotas_registrados'] ?? 0));
                $this->setNumeroTransaccionesClientesRegistradas((int)($Gestiones['numero_transacciones_creditos'] ?? 0));
                $this->setNumeroCuentasAhorroClientesRegistradas((int)($Gestiones['numero_cuentasahorro_registradas'] ?? 0));
            }

            // Liberar recursos
            if (is_object($resultado)) {
                mysqli_free_result($resultado);
            }

            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultarDetallesRegistros_Presidencia: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Consulta los detalles de registros para la interfaz de Gerencia
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultarDetallesRegistros_Gerencia(mysqli $conectarsistema): bool
    {
        // Inicializar valores por defecto
        $this->setNumeroProductosRegistrados(0);
        $this->setNumeroCuotasClientesRegistradas(0);
        $this->setNumeroTransaccionesClientesRegistradas(0);
        $this->setNumeroCuentasAhorroClientesRegistradas(0);
        $this->setNumeroCuotasPagadasTarde(0);
        $this->setNumeroCuotasPagadasCanceladas(0);
        $this->setNumeroCuotasVencidas(0);
        $this->setNumeroTransferenciasProcesadas(0);

        try {
            // Ejecutar procedimiento almacenado
            $resultado = mysqli_query($conectarsistema, "CALL ConsultaDatosGenerales_InicioPlataformaGerencia();");

            if (!$resultado) {
                throw new Exception("Error en consulta Gerencia: " . mysqli_error($conectarsistema));
            }

            $Gestiones = mysqli_fetch_assoc($resultado);

            if ($Gestiones && mysqli_num_rows($resultado) > 0) {
                // Asignar valores con validación y conversión de tipos
                $this->setNumeroProductosRegistrados((int)($Gestiones['numero_productos_registrados'] ?? 0));
                $this->setNumeroCuotasClientesRegistradas((int)($Gestiones['numero_cuotas_registrados'] ?? 0));
                $this->setNumeroTransaccionesClientesRegistradas((int)($Gestiones['numero_transacciones_creditos'] ?? 0));
                $this->setNumeroCuentasAhorroClientesRegistradas((int)($Gestiones['numero_cuentasahorro_registradas'] ?? 0));
                $this->setNumeroCuotasPagadasTarde((int)($Gestiones['numero_cuotas_pagadas_tarde'] ?? 0));
                $this->setNumeroCuotasPagadasCanceladas((int)($Gestiones['numero_cuotas_canceladas'] ?? 0));
                $this->setNumeroCuotasVencidas((int)($Gestiones['numero_cuotas_vencidas'] ?? 0));
                $this->setNumeroTransferenciasProcesadas((int)($Gestiones['numero_transferencias'] ?? 0));
            }

            // Liberar recursos
            if (is_object($resultado)) {
                mysqli_free_result($resultado);
            }

            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultarDetallesRegistros_Gerencia: " . $e->getMessage());
            return false;
        }
    }
    // CONSULTAR LISTADO ULTIMAS 200 TRANSACCIONES PROCESADAS CLIENTES -> INTERFAZ ADMINISTRADORES
    public function ConsultaListadoGeneralUltimasTransaccionesClientes($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultarTransaccionesProcesadasClientes_UltimasTransacciones();");
        return $resultado;
    }
    // CONSULTAR LISTADO TODAS LAS TRANSACCIONES PROCESADAS CLIENTES [CONSULTA GENERAL]
    public function ConsultaListadoGeneralTransaccionesClientes($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultarTransaccionesProcesadasClientes_General();");
        return $resultado;
    }
    // CONSULTAR LISTADO TODAS LAS TRANSACCIONES PROCESADAS CLIENTES [CONSULTA ESPECIFICA MIS TRANSACCIONES]
    public function ConsultarMisTransaccionesProcesadasClientes_Especifica($conectarsistema, $IdUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultarMisTransaccionesProcesadasClientes_Especifica('" . $IdUsuarios . "');");
        return $resultado;
    }
    // CONSULTAR LISTADO CLIENTES -> REGISTRO NUEVAS CUENTAS DE AHORROS Y DEPOSITOS PLAZO FIJO
    public function ConsultaListadoGeneralClientes_NuevasCuentasCashmanha($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaDatosClientes_NuevasCuentasAhorrosDepositoPlazoFijo();");
        return $resultado;
    }
    // REGISTRO DE NUEVAS CUENTAS DE AHORROS CLIENTES InversGlobal
    public function RegistroNuevasCuentasAhorroClientesCashmanha($conectarsistema, $NumeroCuentaClientes, $MontoDepositoAperturaCuenta, $IdProductos, $IdUsuarios, $CertificadoAportacion, $GastosAdministrativos, $MontoApertura)
    {
        $resultado = mysqli_query($conectarsistema, "CALL RegistroNuevasCuentasAhorroClientesCashmanha('" . $NumeroCuentaClientes . "','" . $MontoDepositoAperturaCuenta . "','" . $IdProductos . "','" . $IdUsuarios . "','" . $CertificadoAportacion . "','" . $GastosAdministrativos . "','" . $MontoApertura . "');");
        return $resultado;
    }

    public function RegistroNuevasCuentasAhorroProgramadoClientesCashmanha(
        $conectarsistema,
        $NumeroCuentaClientes,
        $MontoAhorro,
        $IdProductos,
        $IdUsuarios,
        $MesesAhorro,
        $Interes,
        $TotalAhorro,
        $FechaInicio,
        $FechaFiniquito,
        $TotalDesembolso
    ) {
        $resultado = mysqli_query($conectarsistema, "CALL RegistroNuevasCuentasAhorroProgramadoClientesCashmanha(
            '" . $NumeroCuentaClientes . "',
            '" . $MontoAhorro . "',
            '" . $IdProductos . "',
            '" . $IdUsuarios . "',
            '" . $MesesAhorro . "',
            '" . $Interes . "',
            '" . $TotalAhorro . "',
            '" . $FechaInicio . "',
            '" . $FechaFiniquito . "',
            '" . $TotalDesembolso . "'
        );");
        return $resultado;
    }
    public function ConsultarCuentaAhorroCliente(mysqli $conectarsistema, int $IdUsuarios, int $IdProductos): bool
    {
        $stmt = $conectarsistema->prepare("SELECT * FROM cuentas WHERE idusuarios = ? AND idproducto = ?");
        $stmt->bind_param("ii", $IdUsuarios, $IdProductos);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->num_rows > 0;
    }

    /**
     * Consulta si un cliente ya tiene una cuenta de ahorro programado
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @param int $IdProductos ID del producto
     * @return bool True si existe, False si no
     */
    public function ConsultarCuentaAhorroProgramadoCliente(mysqli $conectarsistema, int $IdUsuarios, int $IdProductos): bool
    {
        $stmt = $conectarsistema->prepare("SELECT * FROM ahorroprogramado WHERE idusuarios = ? AND idproducto = ?");
        $stmt->bind_param("ii", $IdUsuarios, $IdProductos);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->num_rows > 0;
    }

    /**
     * Consulta clientes con cuenta de ahorro (excluyendo uno específico)
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarioExcluido ID del usuario a excluir
     * @return mysqli_result Resultado de la consulta
     */
    public function ConsultarClientesConCuentaAhorro(mysqli $conectarsistema, int $IdUsuarioExcluido)
    {
        $stmt = $conectarsistema->prepare("
            SELECT DISTINCT u.idusuarios, u.nombres, u.apellidos, d.dui 
            FROM usuarios u
            JOIN cuentas c ON u.idusuarios = c.idusuarios
            JOIN detalleusuarios d ON u.idusuarios = d.idusuarios
            WHERE c.idproducto = 1 AND u.idusuarios != ?
        ");
        $stmt->bind_param("i", $IdUsuarioExcluido);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }




    // CONSULTAR LISTADO COMPLETO DE CUENTAS DE AHORROS REGISTRADAS
    public function ConsultaListadoCuentasAhorrosRegistradasClientes($conectarsistema)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaListadoCuentasAhorrosRegistradas();");
        return $resultado;
    }
    // CONSULTA COMPLETA ESPECIFICA DE DATOS CLIENTES -> CUENTAS DE AHORRO REGISTRADAS
    /**
     * Consulta específica de cuentas de ahorro de clientes
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @return bool True si la consulta fue exitosa, false en caso de error
     * @throws InvalidArgumentException Si el ID de usuario es inválido
     * @throws RuntimeException Si hay errores en la consulta SQL
     */
    public function ConsultaEspecificaClientes_CuentasAhorros(
        mysqli $conectarsistema,
        int $IdUsuarios
    ): bool {
        // Inicializar todas las propiedades con valores por defecto
        $this->initializeSavingsAccountProperties();

        try {
            // Validar parámetro de entrada
            if ($IdUsuarios <= 0) {
                throw new InvalidArgumentException("ID de usuario inválido");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultaEspecificaDatosCuentasAhorroClientesCashmanha(?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("i", $IdUsuarios);
            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();
                $this->setSavingsAccountPropertiesFromResult($Gestiones);
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultaEspecificaClientes_CuentasAhorros: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Inicializa propiedades relacionadas con cuentas de ahorro
     */
    private function initializeSavingsAccountProperties(): void
    {
        $this->setIdCuentaAhorroClientes(0);
        $this->setIdUsuarios(0);
        $this->setNombresUsuarios('');
        $this->setApellidosUsuarios('');
        $this->setFotoUsuarios('');
        $this->setduiUsuarios('');
        $this->setNitUsuarios('');
        $this->setNumeroCuentaAhorroClientes('');
        $this->setSaldoCuentaAhorroClientes(0.0);
        $this->setEstadoCuentaAhorroClientes('');
        $this->setFechaAperturaCuentaAhorroClientes('');
    }

    /**
     * Establece propiedades de cuentas de ahorro desde resultados
     */
    private function setSavingsAccountPropertiesFromResult(array $Gestiones): void
    {
        $this->setIdCuentaAhorroClientes((int)($Gestiones['idcuentas'] ?? 0));
        $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
        $this->setNombresUsuarios($this->sanitizeString($Gestiones['nombres'] ?? ''));
        $this->setApellidosUsuarios($this->sanitizeString($Gestiones['apellidos'] ?? ''));
        $this->setFotoUsuarios($this->sanitizeString($Gestiones['fotoperfil'] ?? ''));
        $this->setduiUsuarios($this->sanitizeDocumentNumber($Gestiones['dui'] ?? ''));
        $this->setNitUsuarios($this->sanitizeDocumentNumber($Gestiones['nit'] ?? ''));
        $this->setNumeroCuentaAhorroClientes($this->sanitizeAccountNumber($Gestiones['numerocuenta'] ?? ''));
        $this->setSaldoCuentaAhorroClientes((float)($Gestiones['montocuenta'] ?? 0.0));
        $this->setEstadoCuentaAhorroClientes($this->sanitizeString($Gestiones['estadocuenta'] ?? ''));
        $this->setFechaAperturaCuentaAhorroClientes($this->sanitizeDate($Gestiones['fechaapertura'] ?? ''));
    }

    /**
     * Métodos auxiliares para sanitización
     */

    private function sanitizeDocumentNumber(string $input): string
    {
        // Sanitiza números de documento (DUI/NIT) - solo números y guiones
        return preg_replace('/[^0-9-]/', '', trim($input));
    }

    private function sanitizeAccountNumber(string $input): string
    {
        // Sanitiza números de cuenta - solo números
        return preg_replace('/[^0-9]/', '', trim($input));
    }

    // CONSULTA COMPLETA ESPECIFICA DE DATOS CLIENTES -> CUENTAS DE AHORRO REGISTRADAS
    /**
     * Consulta los datos de clientes para transferencias entre cuentas de ahorro
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdCuentaAhorroClientes ID de la cuenta de ahorro a consultar
     * @return $this
     * @throws InvalidArgumentException Si el ID no es válido
     * @throws RuntimeException Si ocurre un error en la consulta
     */
    public function ConsultaDatosClientes_TransferenciasCuentasAhorros(
        mysqli $conectarsistema,
        int $IdCuentaAhorroClientes
    ) {
        // Validación estricta del parámetro de entrada
        if ($IdCuentaAhorroClientes <= 0) {
            throw new InvalidArgumentException("El ID de cuenta de ahorro debe ser un valor positivo");
        }

        $stmt = null;
        $resultado = false;

        try {
            // Preparar la llamada al procedimiento almacenado con parámetros seguros
            $query = "CALL ConsultaDatosClientes_TransferenciasCuentasAhorros(?)";
            $stmt = mysqli_prepare($conectarsistema, $query);

            if (!$stmt) {
                throw new RuntimeException(
                    "Error al preparar la consulta: " . mysqli_error($conectarsistema)
                );
            }

            // Vincular parámetro de forma segura
            mysqli_stmt_bind_param($stmt, "i", $IdCuentaAhorroClientes);

            // Ejecutar la consulta
            if (!mysqli_stmt_execute($stmt)) {
                throw new RuntimeException(
                    "Error al ejecutar la consulta: " . mysqli_stmt_error($stmt)
                );
            }

            // Obtener resultados
            $resultado = mysqli_stmt_get_result($stmt);
            if (!$resultado) {
                throw new RuntimeException(
                    "Error al obtener resultados: " . mysqli_error($conectarsistema)
                );
            }
            // Procesar resultados si existen
            if (mysqli_num_rows($resultado) > 0) {
                $Gestiones = mysqli_fetch_assoc($resultado);

                // Asignación segura con valores por defecto
                $this->setIdTransaccionesDepositosRetirosCuentasTransferencias($Gestiones['idcuentas'] ?? 0);
                $this->setIdUsuarios($Gestiones['idusuarios'] ?? 0);
                $this->setIdCuentaAhorroTransferenciaDestinoClientes($Gestiones['idusuarios'] ?? 0); // ¿Este campo es correcto? Parece que usa el mismo que idusuarios
                $this->setNombresClienteCuentaAhorroClientesTransferencias($Gestiones['nombres'] ?? '');
                $this->setApellidosClienteCuentaAhorroClientesTransferencias($Gestiones['apellidos'] ?? '');
                $this->setNumeroCuentaAhorroClientesTransferencias($Gestiones['numerocuenta'] ?? '');
            }
        } catch (Exception $e) {
            // Registrar el error de forma segura
            error_log("[" . date('Y-m-d H:i:s') . "] Error en ConsultaDatosClientes_TransferenciasCuentasAhorros: "
                . $e->getMessage() . " - ID Cuenta: " . $IdCuentaAhorroClientes);
            throw $e; // Relanzar para manejo superior
        } finally {
            // Limpieza garantizada de recursos
            if ($resultado !== false) {
                mysqli_free_result($resultado);
            }
            if ($stmt !== null) {
                mysqli_stmt_close($stmt);
            }
        }

        return $this;
    }
    // REGISTRO DEPOSITOS CUENTAS DE AHORROS CLIENTES InversGlobal
    public function RegistroDepositosCuentasAhorroClientes($conectarsistema, $IdUsuarios, $IdProductos, $IdCuentaAhorroClientes, $ReferenciaTransaccionDepositoCuentas, $MontoDepositoCuentas, $EmpleadoGestionTransaccionDepositoCuentas, $TipoTransaccionDepositosRetirosCuentas, $EstadoTransaccionDepositosRetirosCuentas, $SaldoNuevoTransaccionDepositosRetirosCuentas)
    {
        $resultado = mysqli_query($conectarsistema, "CALL RegistroDepositoCuentasAhorrosClientesCashManHa('" . $IdUsuarios . "','" . $IdProductos . "','" . $IdCuentaAhorroClientes . "','" . $ReferenciaTransaccionDepositoCuentas . "','" . $MontoDepositoCuentas . "','" . $EmpleadoGestionTransaccionDepositoCuentas . "','" . $TipoTransaccionDepositosRetirosCuentas . "','" . $EstadoTransaccionDepositosRetirosCuentas . "','" . $SaldoNuevoTransaccionDepositosRetirosCuentas . "');");
        return $resultado;
    }
    // REGISTRO RETIROS CUENTAS DE AHORROS CLIENTES InversGlobal
    public function RegistroRetirosCuentasAhorroClientes($conectarsistema, $IdUsuarios, $IdProductos, $IdCuentaAhorroClientes, $ReferenciaTransaccionDepositoCuentas, $MontoDepositoCuentas, $EmpleadoGestionTransaccionDepositoCuentas, $TipoTransaccionDepositosRetirosCuentas, $EstadoTransaccionDepositosRetirosCuentas, $SaldoNuevoTransaccionDepositosRetirosCuentas)
    {
        $resultado = mysqli_query($conectarsistema, "CALL RegistroRetiroCuentasAhorrosClientesCashManHa('" . $IdUsuarios . "','" . $IdProductos . "','" . $IdCuentaAhorroClientes . "','" . $ReferenciaTransaccionDepositoCuentas . "','" . $MontoDepositoCuentas . "','" . $EmpleadoGestionTransaccionDepositoCuentas . "','" . $TipoTransaccionDepositosRetirosCuentas . "','" . $EstadoTransaccionDepositosRetirosCuentas . "','" . $SaldoNuevoTransaccionDepositosRetirosCuentas . "');");
        return $resultado;
    }
    // CONSULTA COMPLETA ESPECIFICA DE DATOS CLIENTES -> CUENTAS DE AHORRO REGISTRADAS
    public function ConsultaDetallesTransaccionCuentasClientes_Comprobantes(
        mysqli $conectarsistema,
        int $IdTransaccionesDepositoCuentas,
        int $IdUsuarios
    ) {
        // Validación de parámetros de entrada
        if ($IdTransaccionesDepositoCuentas <= 0 || $IdUsuarios <= 0) {
            throw new InvalidArgumentException("Los IDs proporcionados no son válidos");
        }

        $resultado = false;
        $stmt = null;

        try {
            // Preparar la llamada al procedimiento almacenado
            $query = "CALL ConsultaDetalleComprobanteDepositoCuentasAhorroClientes(?, ?)";
            $stmt = mysqli_prepare($conectarsistema, $query);

            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . mysqli_error($conectarsistema));
            }

            // Vincular parámetros
            mysqli_stmt_bind_param($stmt, "ii", $IdTransaccionesDepositoCuentas, $IdUsuarios);

            // Ejecutar la consulta
            if (!mysqli_stmt_execute($stmt)) {
                throw new RuntimeException("Error al ejecutar la consulta: " . mysqli_stmt_error($stmt));
            }

            // Obtener resultados
            $resultado = mysqli_stmt_get_result($stmt);
            if (!$resultado) {
                throw new RuntimeException("Error al obtener resultados: " . mysqli_error($conectarsistema));
            }

            // Procesar resultados
            if (mysqli_num_rows($resultado) > 0) {
                $Gestiones = mysqli_fetch_assoc($resultado);

                // Validar y asignar cada campo con valores por defecto seguros
                $this->setIdTransaccionesDepositosRetirosCuentas($Gestiones['idtransaccioncuentas'] ?? 0);
                $this->setIdUsuarios($Gestiones['idusuarios'] ?? 0);
                $this->setIdProductos($Gestiones['idproducto'] ?? 0);
                $this->setIdCuentaAhorroClientes($Gestiones['idcuentas'] ?? 0);
                $this->setNumeroCuentaAhorroClientes($Gestiones['numerocuenta'] ?? '');
                $this->setCodigoProductos($Gestiones['codigo'] ?? '');
                $this->setNombreProductos($Gestiones['nombreproducto'] ?? '');
                $this->setNombresUsuarios($Gestiones['nombres'] ?? '');
                $this->setApellidosUsuarios($Gestiones['apellidos'] ?? '');
                $this->setduiUsuarios($Gestiones['dui'] ?? '');
                $this->setNitUsuarios($Gestiones['nit'] ?? '');
                $this->setReferenciaTransaccionDepositosRetirosCuentas($Gestiones['referencia'] ?? '');
                $this->setMontoDepositosRetirosCuentas($Gestiones['monto'] ?? 0.00);
                $this->setFechaTransaccionDepositosRetirosCuentas($Gestiones['fecha'] ?? '');
                $this->setEmpleadoGestionTransaccionDepositosRetirosCuentas($Gestiones['empleado_gestion'] ?? '');
                $this->setTipoTransaccionDepositosRetirosCuentas($Gestiones['tipotransaccion'] ?? '');
                $this->setSaldoNuevoTransaccionDepositosRetirosCuentas($Gestiones['saldonuevocuenta_transaccion'] ?? 0.00);
                $this->setEstadoTransaccionDepositosRetirosCuentas($Gestiones['estadotransaccion'] ?? '');
            }
        } catch (Exception $e) {
            // Registrar el error
            error_log("Error en ConsultaDetallesTransaccionCuentasClientes_Comprobantes: " . $e->getMessage());
            throw $e; // Relanzar para manejo superior
        } finally {
            // Liberar recursos
            if ($resultado !== false) {
                mysqli_free_result($resultado);
            }
            if ($stmt !== null) {
                mysqli_stmt_close($stmt);
            }
        }

        return $this;
    }
    /*
        -> IMPORTANTE: ESTA CONSULTA ES VALIDA PARA LA PRIMER TRANSACCION [TRANSACCION NUMERO UNO -> 1] QUE LOS CLIENTES REALICEN, ES DECIR LA PRIMERA ASOCIADA SEGUN EL ID DE USUARIO / CLIENTE... PARA LA MUESTRA AUTOMATICA DEL COMPROBANTE, ES LA CONSULTA ANTERIOR
        MOTIVO -> OBTENER TODOS LOS DATOS, YA QUE SIN REGISTRO PREVIO NO HAY COMPROBANTE QUE MOSTRAR
    */
    // CONSULTA COMPLETA ESPECIFICA DE DATOS CLIENTES -> CUENTAS DE AHORRO REGISTRADAS [PRIMERA VEZ]
    public function ConsultaDetallesTransaccionCuentasClientes_ComprobantesPrimerTransaccion($conectarsistema, $IdUsuarios)
    {
        // Validar y sanitizar el ID de usuario
        $IdUsuarios = filter_var($IdUsuarios, FILTER_VALIDATE_INT);
        if ($IdUsuarios === false || $IdUsuarios <= 0) {
            throw new InvalidArgumentException("ID de usuario no válido");
        }

        // Inicializar variables
        $resultado = false;
        $Gestiones = null;

        try {
            // Preparar la llamada al procedimiento almacenado de forma segura
            $consulta = "CALL ConsultaDetalleComprobanteDepositoCuentasAhorroClientes_P1(?);";

            // Preparar la sentencia
            $stmt = mysqli_prepare($conectarsistema, $consulta);
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . mysqli_error($conectarsistema));
            }

            // Vincular parámetros
            mysqli_stmt_bind_param($stmt, "i", $IdUsuarios);

            // Ejecutar la consulta
            if (!mysqli_stmt_execute($stmt)) {
                throw new RuntimeException("Error al ejecutar la consulta: " . mysqli_stmt_error($stmt));
            }

            // Obtener resultados
            $resultado = mysqli_stmt_get_result($stmt);
            if (!$resultado) {
                throw new RuntimeException("Error al obtener resultados: " . mysqli_error($conectarsistema));
            }

            // Procesar resultados
            if (mysqli_num_rows($resultado) > 0) {
                $Gestiones = mysqli_fetch_assoc($resultado);

                // Validar y asignar cada campo
                $this->setIdTransaccionesDepositosRetirosCuentas($Gestiones['idtransaccioncuentas'] ?? null);
                $this->setIdUsuarios($Gestiones['idusuarios'] ?? null);
                $this->setIdProductos($Gestiones['idproducto'] ?? null);
                $this->setIdCuentaAhorroClientes($Gestiones['idcuentas'] ?? null);
                $this->setNumeroCuentaAhorroClientes($Gestiones['numerocuenta'] ?? null);
                $this->setCodigoProductos($Gestiones['codigo'] ?? null);
                $this->setNombreProductos($Gestiones['nombreproducto'] ?? null);
                $this->setNombresUsuarios($Gestiones['nombres'] ?? null);
                $this->setApellidosUsuarios($Gestiones['apellidos'] ?? null);
                $this->setduiUsuarios($Gestiones['dui'] ?? null);
                $this->setNitUsuarios($Gestiones['nit'] ?? null);
                $this->setReferenciaTransaccionDepositosRetirosCuentas($Gestiones['referencia'] ?? null);
                $this->setMontoDepositosRetirosCuentas($Gestiones['monto'] ?? null);
                $this->setFechaTransaccionDepositosRetirosCuentas($Gestiones['fecha'] ?? null);
                $this->setEmpleadoGestionTransaccionDepositosRetirosCuentas($Gestiones['empleado_gestion'] ?? null);
                $this->setTipoTransaccionDepositosRetirosCuentas($Gestiones['tipotransaccion'] ?? null);
            }

            // Liberar resultados
            mysqli_free_result($resultado);

            // Cerrar la sentencia
            mysqli_stmt_close($stmt);
        } catch (Exception $e) {
            // Limpiar recursos en caso de error
            if ($resultado !== false) {
                mysqli_free_result($resultado);
            }
            if (isset($stmt) && $stmt instanceof mysqli_stmt) {
                mysqli_stmt_close($stmt);
            }

            // Registrar el error (en un sistema real deberías usar un logger)
            error_log("Error en ConsultaDetallesTransaccionCuentasClientes: " . $e->getMessage());

            // Relanzar la excepción para manejo superior
            throw $e;
        }

        return $this;
    }
    // CONSULTAR ULTIMO ID DE TRANSACCION -> CUENTAS CLIENTES
    /**
     * Consulta el último ID de registro de transacción para cuentas de clientes
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @return bool True si la consulta fue exitosa, false en caso de error
     * @throws RuntimeException Si hay errores en la consulta SQL
     */
    public function ConsultarUltimoIdRegistroTransaccion_CuentasClientes(
        mysqli $conectarsistema
    ): bool {
        // Inicializar propiedades con valores por defecto
        $this->setUltimoIdTransaccionesDepositosRetirosCuentas(0);
        $this->setIdUsuarios(0);

        try {
            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultarUltimoIdTransaccion_CuentasClientes()");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();

                // Asignar valores con validación
                $this->setUltimoIdTransaccionesDepositosRetirosCuentas(
                    (int)($Gestiones['idtransaccioncuentas'] ?? 0)
                );
                $this->setIdUsuarios(
                    (int)($Gestiones['idusuarios'] ?? 0)
                );
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultarUltimoIdRegistroTransaccion_CuentasClientes: " . $e->getMessage());
            return false;
        }
    }
    // CONSULTA DETALLES COMPLETO DE TRANSACCIONES CUENTAS CLIENTES
    // -> VALIDO PARA CONSULTA PERSONAL [MIS TRANSACCIONES CLIENTES] Y CONSULTA GENERAL ESPECIFICA DE TRANSACCIONES POR CLIENTE
    // CONSULTA COMPLETA ESPECIFICA DE DATOS CLIENTES -> CUENTAS DE AHORRO REGISTRADAS
    public function ConsultaGeneralTransaccionesCuentasClientes($conectarsistema, $IdUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaEspecificaTransaccionesCuentasClientes('" . $IdUsuarios . "');");
        $Gestiones = mysqli_fetch_array($resultado); // RECORRIDO EN BUSCA DE REGISTRO CONSULTADO
        // EXTRAER DETALLES DE USUARIOS SOLAMENTE SI EXISTEN REGISTROS QUE SE SEAN ASOCIADOS
        // AL USUARIO QUE ESTA SIENDO CONSULTADO EN CUESTION Y NO SEA CONSULTA VACIA [NULA]
        if (mysqli_num_rows($resultado) > 0) {
            // OBTENER VALORES EXTRAIDOS EN LA CONSULTA
            $this->setIdTransaccionesDepositosRetirosCuentas($Gestiones['idtransaccioncuentas']);
            $this->setIdCuentaAhorroClientes($Gestiones['idcuentas']);
            $this->setIdUsuarios($Gestiones['idusuarios']);
            $this->setIdProductos($Gestiones['idproducto']);
            $this->setNombresUsuarios($Gestiones['nombres']);
            $this->setApellidosUsuarios($Gestiones['apellidos']);
            $this->setCodigoProductos($Gestiones['codigo']);
            $this->setNombreProductos($Gestiones['nombreproducto']);
            $this->setNumeroCuentaAhorroClientes($Gestiones['numerocuenta']);
            $this->setReferenciaTransaccionDepositosRetirosCuentas($Gestiones['referencia']);
            $this->setMontoDepositosRetirosCuentas($Gestiones['monto']);
            $this->setFechaTransaccionDepositosRetirosCuentas($Gestiones['fecha']);
            $this->setEmpleadoGestionTransaccionDepositosRetirosCuentas($Gestiones['empleado_gestion']);
            $this->setEstadoTransaccionDepositosRetirosCuentas($Gestiones['estadotransaccion']);
        } // CIERRE if(mysqli_num_rows($resultado)>0){
    }
    // CONSULTA ESPECIFICA DE TRANSACCIONES REGISTRADAS CUENTAS CLIENTES [MIS TRANSACCIONES]

    public function ConsultaMisTransaccionesCuentasClientes($conectarsistema, $IdUsuarios, $fechaInicio = null, $fechaFin = null, $tipoTransaccion = 'all', $estadoTransaccion = 'all', $pagina = 1, $porPagina = 10)
    {
        // Calcular offset para paginación
        $offset = ($pagina - 1) * $porPagina;

        // Construir consulta base
        $sql = "SELECT * FROM vista_consultadetallecompletotransaccionescuentasclientes 
            WHERE idusuarios = ?";

        // Parámetros y tipos
        $params = [$IdUsuarios];
        $types = "i";

        // Aplicar filtros
        if ($fechaInicio && $fechaFin) {
            $sql .= " AND fecha BETWEEN ? AND ?";
            $params[] = $fechaInicio;
            $params[] = $fechaFin;
            $types .= "ss";
        }

        if ($tipoTransaccion != 'all') {
            if ($tipoTransaccion == 'Transferencia') {
                $sql .= " AND (tipotransaccion = 'EnvioTransferencia' OR tipotransaccion = 'DepositoTransferencia')";
            } else {
                $sql .= " AND tipotransaccion = ?";
                $params[] = $tipoTransaccion;
                $types .= "s";
            }
        }

        if ($estadoTransaccion != 'all') {
            $sql .= " AND estadotransaccion = ?";
            $params[] = $estadoTransaccion;
            $types .= "s";
        }

        // Orden y paginación
        $sql .= " ORDER BY fecha DESC LIMIT ? OFFSET ?";
        $params[] = $porPagina;
        $params[] = $offset;
        $types .= "ii";

        // Preparar consulta
        $stmt = $conectarsistema->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function ObtenerTotalTransaccionesCuentasClientes($conectarsistema, $IdUsuarios, $fechaInicio = null, $fechaFin = null, $tipoTransaccion = 'all', $estadoTransaccion = 'all')
    {
        // Construir consulta base
        $sql = "SELECT COUNT(*) as total FROM vista_consultadetallecompletotransaccionescuentasclientes 
            WHERE idusuarios = ?";

        // Parámetros y tipos
        $params = [$IdUsuarios];
        $types = "i";

        // Aplicar filtros
        if ($fechaInicio && $fechaFin) {
            $sql .= " AND fecha BETWEEN ? AND ?";
            $params[] = $fechaInicio;
            $params[] = $fechaFin;
            $types .= "ss";
        }

        if ($tipoTransaccion != 'all') {
            if ($tipoTransaccion == 'Transferencia') {
                $sql .= " AND (tipotransaccion = 'EnvioTransferencia' OR tipotransaccion = 'DepositoTransferencia')";
            } else {
                $sql .= " AND tipotransaccion = ?";
                $params[] = $tipoTransaccion;
                $types .= "s";
            }
        }

        if ($estadoTransaccion != 'all') {
            $sql .= " AND estadotransaccion = ?";
            $params[] = $estadoTransaccion;
            $types .= "s";
        }

        // Preparar consulta
        $stmt = $conectarsistema->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['total'];
    }
    // CONSULTA GENERAL DE TRANSACCIONES REGISTRADAS CUENTAS CLIENTES [TODOS LOS CLIENTES QUE POSEEAN CUENTAS] -> FILTRO SOLAMENTE TRANSACCIONES PROCESADAS
    // Consulta con filtros para transacciones procesadas
    public function ConsultaFiltradaTransaccionesProcesadas($conectarsistema, $busqueda, $numero_cuenta, $fecha_inicio, $fecha_fin, $tipo_transaccion, $limite, $offset)
    {
        $sql = "SELECT * FROM vista_consultatransaccionescuentasclientes 
                WHERE estadotransaccion = 'Procesada'";

        $params = [];
        $types = '';

        // Filtro de búsqueda
        if (!empty($busqueda)) {
            $sql .= " AND (nombres LIKE ? OR apellidos LIKE ? OR dui LIKE ? OR referencia LIKE ?)";
            $searchTerm = "%" . $busqueda . "%";
            $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
            $types .= 'ssss';
        }

        // Filtro por número de cuenta
        if (!empty($numero_cuenta)) {
            $sql .= " AND numerocuenta = ?";
            $params[] = $numero_cuenta;
            $types .= 's';
        }

        // Filtro por fecha
        if (!empty($fecha_inicio) && !empty($fecha_fin)) {
            $sql .= " AND fecha BETWEEN ? AND ?";
            $params[] = $fecha_inicio;
            $params[] = $fecha_fin . ' 23:59:59';
            $types .= 'ss';
        }

        // Filtro por tipo de transacción
        if ($tipo_transaccion != 'all') {
            $sql .= " AND tipotransaccion = ?";
            $params[] = $tipo_transaccion;
            $types .= 's';
        }

        $sql .= " ORDER BY fecha DESC LIMIT ? OFFSET ?";
        $params[] = (int)$limite;
        $params[] = (int)$offset;
        $types .= 'ii';

        $stmt = $conectarsistema->prepare($sql);
        if ($types) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();

        return $stmt->get_result();
    }

    public function ContarTransaccionesProcesadasFiltradas($conectarsistema, $busqueda, $numero_cuenta, $fecha_inicio, $fecha_fin, $tipo_transaccion)
    {
        $sql = "SELECT COUNT(*) as total FROM vista_consultatransaccionescuentasclientes 
                WHERE estadotransaccion = 'Procesada'";

        $params = [];
        $types = '';

        if (!empty($busqueda)) {
            $sql .= " AND (nombres LIKE ? OR apellidos LIKE ? OR dui LIKE ? OR referencia LIKE ?)";
            $searchTerm = "%" . $busqueda . "%";
            $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
            $types .= 'ssss';
        }

        if (!empty($numero_cuenta)) {
            $sql .= " AND numerocuenta = ?";
            $params[] = $numero_cuenta;
            $types .= 's';
        }

        if (!empty($fecha_inicio) && !empty($fecha_fin)) {
            $sql .= " AND fecha BETWEEN ? AND ?";
            $params[] = $fecha_inicio;
            $params[] = $fecha_fin . ' 23:59:59';
            $types .= 'ss';
        }

        if ($tipo_transaccion != 'all') {
            $sql .= " AND tipotransaccion = ?";
            $params[] = $tipo_transaccion;
            $types .= 's';
        }

        $stmt = $conectarsistema->prepare($sql);
        if ($types) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['total'];
    }

    public function ConsultaFiltradaTransaccionesAnuladas($conectarsistema, $busqueda, $numero_cuenta, $fecha_inicio, $fecha_fin, $tipo_transaccion, $limite, $offset)
    {
        $sql = "SELECT * FROM vista_consultatransaccionescuentasclientes 
                WHERE (estadotransaccion = 'AnularDeposito' OR estadotransaccion = 'AnularRetiro')";

        $params = [];
        $types = '';

        if (!empty($busqueda)) {
            $sql .= " AND (nombres LIKE ? OR apellidos LIKE ? OR dui LIKE ? OR referencia LIKE ?)";
            $searchTerm = "%" . $busqueda . "%";
            $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
            $types .= 'ssss';
        }

        if (!empty($numero_cuenta)) {
            $sql .= " AND numerocuenta = ?";
            $params[] = $numero_cuenta;
            $types .= 's';
        }

        if (!empty($fecha_inicio) && !empty($fecha_fin)) {
            $sql .= " AND fecha BETWEEN ? AND ?";
            $params[] = $fecha_inicio;
            $params[] = $fecha_fin . ' 23:59:59';
            $types .= 'ss';
        }

        if ($tipo_transaccion != 'all') {
            $sql .= " AND tipotransaccion = ?";
            $params[] = $tipo_transaccion;
            $types .= 's';
        }

        $sql .= " ORDER BY fecha DESC LIMIT ? OFFSET ?";
        $params[] = (int)$limite;
        $params[] = (int)$offset;
        $types .= 'ii';

        $stmt = $conectarsistema->prepare($sql);
        if ($types) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();

        return $stmt->get_result();
    }

    public function ContarTransaccionesAnuladasFiltradas($conectarsistema, $busqueda, $numero_cuenta, $fecha_inicio, $fecha_fin, $tipo_transaccion)
    {
        $sql = "SELECT COUNT(*) as total FROM vista_consultatransaccionescuentasclientes 
                WHERE (estadotransaccion = 'AnularDeposito' OR estadotransaccion = 'AnularRetiro')";

        $params = [];
        $types = '';

        if (!empty($busqueda)) {
            $sql .= " AND (nombres LIKE ? OR apellidos LIKE ? OR dui LIKE ? OR referencia LIKE ?)";
            $searchTerm = "%" . $busqueda . "%";
            $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
            $types .= 'ssss';
        }

        if (!empty($numero_cuenta)) {
            $sql .= " AND numerocuenta = ?";
            $params[] = $numero_cuenta;
            $types .= 's';
        }

        if (!empty($fecha_inicio) && !empty($fecha_fin)) {
            $sql .= " AND fecha BETWEEN ? AND ?";
            $params[] = $fecha_inicio;
            $params[] = $fecha_fin . ' 23:59:59';
            $types .= 'ss';
        }

        if ($tipo_transaccion != 'all') {
            $sql .= " AND tipotransaccion = ?";
            $params[] = $tipo_transaccion;
            $types .= 's';
        }

        $stmt = $conectarsistema->prepare($sql);
        if ($types) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['total'];
    }
    // ANULAR TRANSACCIONES DE DEPOSITOS PROCESADAS -> CUENTAS CLIENTES
    public function AnularDepositosProcesadosClientes($conectarsistema, $IdTransaccionesDepositoCuentas)
    {
        $resultado = mysqli_query($conectarsistema, "CALL AnularDepositosTransaccionesCuentasClientes('" . $IdTransaccionesDepositoCuentas . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // ANULAR TRANSACCIONES DE RETIROS PROCESADAS -> CUENTAS CLIENTES
    public function AnularRetirosProcesadosClientes($conectarsistema, $IdTransaccionesDepositoCuentas)
    {
        $resultado = mysqli_query($conectarsistema, "CALL AnularRetirosTransaccionesCuentasClientes('" . $IdTransaccionesDepositoCuentas . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // REGISTRAR CODIGO DE SEGURIDAD AUTOMATICAMENTE AL MOMENTO DE VALIDAR NUMERO DE CUENTA  -> VALIDO PARA TODOS LOS USUARIOS QUE POSEAN UNA CUENT
    public function RegistroCodigoSeguridad_TransferenciasCuentas($conectarsistema, $CodigoSeguridadTransferencias, $IdUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL RegistroCodigoSeguridadTransferenciasCuentasClientes('" . $CodigoSeguridadTransferencias . "','" . $IdUsuarios . "');");
        return $resultado;
    }
    // REGISTRAR TRANSFERENCIAS ENVIADAS Y PROCESADAS CUENTAS CLIENTES -> VALIDO PARA TODOS LOS USUARIOS QUE POSEAN UNA CUENTA 
    public function RegistroTransferenciasCuentasClientes($conectarsistema, $NumeroCuentaAhorroClientes, $MontoTransferencia, $ReferenciaTransferencia, $EstadoTransferencia, $IdUsuarios, $IdUsuarioDestinoTransferencia, $IdProductos, $IdCuentaAhorroClientes, $IdCuentaAhorroClientesDestino)
    {
        $resultado = mysqli_query($conectarsistema, "CALL RegistrarTransferenciasEnviadasClientes('" . $NumeroCuentaAhorroClientes . "','" . $MontoTransferencia . "','" . $ReferenciaTransferencia . "','" . $EstadoTransferencia . "','" . $IdUsuarios . "','" . $IdUsuarioDestinoTransferencia . "','" . $IdProductos . "','" . $IdCuentaAhorroClientes . "','" . $IdCuentaAhorroClientesDestino . "');");
        return $resultado;
    }
    // BLOQUEAR CUENTAS DE AHORRO REGISTRADAS -> CUENTAS CLIENTES
    public function BloquearCuentasAhorroClientes($conectarsistema, $IdCuentaAhorroClientes)
    {
        $resultado = mysqli_query($conectarsistema, "CALL BloquearCuentasAhorroRegistradasClientes('" . $IdCuentaAhorroClientes . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // CERRAR CUENTAS DE AHORRO REGISTRADAS -> CUENTAS CLIENTES
    public function CerrarCuentasAhorroClientes($conectarsistema, $IdCuentaAhorroClientes)
    {
        $resultado = mysqli_query($conectarsistema, "CALL CerrarCuentasAhorroRegistradasClientes('" . $IdCuentaAhorroClientes . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // ACTIVAR CUENTAS DE AHORRO REGISTRADAS -> CUENTAS CLIENTES
    // -> MANTENIMIENTO VALIDO PARA CUENTAS CERRADAS Y BLOQUEADAS
    public function ActivarCuentasAhorroClientes($conectarsistema, $IdCuentaAhorroClientes)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ActivarCuentasAhorroRegistradasClientes('" . $IdCuentaAhorroClientes . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // CONSULTA AVANCE DE CREDITOS ASIGNADOS CLIENTES -> VALIDO PARA INTERFAZ DE INICIO CLIENTE InversGlobal
    public function ConsultarAvanceCreditos_ClientesCashmanhaInterfaz(mysqli $conectarsistema, int $IdUsuarios): bool
    {
        // Inicializar todos los valores por defecto
        $this->setIdCreditos(0);
        $this->setIdUsuarios(0);
        $this->setIdProductos(0);
        $this->setNombreProductos('');
        $this->setCodigoProductos('');
        $this->setMontoFinanciamientoCreditos(0.0);
        $this->setCuotaMensualCreditos(0.0);
        $this->setTasaInteresCreditos(0.0);
        $this->setTipoAmortizacion('');
        $this->setTipoPago('');
        $this->setTiempoPlazoCreditos(0);
        $this->setMontoCapitalClientes(0.0);
        $this->setTotalCuotasCanceladasCreditosClientes(0);
        $this->setComprobacion_EnviarAlHistoricoClientes(0);

        try {
            // Validar ID de usuario
            if ($IdUsuarios <= 0) {
                throw new InvalidArgumentException("ID de usuario inválido");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultarAvanceCreditosClientes_InterfazInicioClientes(?);");
            if (!$stmt) {
                throw new Exception("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("i", $IdUsuarios);
            if (!$stmt->execute()) {
                throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();

                // Asignar valores con validación
                $this->setIdCreditos((int)($Gestiones['idcreditos'] ?? 0));
                $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
                $this->setIdProductos((int)($Gestiones['idproducto'] ?? 0));
                $this->setNombreProductos((string)($Gestiones['nombreproducto'] ?? ''));
                $this->setCodigoProductos((string)($Gestiones['codigo'] ?? ''));
                $this->setMontoFinanciamientoCreditos((float)($Gestiones['montocredito'] ?? 0.0));
                $this->setCuotaMensualCreditos((float)($Gestiones['cuotamensual'] ?? 0.0));
                $this->setTasaInteresCreditos((float)($Gestiones['interescredito'] ?? 0.0));
                $this->setTipoAmortizacion((string)($Gestiones['tipo_amortizacion'] ?? ''));
                $this->setTipoPago((string)($Gestiones['tipo_pago'] ?? ''));
                $this->setTiempoPlazoCreditos((int)($Gestiones['plazocredito'] ?? 0));
                $this->setMontoCapitalClientes((float)($Gestiones['montocapital'] ?? 0.0));
                $this->setTotalCuotasCanceladasCreditosClientes((int)($Gestiones['cuotas_canceladas'] ?? 0));
                $this->setComprobacion_EnviarAlHistoricoClientes((int)($Gestiones['enviaralhistorico'] ?? 0));
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultarAvanceCreditos_ClientesCashmanhaInterfaz: " . $e->getMessage());
            return false;
        }
    }
    // CONSULTAR LISTADO ULTIMAS 200 TRANSACCIONES PROCESADAS CLIENTES -> INTERFAZ CLIENTES
    public function ConsultarListadoUltimasTrasacciones_PortalClientes($conectarsistema, $IdUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultarTransaccionesProcesadasClientes_PortalInicioClientes('" . $IdUsuarios . "');");
        return $resultado;
    }
    // CONSULTAR LISTADO ULTIMAS 200 TRANSACCIONES PROCESADAS CLIENTES -> INTERFAZ ATENCION AL CLIENTE
    public function ConsultarListadoUltimasTrasacciones_PortalAtencionClientes($conectarsistema, $CodigoUsuarios)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ConsultaDetalleCompletoTransacciones_PagoCuotasCreditosEmpleados('" . $CodigoUsuarios . "');");
        return $resultado;
    }
    // CONSULTAR TOTAL DE TRANSACCIONES PROCESADAS -> SEGUN CODIGO UNICO DE USUARIOS [INICIO INTERFAZ EMPLEADOS DE ATENCION AL CLIENTE]
    /**
     * Consulta el contador de transacciones procesadas por empleados de atención al cliente
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param string $CodigoUsuarios Código único del usuario
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function Consulta_ContadorTransaccionesProcesadas_AtencionClientes(mysqli $conectarsistema, string $CodigoUsuarios): bool
    {
        // Inicializar valor por defecto
        $this->setTotalTransaccionesProcesadas_AtencionClientes(0);

        try {
            // Validar código de usuario
            if (empty(trim($CodigoUsuarios))) {
                throw new InvalidArgumentException("El código de usuario no puede estar vacío");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ContadorTransaccionesProcesadas_EmpleadosAtencionClientes(?);");
            if (!$stmt) {
                throw new Exception("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("s", $CodigoUsuarios);
            if (!$stmt->execute()) {
                throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();
            $Gestiones = $resultado->fetch_assoc();

            if ($Gestiones) {
                $this->setTotalTransaccionesProcesadas_AtencionClientes(
                    (int)($Gestiones['numero_transacciones_empleados_atencionclientes'] ?? 0)
                );
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en Consulta_ContadorTransaccionesProcesadas_AtencionClientes: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Consulta el contador de solicitudes de crédito procesadas por empleados de atención al cliente
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param string $CodigoUsuarios Código único del usuario
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function Consulta_ContadorSolicitudesCreditosProcesadas_AtencionClientes(mysqli $conectarsistema, string $CodigoUsuarios): bool
    {
        // Inicializar valor por defecto
        $this->setTotalSolicitudesCreditosProcesadas_AtencionClientes(0);

        try {
            // Validar código de usuario
            if (empty(trim($CodigoUsuarios))) {
                throw new InvalidArgumentException("El código de usuario no puede estar vacío");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultaSolicitudesCreditosProcesadas_EmpleadosAtencionClientes(?);");
            if (!$stmt) {
                throw new Exception("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("s", $CodigoUsuarios);
            if (!$stmt->execute()) {
                throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();
            $Gestiones = $resultado->fetch_assoc();

            if ($Gestiones) {
                $this->setTotalSolicitudesCreditosProcesadas_AtencionClientes(
                    (int)($Gestiones['numero_creditos_gestionados'] ?? 0)
                );
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en Consulta_ContadorSolicitudesCreditosProcesadas_AtencionClientes: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Consulta el total de ingresos por transacciones de crédito procesadas por empleados de atención al cliente
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param string $CodigoUsuarios Código único del usuario
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function Consulta_TotalIngresosTransaccionesCreditosProcesadas_AtencionClientes(mysqli $conectarsistema, string $CodigoUsuarios): bool
    {
        // Inicializar valor por defecto
        $this->setTotalIngresosTransaccionesCreditos_AtencionClientes(0);

        try {
            // Validar código de usuario
            if (empty(trim($CodigoUsuarios))) {
                throw new InvalidArgumentException("El código de usuario no puede estar vacío");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultaTotalIngresosTransaccionesCreditos_EmpleadosAtencion(?);");
            if (!$stmt) {
                throw new Exception("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("s", $CodigoUsuarios);
            if (!$stmt->execute()) {
                throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();
            $Gestiones = $resultado->fetch_assoc();

            if ($Gestiones) {
                $this->setTotalIngresosTransaccionesCreditos_AtencionClientes(
                    (float)($Gestiones['monto_transacciones_empleados'] ?? 0.0)
                );
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en Consulta_TotalIngresosTransaccionesCreditosProcesadas_AtencionClientes: " . $e->getMessage());
            return false;
        }
    }
    // ACTUALIZACION CONFIGURACION MUY ESPECIFICA DE CUENTA USUARIOS [NUEVOS USUARIOS QUE INICIAN SESION POR PRIMERA VEZ]
    public function ActualizacionDatosCuentas_InicioSesionPrimeraVez($conectarsistema, $IdUsuarios, $CodigoUnicoUsuario, $ContraseniaUsuarios, $ComprobadorNuevoUsuario)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ActualizacionDatosCuenta_InicioSesionUsuariosPrimeraVez('" . $IdUsuarios . "','" . $CodigoUnicoUsuario . "','" . $ContraseniaUsuarios . "','" . $ComprobadorNuevoUsuario . "');");
        return $resultado;
    }
    // MOSTRAR DATOS COPIAS DE CONTRATOS SUSCRITOS -> CREDITOS ACTIVOS EN CURSO CLIENTES
    /**
     * Consulta la copia del contrato de créditos para clientes
     * 
     * @param mysqli $conectarsistema Conexión a la base de datos
     * @param int $IdUsuarios ID del usuario
     * @return bool True si la consulta fue exitosa, false en caso de error
     */
    public function ConsultarCopiaContratoCreditosClientes(mysqli $conectarsistema, int $IdUsuarios): bool
    {
        // Inicializar propiedades con valores por defecto
        $this->setIdUsuarios(0);
        $this->setNombreCopiaContratosSuscritosCreditosClientes('');

        try {
            // Validar ID de usuario
            if ($IdUsuarios <= 0) {
                throw new InvalidArgumentException("ID de usuario inválido");
            }

            // Preparar consulta con parámetros seguros
            $stmt = $conectarsistema->prepare("CALL ConsultarCopiaContratoCreditos_Clientes(?)");
            if (!$stmt) {
                throw new RuntimeException("Error al preparar la consulta: " . $conectarsistema->error);
            }

            $stmt->bind_param("i", $IdUsuarios);
            if (!$stmt->execute()) {
                throw new RuntimeException("Error al ejecutar la consulta: " . $stmt->error);
            }

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows > 0) {
                $Gestiones = $resultado->fetch_assoc();

                // Asignar valores con validación
                $this->setIdUsuarios((int)($Gestiones['idusuarios'] ?? 0));
                $this->setNombreCopiaContratosSuscritosCreditosClientes(
                    $this->sanitizeString($Gestiones['copiacontratocliente'] ?? '')
                );
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error en ConsultarCopiaContratoCreditosClientes: " . $e->getMessage());
            return false;
        }
    }
    // CONSULTAR ESTADO SOLICITUD CREDITICIA -> PORTAL CLIENTES [BIENVENIDA NUEVOS CLIENTES]
    /**
     * Consulta el estado de solicitud crediticia para nuevos clientes en el portal
     * 
     * @param mysqli $conectarsistema Conexión MySQLi válida
     * @param int $IdUsuarios ID del usuario a consultar
     * @return $this
     * @throws InvalidArgumentException Si el ID de usuario no es válido
     * @throws RuntimeException Si ocurre un error en la consulta SQL
     */
    public function ConsultarEstadoSolicitudCrediticia_PortalNuevosClientes(
        mysqli $conectarsistema,
        int $IdUsuarios
    ) {
        // Validación estricta del parámetro de entrada
        if ($IdUsuarios <= 0) {
            throw new InvalidArgumentException("El ID de usuario debe ser un valor positivo");
        }

        $stmt = null;
        $resultado = false;

        try {
            // Preparar la llamada al procedimiento almacenado
            $query = "CALL ConsultarEstadoSolicitudCrediticia_BienvenidaPortalClientes(?)";
            $stmt = mysqli_prepare($conectarsistema, $query);

            if (!$stmt) {
                throw new RuntimeException(
                    "Error al preparar la consulta: " . mysqli_error($conectarsistema)
                );
            }

            // Vincular parámetro de forma segura
            mysqli_stmt_bind_param($stmt, "i", $IdUsuarios);

            // Ejecutar la consulta
            if (!mysqli_stmt_execute($stmt)) {
                throw new RuntimeException(
                    "Error al ejecutar la consulta: " . mysqli_stmt_error($stmt)
                );
            }

            // Obtener resultados
            $resultado = mysqli_stmt_get_result($stmt);
            if (!$resultado) {
                throw new RuntimeException(
                    "Error al obtener resultados: " . mysqli_error($conectarsistema)
                );
            }

            // Procesar resultados si existen
            if (mysqli_num_rows($resultado) > 0) {
                $Gestiones = mysqli_fetch_assoc($resultado);

                // Asignación segura con valores por defecto
                $this->setIdUsuarios($Gestiones['idusuarios'] ?? 0);
                $this->setEstadoActualCreditos($Gestiones['estado'] ?? 'Pendiente');
                $this->setProgresoInicialSolicitudCreditos($Gestiones['progreso_solicitud'] ?? 0);
                $this->setNombreProductos($Gestiones['nombreproducto'] ?? 'No especificado');
                $this->setCodigoProductos($Gestiones['codigo'] ?? '');
            }
        } catch (Exception $e) {
            // Registrar el error de forma segura
            error_log("[" . date('Y-m-d H:i:s') . "] Error en ConsultarEstadoSolicitudCrediticia_PortalNuevosClientes: "
                . $e->getMessage() . " - ID Usuario: " . $IdUsuarios);
            throw $e; // Relanzar para manejo superior
        } finally {
            // Limpieza garantizada de recursos
            if ($resultado !== false) {
                mysqli_free_result($resultado);
            }
            if ($stmt !== null) {
                mysqli_stmt_close($stmt);
            }
        }
        return $this;
    }
    // ACTUALIZACION SALDO CREDITOS CLIENTES -> REESTRUCTURACION SOLICITUDES CREDITOS CLIENTES
    public function ActualizacionSaldoCreditosClientes_Reestructuracion($conectarsistema, $IdUsuarios, $NuevoSaldoCreditosClientes)
    {
        $resultado = mysqli_query($conectarsistema, "CALL ActualizacionSaldoCreditosClientes_ReestructuracionSolicitudes('" . $IdUsuarios . "','" . $NuevoSaldoCreditosClientes . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    // -> ELIMINAR SOLICITUDES CREDITICIAS -> MANTENIMIENTO VALIDO SOLO PARA CLIENTES QUE HAN FINALIZADO DE CANCELAR SU SOLICITUD CREDITICIA AL 100%
    public function EliminarSolicitudesCrediticiasActivasCanceladas($conectarsistema, $IdCreditos)
    {
        $resultado = mysqli_query($conectarsistema, "CALL EliminarSolicitudesCrediticiasCanceladas_Clientes('" . $IdCreditos . "');");
        if ($resultado) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
}// CIERRE class GestionesClientes
