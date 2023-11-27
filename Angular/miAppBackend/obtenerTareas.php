<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  http_response_code(200);
  exit;
}

try {
  require 'conexion.php';

  $sql = "SELECT * FROM tareas";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $tareas = array();
      while($row = $result->fetch_assoc()) {
          array_push($tareas, $row);
      }
      echo json_encode($tareas);
  } else {
      echo json_encode(array()); // Devuelve un array vacío si no se encuentran tareas
  }
} catch (Exception $e) {
  http_response_code(500);
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}
/*require 'conexion.php';: Esta línea incluye el archivo conexion.php, que probablemente contiene el código para establecer una conexión con tu base de datos.

$sql = "SELECT * FROM tareas";: Esta línea prepara una consulta SQL para seleccionar todas las tareas de la base de datos.

$result = $conn->query($sql);: Esta línea ejecuta la consulta SQL y asigna el resultado a la variable $result.

if ($result->num_rows > 0) {...} else {...}: Este bloque de código comprueba si la consulta SQL devolvió algún resultado. Si hay resultados, los recorre y los añade a un array, que luego se codifica como JSON y se envía como respuesta. Si no hay resultados, se envía un array vacío como respuesta.*/

?>
