<?php
require_once 'db.php';
if (!isset($_GET['id']) || empty($_GET['id'])) { header("Location: modulos.php"); exit(); }
$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM modulos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
if ($resultado->num_rows === 0) { die("Módulo no encontrado."); }
$modulo = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Módulo - Xirius</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <?php include_once 'header.php'; ?>

    <div class="container" style="max-width: 700px;">
        
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="modulos.php" class="text-decoration-none text-info">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Módulo</li>
            </ol>
        </nav>

        <div class="card shadow border-0 rounded-3">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-warning rounded-2 p-2 me-3 text-white d-inline-block" style="width: 10px; height: 40px;"></div>
                    <h4 class="card-title fw-bold text-dark mb-0">Modificar Módulo #<?php echo $modulo['id']; ?></h4>
                </div>
                
                <form action="procesar_modulo.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $modulo['id']; ?>">

                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-semibold text-secondary">Nombre del Módulo</label>
                        <input type="text" class="form-control form-control-lg fs-6" id="nombre" name="nombre" value="<?php echo htmlspecialchars($modulo['nombre']); ?>" required>
                    </div>
                    <div class="mb-4">
                        <label for="descripcion" class="form-label fw-semibold text-secondary">Descripción</label>
                        <textarea class="form-control fs-6" id="descripcion" name="descripcion" rows="4" required><?php echo htmlspecialchars($modulo['descripcion']); ?></textarea>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                        <a href="modulos.php" class="text-decoration-none text-muted fw-medium">← Cancelar cambios</a>
                        <button type="submit" class="btn btn-warning px-4 py-2 fw-semibold rounded-2">Actualizar Datos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>