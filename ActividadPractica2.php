<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Actividad Practica 2</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Georgia', 'Times New Roman', serif;
        background: linear-gradient(135deg, #ffffff 0%, #fffdf5 30%, #fff8e0 60%, #fff2c2 100%);
        padding: 40px 20px;
    }

    .card {
        background-color: #ffffff;
        border: 1px solid #f0e0a0;
        border-radius: 12px;
        max-width: 600px;
        width: 100%;
        padding: 45px 40px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.15);
    }

    h1 {
        font-size: 32px;
        color: #4a3b00;
        letter-spacing: 1px;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .subrayado {
        width: 90px;
        height: 3px;
        margin: 0 auto 30px auto;
        background: linear-gradient(90deg, #f5deb3, #d4af37, #f5deb3);
        border-radius: 2px;
    }

    .foto {
        width: 220px;
        height: 220px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #e8d48b;
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        margin-bottom: 30px;
    }

    .integrantes {
        background: linear-gradient(135deg, #fffdf2, #fff6d9);
        border: 1px solid #f0e0a0;
        border-radius: 10px;
        padding: 20px 25px;
        text-align: left;
    }

    .integrantes h2 {
        font-size: 16px;
        color: #8a7100;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
        border-bottom: 1px solid #eaddaa;
        padding-bottom: 8px;
    }

    .integrantes p {
        font-size: 18px;
        color: #333333;
        margin: 6px 0;
        padding-left: 8px;
    }

    footer {
        margin-top: 30px;
        font-size: 13px;
        color: #a89b6a;
        letter-spacing: 0.5px;
    }
</style>
</head>
<body>

   <?php
// 1. Conexión a la base de datos (Coloca esto hasta arriba del archivo, antes del <!DOCTYPE html>)
$serverName = "tcp:sql-tilin.database.windows.net,1433";
$database = "BD-TILIN";
$username = "adminsql";
$password = "TuPasswordAqui"; // Reemplaza con tu contraseña

try {
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Consulta para traer los nombres de los estudiantes
    $query = "SELECT Nombre FROM Estudiantes";
    $stmt = $conn->query($query);
    $estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $errorConexion = "Error de conexión: " . $e->getMessage();
}
?>

<!-- ... tu código <head> y <style> ... -->
</head>
<body>

    <div class="card">
        <h1>Actividad Practica 2</h1>
        <div class="subrayado"></div>

        <img src="foto.jpg" alt="Imagen de la actividad" class="foto">

        <div class="integrantes">
            <h2>Integrantes</h2>
            
            <?php
            // 2. Aquí imprimimos los datos dinámicamente
            if (isset($errorConexion)) {
                echo "<p style='color:red;'>$errorConexion</p>";
            } elseif (!empty($estudiantes)) {
                // El ciclo foreach leerá cada estudiante de la BD y creará un <p> por cada uno
                foreach ($estudiantes as $est) {
                    echo "<p>" . htmlspecialchars($est['Nombre']) . "</p>";
                }
            } else {
                echo "<p>No hay integrantes registrados.</p>";
            }
            ?>
            
        </div>

        <footer>Universidad Don Bosco</footer>
    </div>

</body>
</html>
