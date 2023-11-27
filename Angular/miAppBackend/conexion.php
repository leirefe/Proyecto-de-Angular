<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  http_response_code(200);
  exit;
}

try {
  // el resto de tu código PHP aquí
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Tareas_DB";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
} catch (Exception $e) {
  http_response_code(500);
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}

/*header("Access-Control-Allow-Origin: *"); y header("Access-Control-Allow-Headers: Content-Type");: Estas líneas configuran los encabezados de control de acceso HTTP para permitir solicitudes desde cualquier origen y permitir el encabezado Content-Type. Esto es útil para permitir las solicitudes CORS (Cross-Origin Resource Sharing) a tu script PHP.

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {...}: Este bloque de código maneja las solicitudes HTTP OPTIONS, que son una parte del mecanismo CORS. Si la solicitud HTTP es una solicitud OPTIONS, el script envía una respuesta HTTP 200 y termina.

try {...} catch (Exception $e) {...}: Este bloque de código intenta ejecutar el código dentro del bloque try, y si ocurre una excepción, la captura y maneja en el bloque catch. En este caso, si ocurre una excepción, se envía una respuesta HTTP 500 y se imprime el mensaje de la excepción.

$conn = new mysqli($servername, $username, $password, $dbname);: Esta línea intenta establecer una nueva conexión a una base de datos MySQL utilizando las credenciales proporcionadas.

if ($conn->connect_error) {...}: Este bloque de código comprueba si hubo un error al conectar a la base de datos. Si hubo un error, termina el script e imprime un mensaje de error.*/
?>

