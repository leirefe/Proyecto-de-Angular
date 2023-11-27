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
  $nombre = $data->nombre;
  $estado = $data->estado;

  $sql = "INSERT INTO tareas (nombre, estado) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('si', $nombre, $estado);

  if ($stmt->execute()) {
    echo json_encode(["message" => "Tarea agregada con éxito", "id" => $conn->insert_id]);
  } else {
    echo json_encode(["message" => "Error al agregar tarea"]);
  }
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['error' => 'Caught exception: '. $e->getMessage()]);
}
/*header("Content-Type: application/json");: Esta línea establece el tipo de contenido de la respuesta a application/json, lo que significa que la respuesta será un objeto JSON.

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {...}: Este bloque de código maneja las solicitudes HTTP OPTIONS, que son una parte del mecanismo CORS. Si la solicitud HTTP es una solicitud OPTIONS, el script envía una respuesta HTTP 200 y termina.

require 'conexion.php';: Esta línea incluye el archivo conexion.php, que probablemente contiene el código para establecer una conexión con tu base de datos.

$data = json_decode(file_get_contents("php://input"));: Esta línea lee los datos de la solicitud HTTP, los decodifica de JSON a un objeto PHP y los asigna a la variable $data.

$nombre = $data->nombre; y $estado = $data->estado;: Estas líneas extraen los valores de nombre y estado del objeto $data y los asignan a las variables $nombre y $estado, respectivamente.

$sql = "INSERT INTO tareas (nombre, estado) VALUES (?, ?)";: Esta línea prepara una consulta SQL para insertar una nueva tarea en la base de datos.

$stmt = $conn->prepare($sql);: Esta línea prepara la consulta SQL para su ejecución.

$stmt->bind_param('si', $nombre, $estado);: Esta línea vincula los parámetros $nombre y $estado a la consulta SQL preparada.

if ($stmt->execute()) {...} else {...}: Este bloque de código intenta ejecutar la consulta SQL. Si la ejecución es exitosa, envía una respuesta con un mensaje de éxito y el id de la tarea insertada. Si la ejecución falla, envía una respuesta con un mensaje de error.

catch (Exception $e) {...}: Este bloque de código captura cualquier excepción que pueda ocurrir durante la ejecución del bloque try. Si ocurre una excepción, envía una respuesta HTTP 500 y un objeto JSON con un mensaje de error.*/
?>
