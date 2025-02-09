<?php

namespace App\Controllers;

use CodeIgniter\Controller;  // Asegúrate de que esta línea esté presente
// use Doctrine\Common\Annotations\AnnotationReader;
/**
* Class directorioExiste
* @package App\Controllers
* @Route("testcontroller/test/App-Libraries-Custom", methods={GET})
* @Description("Esta función se utiliza para verificar si el directorio existe, sino lo crea.")
*/
class TestController extends Controller
{
    public function test($clase = null)
    {
// $reader = new AnnotationReader();
		
        if ($clase === null) {
            echo "Por favor, proporciona una clase o librería en la URL.";
            return;
        }

        try {
            // Convertir el nombre de la clase recibido en formato de espacio de nombres
            $claseCompleta = str_replace('-', '\\', $clase);

            // Verificar si la clase existe
            if (!class_exists($claseCompleta)) {
                echo "La clase '{$claseCompleta}' no existe.";
                return;
            }

               // Usar ReflectionClass para inspeccionar la clase
           $reflection = new \ReflectionClass($claseCompleta);
		    // $reflection = new \ReflectionMethod('ClassName', 'methodName');
            $metodos = $reflection->getMethods();

            // Crear el título de la tabla
            echo "<h3>Métodos de la Clase: {$claseCompleta}</h3>";

            // Crear la tabla para mostrar los métodos y sus visibilidades
            echo "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse;'>";
            echo "<tr><th>Métodos</th><th>Visibilidad</th><th>Parametros</th><th>Anotaciones</th></tr>";

            foreach ($metodos as $metodo) {
                // Obtener la visibilidad del método
                $visibilidad = implode(' ', \Reflection::getModifierNames($metodo->getModifiers()));
				$parametros  =$metodo->getNumberOfParameters();

                // Crear una fila por cada método
                echo "<tr>";
                echo "<td>" . $metodo->getName() . "</td>";
                echo "<td>" . $visibilidad . "</td>";
                echo "<td>" . $parametros . "</td>";				
			//	echo "<td>" . $anotaciones . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } catch (\ReflectionException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
