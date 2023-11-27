<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  http_response_code(200);
  exit;
}

try {
  require 'conexion.php';

  $data = json_decode(file_get_contents("php://input"));
  $id = $data->id;

  $sql = "DELETE FROM tareas WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $id);

  if ($stmt->execute()) {
    echo json_encode(["message" => "Tarea eliminada con éxito"]);
  } else {
    echo json_encode(["message" => "Error al eliminar tarea"]);
  }
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['error' => 'Caught exception: '. $e->getMessage()]);
}
/*header("Content-Type: application/json");: Esta línea establece el tipo de contenido de la respuesta a application/json, lo que significa que la respuesta será un objeto JSON.

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {...}: Este bloque de código maneja las solicitudes HTTP OPTIONS, que son una parte del mecanismo CORS. Si la solicitud HTTP es una solicitud OPTIONS, el script envía una respuesta HTTP 200 y termina.

require 'conexion.php';: Esta línea incluye el archivo conexion.php, que probablemente contiene el código para establecer una conexión con tu base de datos.

$data = json_decode(file_get_contents("php://input"));: Esta línea lee los datos de la solicitud HTTP, los decodifica de JSON a un objeto PHP y los asigna a la variable $data.

$id = $data->id;: Esta línea extrae el valor de id del objeto $data y lo asigna a la variable $id.

$sql = "DELETE FROM tareas WHERE id = ?";: Esta línea prepara una consulta SQL para eliminar una tarea de la base de datos.

$stmt = $conn->prepare($sql);: Esta línea prepara la consulta SQL para su ejecución.

$stmt->bind_param('i', $id);: Esta línea vincula el parámetro $id a la consulta SQL preparada.

if ($stmt->execute()) {...} else {...}: Este bloque de código intenta ejecutar la consulta SQL. Si la ejecución es exitosa, envía una respuesta con un mensaje de éxito. Si la ejecución falla, envía una respuesta con un mensaje de error.*/
?>
