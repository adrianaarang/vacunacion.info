<?php

/**
 * Clase BBDD: gestiona la conexión y operaciones con la base de datos de vacunacion.info
 * @author adriana
 */
class BBDD {

    // ✅ Propiedades de conexión
    private $cadena_conexion = 'mysql:dbname=vacunacion.info;host=localhost';
    private $usuario = 'root';
    private $password = '';
    public $db; // Objeto PDO con la conexión activa

    // ✅ Constructor: se ejecuta al instanciar la clase
    public function __construct() {
        try {
            $this->db = new PDO($this->cadena_conexion, $this->usuario, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activar errores como excepciones
        } catch (Exception $ex) {
            die("Error al conectar con la base de datos: " . $ex->getMessage());
        }
    }

    // ✅ Obtener todas las comunidades autónomas
    public function obtenerComunidades() {
        $sql = "SELECT * FROM comunidades";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Eliminar la imagen del calendario de una comunidad
    public function eliminarImagenComunidad($id) {
        $sql = "UPDATE comunidades SET foto_calendario = NULL WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // ✅ Actualizar la imagen del calendario de una comunidad
    public function actualizarImagenComunidad($id, $ruta) {
        $sql = "UPDATE comunidades SET foto_calendario = :ruta WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['ruta' => $ruta, 'id' => $id]);
    }

    // ✅ Insertar un nuevo usuario con sus hijos
    public function insertarUsuarioConHijosPlano($nombre, $email, $passwordPlano, $fechasNacimiento, $comunidadId) {
        try {
            $this->db->beginTransaction();

            // Insertar usuario
            $sqlUsuario = "INSERT INTO usuarios (nombre, email, password, comunidad_id) 
                           VALUES (:nombre, :email, :password, :comunidad_id)";
            $stmt = $this->db->prepare($sqlUsuario);
            $stmt->execute([
                'nombre' => $nombre,
                'email' => $email,
                'password' => $passwordPlano,
                'comunidad_id' => $comunidadId
            ]);
            $usuarioId = $this->db->lastInsertId();

            // Insertar hijos
            if (!empty($fechasNacimiento)) {
                $sqlHijo = "INSERT INTO hijos (usuario_id, fecha_nacimiento) 
                            VALUES (:usuario_id, :fecha)";
                $stmtHijo = $this->db->prepare($sqlHijo);
                foreach ($fechasNacimiento as $fecha) {
                    $stmtHijo->execute([
                        'usuario_id' => $usuarioId,
                        'fecha' => $fecha
                    ]);
                }
            }

            $this->db->commit();
            return true;

        } catch (PDOException $e) {
            $this->db->rollBack();
            throw new Exception("Error al registrar usuario: " . $e->getMessage());
        }
    }

    // ✅ Obtener todos los usuarios
    public function getUsuarios() {
        $sql = "SELECT * FROM usuarios";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Obtener un usuario por ID
    public function getUsuarioPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Actualizar nombre, email y contraseña del usuario
    public function actualizarUsuario($id, $nombre, $email, $password = null) {
        if ($password) {
            $sql = "UPDATE usuarios SET nombre = :nombre, email = :email, password = :password WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'nombre' => $nombre,
                'email' => $email,
                'password' => $password,
                'id' => $id
            ]);
        } else {
            $sql = "UPDATE usuarios SET nombre = :nombre, email = :email WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'nombre' => $nombre,
                'email' => $email,
                'id' => $id
            ]);
        }

        return $stmt->rowCount();
    }

    // ✅ Obtener hijos de un usuario
    public function obtenerHijosPorUsuario($usuarioId) {
        $sql = "SELECT id, fecha_nacimiento FROM hijos WHERE usuario_id = :usuario_id ORDER BY fecha_nacimiento";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['usuario_id' => $usuarioId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Insertar un nuevo hijo
    public function insertarHijo($usuarioId, $fechaNacimiento) {
        $sql = "INSERT INTO hijos (usuario_id, fecha_nacimiento) VALUES (:usuario_id, :fecha_nacimiento)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'usuario_id' => $usuarioId,
            'fecha_nacimiento' => $fechaNacimiento
        ]);
    }

    // ✅ Eliminar un hijo por ID y por usuario
    public function eliminarHijo($usuarioId, $hijoId) {
        $sql = "DELETE FROM hijos WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id' => $hijoId,
            'usuario_id' => $usuarioId
        ]);
    }

    // ✅ Actualizar la fecha de nacimiento de un hijo
    public function actualizarFechaHijo($usuarioId, $hijoId, $nuevaFecha) {
        $sql = "UPDATE hijos SET fecha_nacimiento = :fecha WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'fecha' => $nuevaFecha,
            'id' => $hijoId,
            'usuario_id' => $usuarioId
        ]);
    }

    // ✅ Eliminar completamente un usuario (se recomienda usar ON DELETE CASCADE en la BD)
    public function eliminarUsuarioConHijos($usuarioId) {
        try {
            $sql = "DELETE FROM usuarios WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $usuarioId]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    // ✅ Eliminar un usuario por ID (sin contexto de hijos)
    public function eliminarUsuarioPorId($id) {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // ✅ Obtener vacunas según la comunidad y edad en meses
    public function obtenerVacunasPorEdadYComunidad($comunidadId, $edadMeses) {
        $sql = "SELECT v.nombre, v.descripcion, c.edad_meses, c.es_financiada
                FROM calendario_vacunas c
                JOIN vacunas v ON v.id = c.vacuna_id
                WHERE c.comunidad_id = :comunidad_id
                  AND c.edad_meses <= :edad_meses
                ORDER BY c.edad_meses ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'comunidad_id' => $comunidadId,
            'edad_meses' => $edadMeses
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Devolver el objeto PDO (útil para controladores directos)
    public function getConexion() {
        return $this->db;
    }
    // ✅ Registrar el envío de un recordatorio (para evitar duplicados)
public function registrarRecordatorioEnviado($hijoId, $vacunaNombre, $edadMeses, $diasAntes, $fecha = null) {
    $fecha = $fecha ?? date('Y-m-d');

    $sql = "INSERT INTO recordatorios_enviados 
            (hijo_id, vacuna_nombre, edad_meses, dias_antes, fecha_envio)
            VALUES (:hijo_id, :vacuna_nombre, :edad_meses, :dias_antes, :fecha_envio)";

    $stmt = $this->db->prepare($sql);
    return $stmt->execute([
        'hijo_id' => $hijoId,
        'vacuna_nombre' => $vacunaNombre,
        'edad_meses' => $edadMeses,
        'dias_antes' => $diasAntes,
        'fecha_envio' => $fecha
    ]);
}
// ✅ Comprueba si ya se envió un recordatorio para un hijo, vacuna, edad y días antes
public function yaSeEnvioRecordatorio($hijoId, $vacunaNombre, $edadMeses, $diasAntes) {
    $sql = "SELECT COUNT(*) FROM recordatorios_enviados
            WHERE hijo_id = :hijo_id 
              AND vacuna_nombre = :vacuna_nombre 
              AND edad_meses = :edad_meses 
              AND dias_antes = :dias_antes";

    $stmt = $this->db->prepare($sql);
    $stmt->execute([
        'hijo_id' => $hijoId,
        'vacuna_nombre' => $vacunaNombre,
        'edad_meses' => $edadMeses,
        'dias_antes' => $diasAntes
    ]);

    return $stmt->fetchColumn() > 0;
}
public function getUsuarioPorEmail($email) {
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}
