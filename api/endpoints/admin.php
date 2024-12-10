<?php


class Admin {
    public function verificarContrasenya($usuario) {
        try {
            $con = DataBase::connect();
            $stmt = $con->prepare("SELECT * FROM clientes WHERE usuario = ? AND administrador = 1");
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Devolver la primera fila como un array asociativo
                $usuarioData = $result->fetch_assoc()['contrasenya'];
            } else {
                $usuarioData = null; // Usuario no encontrado
            }

            $stmt->close();
            $con->close();

            return $usuarioData;
            
        } catch (\Throwable $th) {
            return json_encode("ERROR al iniciar sessio");
        }
    }
}