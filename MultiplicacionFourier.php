<?php

// Clase derivada: Multiplicación de enteros usando el teorema de Fourier.
class MultiplicacionFourier extends AlgoritmoGalactico {
    public function ejecutar() {
        // Lógica específica del algoritmo de multiplicación de enteros usando Fourier
        echo "Ejecutando multiplicación de enteros con el teorema de Fourier...\n";

        // Obtener los dos números enteros a multiplicar
        $num1 = intval(readline("Ingrese el primer número entero: "));
        $num2 = intval(readline("Ingrese el segundo número entero: "));

        // Realizar la multiplicación utilizando el teorema de Fourier
        $resultado = $this->multiplicarFourier($num1, $num2);

        // Mostrar el resultado
        echo "El resultado de la multiplicación es: $resultado\n";
    }

    private function multiplicarFourier($num1, $num2) {
        // Convertir los números a arreglos de dígitos
        $arr1 = str_split(strval($num1));
        $arr2 = str_split(strval($num2));

        // Obtener el tamaño del arreglo resultante
        $size = count($arr1) + count($arr2);

        // Realizar la multiplicación utilizando la transformada de Fourier inversa
        $result = $this->inverseFourierTransform($this->fastFourierTransform($arr1, $size), $this->fastFourierTransform($arr2, $size));

        // Convertir el arreglo resultante en un número entero
        $resultado = 0;
        for ($i = 0; $i < $size; $i++) {
            $resultado = $resultado * 10 + round($result[$i]);
        }

        return $resultado;
    }

    private function fastFourierTransform($arr, $size) {
        if ($size === 1) {
            return $arr;
        }

        // Dividir el arreglo en dos partes
        $even = [];
        $odd = [];
        for ($i = 0; $i < $size; $i++) {
            if ($i % 2 === 0) {
                $even[] = $arr[$i];
            } else {
                $odd[] = $arr[$i];
            }
        }

        // Aplicar la transformada de Fourier rápida a las partes divididas
        $evenTransformed = $this->fastFourierTransform($even, $size / 2);
        $oddTransformed = $this->fastFourierTransform($odd, $size / 2);

        // Calcular las raíces de la unidad necesarias para la transformada
        $root = exp(-2 * pi() * sqrt(-1) / $size);
        $w = 1;

        // Combinar los resultados de las partes transformadas
        $result = [];
        for ($k = 0; $k < $size / 2; $k++) {
            $u = $evenTransformed[$k];
            $v = $w * $oddTransformed[$k];
            $result[$k] = $u + $v;
            $result[$k + $size / 2] = $u - $v;
            $w *= $root;
        }

        return $result;
    }

    private function inverseFourierTransform($arr1, $arr2) {
        $size = count($arr1);

        if ($size === 1) {
            return [$arr1[0] * $arr2[0]];
        }

        // Aplicar la transformada de Fourier rápida inversa a los arreglos
        $arr1Transformed = $this->inverseFourierTransform($arr1, $size / 2);
        $arr2Transformed = $this->inverseFourierTransform($arr2, $size / 2);

        // Calcular las raíces de la unidad necesarias para la transformada inversa
        $root = exp(2 * pi() * sqrt(-1) / $size);
        $w = 1;

        // Combinar los resultados de las partes transformadas
        $result = [];
        for ($k = 0; $k < $size / 2; $k++) {
            $u = $arr1Transformed[$k];
            $v = $w * $arr2Transformed[$k];
            $result[$k] = $u + $v;
            $result[$k + $size / 2] = $u - $v;
            $w *= $root;
        }

        return $result;
    }
}

?>
