<?php
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  http_response_code(200);
  exit;
}

try {
  // el resto de tu código PHP aquí
require 'conexion.php';

$data = json_decode(file_get_contents("php://input"));
$id = $data->id;
$nuevoNombre = $data->nuevoNombre;

$sql = "UPDATE tareas SET nombre = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('si', $nuevoNombre, $id);

if ($stmt->execute()) {
    echo "Nombre de tarea actualizado con éxito";
} else {
    echo "Error al actualizar nombre de tarea";
}
} catch (Exception $e) {
  http_response_code(500);
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>
