<?php

class RecuperacionCuentas
{
    /**
     * INSERTAR DATOS DE RECUPERACIÓN - SOLICITUD DE REESTABLECIMIENTO DE CONTRASEÑAS
     */
    public function RecuperarCuentasUsuarios($conectarsistema, $Destinatario, $Token, $CodigoRecuperacion)
    {
        try {
            // Validación y sanitización de entradas
            $Destinatario = $this->sanitizeEmail($Destinatario);
            $Token = $this->sanitizeInput($Token);
            $CodigoRecuperacion = $this->sanitizeInput($CodigoRecuperacion);
            
            $stmt = $conectarsistema->prepare("CALL ReestablecerContrasenias(?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Error al preparar la consulta: " . $conectarsistema->error);
            }
            
            $stmt->bind_param("sss", $Destinatario, $Token, $CodigoRecuperacion);
            $resultado = $stmt->execute();
            $stmt->close();
            
            $this->redirect($resultado ? 
                '../controlador/cIniciosSesionesUsuarios.php?cashmanha=confirmacion-recuperacion-cuentas' :
                '../controlador/cIniciosSesionesUsuarios.php?cashmanha=iniciarsesion');
                
        } catch (Exception $e) {
            error_log('Error en RecuperarCuentasUsuarios: ' . $e->getMessage());
            $this->redirect('../controlador/cIniciosSesionesUsuarios.php?cashmanha=iniciarsesion');
        }
    }

    /**
     * CAMBIO DE CONTRASEÑAS - RECUPERACIÓN DE CUENTAS
     */
    public function CambioContraseniaRecuperacion($conectarsistema, $Correo, $Contrasenia)
    {
        try {
            $Correo = $this->sanitizeEmail($Correo);
            $Contrasenia = $this->sanitizeInput($Contrasenia);
            
            $stmt = $conectarsistema->prepare("CALL CambioContraseniaRecuperacion(?, ?)");
            if (!$stmt) {
                throw new Exception("Error al preparar la consulta: " . $conectarsistema->error);
            }
            
            $stmt->bind_param("ss", $Contrasenia, $Correo);
            $resultado = $stmt->execute();
            $stmt->close();
            
            $this->redirect($resultado ? 
                '../controlador/cIniciosSesionesUsuarios.php?cashmanha=confirmacion-cambio-contrasenia' :
                '../controlador/cIniciosSesionesUsuarios.php?cashmanha=error-cambio-contrasenia');
                
        } catch (Exception $e) {
            error_log('Error en CambioContraseniaRecuperacion: ' . $e->getMessage());
            $this->redirect('../controlador/cIniciosSesionesUsuarios.php?cashmanha=error-cambio-contrasenia');
        }
    }

    /**
     * CAMBIO ESTADO CÓDIGO DE SEGURIDAD
     */
    public function CambioEstadoCodigoSeguridad($conectarsistema, $Correo, $TokenSeguridad, $CodigoSeguridad, $Estado)
    {
        try {
            $Correo = $this->sanitizeEmail($Correo);
            $TokenSeguridad = $this->sanitizeInput($TokenSeguridad);
            $CodigoSeguridad = $this->sanitizeInput($CodigoSeguridad);
            $Estado = $this->sanitizeInput($Estado);
            
            $stmt = $conectarsistema->prepare("CALL CambioEstadoToken(?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Error al preparar la consulta: " . $conectarsistema->error);
            }
            
            $stmt->bind_param("ssss", $Correo, $TokenSeguridad, $CodigoSeguridad, $Estado);
            return $stmt->execute();
            
        } catch (Exception $e) {
            error_log('Error en CambioEstadoCodigoSeguridad: ' . $e->getMessage());
            return false;
        } finally {
            if (isset($stmt)) $stmt->close();
        }
    }

    /**
     * REGISTRO DE ACCESOS
     */
    public function RegistrarAccesosUsuarios($conectarsistema, $Dispositivo, $SistemaOperativo, $IdUsuarios)
    {
        try {
            $Dispositivo = $this->sanitizeInput($Dispositivo);
            $SistemaOperativo = $this->sanitizeInput($SistemaOperativo);
            $IdUsuarios = filter_var($IdUsuarios, FILTER_VALIDATE_INT);
            
            if ($IdUsuarios === false) {
                throw new Exception("ID de usuario no válido");
            }
            
            $stmt = $conectarsistema->prepare("CALL RegistrarAccesosUsuarios(?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Error al preparar la consulta: " . $conectarsistema->error);
            }
            
            $stmt->bind_param("ssi", $Dispositivo, $SistemaOperativo, $IdUsuarios);
            return $stmt->execute();
            
        } catch (Exception $e) {
            error_log('Error en RegistrarAccesosUsuarios: ' . $e->getMessage());
            return false;
        } finally {
            if (isset($stmt)) $stmt->close();
        }
    }

    /**
     * Sanitiza emails (alternativa moderna)
     */
    private function sanitizeEmail($email)
    {
        $sanitized = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($sanitized, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Correo electrónico no válido");
        }
        return $sanitized;
    }

    /**
     * Alternativa moderna a FILTER_SANITIZE_STRING
     */
    private function sanitizeInput($input)
    {
        // Elimina etiquetas HTML y PHP
        $cleaned = strip_tags($input);
        // Escapa caracteres especiales para uso en SQL
        return htmlspecialchars($cleaned, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * Redirección segura
     */
    private function redirect($url)
    {
        if (!headers_sent()) {
            header("Location: " . $url);
            exit();
        }
    }
}