<?php

// Clase derivada: Canal de comunicación de Claude Shannon
class CanalComunicacionShannon extends AlgoritmoGalactico {
    public function ejecutar() {
        // Lógica específica del canal de comunicación de Claude Shannon
        echo "Ejecutando canal de comunicación de Claude Shannon...\n";

        // Obtener el mensaje a enviar
        $mensaje = readline("Ingrese el mensaje a enviar: ");

        // Codificar el mensaje utilizando el algoritmo de codificación de Shannon
        $mensajeCodificado = $this->codificarMensaje($mensaje);

        // Simular la transmisión del mensaje a través del canal de comunicación
        $mensajeTransmitido = $this->transmitirMensaje($mensajeCodificado);

        // Decodificar el mensaje recibido utilizando el algoritmo de decodificación de Shannon
        $mensajeDecodificado = $this->decodificarMensaje($mensajeTransmitido);

        // Mostrar el mensaje original y el mensaje decodificado
        echo "Mensaje original: $mensaje\n";
        echo "Mensaje decodificado: $mensajeDecodificado\n";
    }

    private function codificarMensaje($mensaje) {
        // Implementar el algoritmo de codificación de Shannon
        // Por ejemplo, se podría aplicar un cifrado simple
        $mensajeCodificado = str_rot13($mensaje);

        return $mensajeCodificado;
    }

    private function transmitirMensaje($mensaje) {
        // Simular la transmisión del mensaje a través del canal de comunicación
        // Por ejemplo, se podría agregar ruido aleatorio al mensaje
        $mensajeTransmitido = $mensaje;

        // Agregar ruido aleatorio al mensaje
        $ruido = $this->generarRuidoAleatorio(strlen($mensaje));
        $mensajeTransmitido = $this->mezclarMensajes($mensajeTransmitido, $ruido);

        return $mensajeTransmitido;
    }

    private function decodificarMensaje($mensaje) {
        // Implementar el algoritmo de decodificación de Shannon
        // Por ejemplo, en este caso se deshace el cifrado realizado en la codificación
        $mensajeDecodificado = str_rot13($mensaje);

        return $mensajeDecodificado;
    }

    private function generarRuidoAleatorio($longitud) {
        // Generar ruido aleatorio del mismo tamaño que el mensaje
        $ruido = "";
        for ($i = 0; $i < $longitud; $i++) {
            $ruido .= chr(rand(97, 122)); // Se generan caracteres aleatorios en minúscula (ASCII 97-122)
        }

        return $ruido;
    }

    private function mezclarMensajes($mensaje1, $mensaje2) {
        // Mezclar dos mensajes combinando los caracteres de forma alternada
        $mezcla = "";
        $longitud = strlen($mensaje1);
        for ($i = 0; $i < $longitud; $i++) {
            $mezcla .= $mensaje1[$i] . $mensaje2[$i];
        }

        return $mezcla;
    }
}

?>
