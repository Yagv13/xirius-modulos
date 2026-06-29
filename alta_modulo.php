<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Módulo - Xirius</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <?php include_once 'header.php'; ?>

    <div class="container" style="max-width: 700px;">
        
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="modulos.php" class="text-decoration-none text-info">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nuevo Módulo</li>
            </ol>
        </nav>

        <div class="card shadow border-0 rounded-3">
            <div class="card-body p-4">
                <h4 class="card-title fw-bold text-dark mb-4">Registrar Nuevo Módulo</h4>
                
                <form action="procesar_modulo.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-semibold text-secondary">Nombre del Módulo</label>
                        <input type="text" class="form-control form-control-lg fs-6" id="nombre" name="nombre" placeholder="Ej. Filtro de Candidatos AI" required>
                    </div>
                    <div class="mb-4">
                        <label for="descripcion" class="form-label fw-semibold text-secondary">Descripción General</label>
                        <textarea class="form-control fs-6" id="descripcion" name="descripcion" rows="4" placeholder="Escribe detalladamente las funciones del servicio..." required></textarea>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                        <a href="modulos.php" class="text-decoration-none text-muted fw-medium">← Volver al listado</a>
                        <button type="submit" class="btn btn-dark px-4 py-2 fw-medium rounded-2">Guardar Módulo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>