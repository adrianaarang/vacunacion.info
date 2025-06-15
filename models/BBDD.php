<?php


/**

 * Clase BBDD: gestiona la conexión y operaciones con la base de datos de vacunacion.info

 * @author Adriana

 */

class BBDD {


    // === Propiedades de conexión ===

    private $cadena_conexion = 'mysql:dbname=vacunacion.info;host=localhost'; // Cadena DSN para PDO

    private $usuario = 'root';              // Usuario de la base de datos

    private $password = 'KRR6TvUxXWX+';                 // Contraseña (en blanco para desarrollo local)

    public $db;                             // Objeto PDO con la conexión activa


    // === Constructor: establece conexión al crear el objeto ===

    public function __construct() {

        try {

            $this->db = new PDO($this->cadena_conexion, $this->usuario, $this->password);

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Modo de error: excepción

        } catch (Exception $ex) {

            die("Error al conectar con la base de datos: " . $ex->getMessage());

        }

    }


    // === Obtener todas las comunidades ===

    public function obtenerComunidades() {

        $sql = "SELECT * FROM comunidades";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }


    // === Eliminar imagen del calendario de una comunidad ===

    public function eliminarImagenComunidad($id) {

        $sql = "UPDATE comunidades SET foto_calendario = NULL WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute(['id' => $id]);

    }


    // === Actualizar la imagen del calendario ===

    public function actualizarImagenComunidad($id, $ruta) {

        $sql = "UPDATE comunidades SET foto_calendario = :ruta WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute(['ruta' => $ruta, 'id' => $id]);

    }


    // === Insertar un nuevo usuario con sus hijos ===

    public function insertarUsuarioConHijosPlano($nombre, $email, $passwordPlano, $fechasNacimiento, $comunidadId) {

        try {

            $this->db->beginTransaction(); // Inicia transacción


            // Insertar en tabla usuarios

            $sqlUsuario = "INSERT INTO usuarios (nombre, email, password, comunidad_id) 

                           VALUES (:nombre, :email, :password, :comunidad_id)";

            $stmt = $this->db->prepare($sqlUsuario);

            $stmt->execute([

                'nombre' => $nombre,

                'email' => $email,

                'password' => $passwordPlano,

                'comunidad_id' => $comunidadId

            ]);

            $usuarioId = $this->db->lastInsertId(); // ID del nuevo usuario


            // Insertar hijos si hay fechas

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


            $this->db->commit(); // Finaliza transacción

            return true;


        } catch (PDOException $e) {

            $this->db->rollBack(); // Revierte en caso de error

            throw new Exception("Error al registrar usuario: " . $e->getMessage());

        }

    }


    // === Obtener todos los usuarios ===

    public function getUsuarios() {

        $sql = "SELECT * FROM usuarios";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }


    // === Obtener un usuario por su ID ===

    public function getUsuarioPorId($id) {

        $sql = "SELECT * FROM usuarios WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }


    // === Actualizar los datos de un usuario ===

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


        return $stmt->rowCount(); // Retorna cuántas filas fueron modificadas

    }


    // === Obtener hijos de un usuario ===

    public function obtenerHijosPorUsuario($usuarioId) {

        $sql = "SELECT id, fecha_nacimiento FROM hijos WHERE usuario_id = :usuario_id ORDER BY fecha_nacimiento";

        $stmt = $this->db->prepare($sql);

        $stmt->execute(['usuario_id' => $usuarioId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    // === Insertar nuevo hijo ===

    public function insertarHijo($usuarioId, $fechaNacimiento) {

        $sql = "INSERT INTO hijos (usuario_id, fecha_nacimiento) VALUES (:usuario_id, :fecha_nacimiento)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([

            'usuario_id' => $usuarioId,

            'fecha_nacimiento' => $fechaNacimiento

        ]);

    }


    // === Eliminar hijo específico de un usuario ===

    public function eliminarHijo($usuarioId, $hijoId) {

        $sql = "DELETE FROM hijos WHERE id = :id AND usuario_id = :usuario_id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([

            'id' => $hijoId,

            'usuario_id' => $usuarioId

        ]);

    }


    // === Actualizar la fecha de nacimiento de un hijo ===

    public function actualizarFechaHijo($usuarioId, $hijoId, $nuevaFecha) {

        $sql = "UPDATE hijos SET fecha_nacimiento = :fecha WHERE id = :id AND usuario_id = :usuario_id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([

            'fecha' => $nuevaFecha,

            'id' => $hijoId,

            'usuario_id' => $usuarioId

        ]);

    }


    // === Eliminar un usuario y sus hijos (si ON DELETE CASCADE está en BD) ===

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


    // === Eliminar un usuario por su ID (sin preocuparse por hijos) ===

    public function eliminarUsuarioPorId($id) {

        $sql = "DELETE FROM usuarios WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute(['id' => $id]);

    }


    // === Obtener vacunas según comunidad y edad (en meses) ===

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


    // === Obtener objeto PDO (por si se necesita acceso directo desde otro controlador) ===

    public function getConexion() {

        return $this->db;

    }


    // === Registrar que se ha enviado un recordatorio (para evitar duplicados) ===

    public function registrarRecordatorioEnviado($hijoId, $vacunaNombre, $edadMeses, $diasAntes, $fecha = null) {

        $fecha = $fecha ?? date('Y-m-d'); // Fecha actual si no se pasa


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


    // === Verifica si ya se envió un recordatorio concreto ===

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


        return $stmt->fetchColumn() > 0; // Devuelve true si existe un registro

    }


    // === Buscar un usuario por su email ===

    public function getUsuarioPorEmail($email) {

        $sql = "SELECT * FROM usuarios WHERE email = :email";

        $stmt = $this->db->prepare($sql);

        $stmt->execute(['email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

// --- Métodos de Restablecimiento de Contraseña ---



    /**

     * Guarda el token temporal para el restablecimiento de contraseña.

     * Elimina cualquier token anterior para el mismo usuario para asegurar que solo haya uno activo.

     */

    public function guardarResetToken($userId, $token, $expiresAt) {

        try {

            // Eliminar tokens antiguos para este usuario

            $deleteStmt = $this->db->prepare("DELETE FROM password_resets WHERE user_id = :user_id");

            $deleteStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

            $deleteStmt->execute();


            // Insertar el nuevo token

            $stmt = $this->db->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (:user_id, :token, :expires_at)");

            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

            $stmt->bindParam(':token', $token);

            $stmt->bindParam(':expires_at', $expiresAt);

            return $stmt->execute();

        } catch (PDOException $e) {

            error_log("Error al guardar token de restablecimiento: " . $e->getMessage());

            return false;

        }

    }


    /**

     * Obtiene los detalles de un token de restablecimiento si existe y no ha expirado.

     * Incluye información del usuario asociado al token.

     */

    public function obtenerResetToken($token) {

        try {

            $stmt = $this->db->prepare("

                SELECT pr.id, pr.user_id, pr.expires_at, u.email, u.nombre, u.password AS current_password_hash

                FROM password_resets pr

                JOIN usuarios u ON pr.user_id = u.id

                WHERE pr.token = :token AND pr.expires_at > NOW()

            ");

            $stmt->bindParam(':token', $token);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            error_log("Error al obtener token de restablecimiento: " . $e->getMessage());

            return false;

        }

    }


    /**

     * Elimina un token de restablecimiento de la base de datos después de ser usado o invalidado.

     */

    public function eliminarResetToken($token) {

        try {

            $stmt = $this->db->prepare("DELETE FROM password_resets WHERE token = :token");

            $stmt->bindParam(':token', $token);

            return $stmt->execute();

        } catch (PDOException $e) {

            error_log("Error al eliminar token de restablecimiento: " . $e->getMessage());

            return false;

        }

    }


    /**

     * Actualiza la contraseña de un usuario en la tabla 'usuarios'.

     * Asume que la columna de la contraseña se llama 'password'.

     */

    public function actualizarPassword($userId, $newPasswordHash) {

        try {

            // Se usa 'password' como nombre de columna según tu estructura.

            $stmt = $this->db->prepare("UPDATE usuarios SET password = :password WHERE id = :id");

            $stmt->bindParam(':password', $newPasswordHash);

            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $e) {

            error_log("Error al actualizar contraseña: " . $e->getMessage());

            return false;

        }

    }

}
    
