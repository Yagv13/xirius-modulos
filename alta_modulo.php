<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Módulo-Xirius</title>
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Registrar Nuevo Módulo</h4>
            </div>
            <div class="card-body">
                <form action="procesar_modulo.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Módulo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="modulos.php" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success">Guardar Módulo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>