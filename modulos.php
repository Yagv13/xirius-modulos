<?php require_once 'get_modulos.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xirius - Módulos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">

    <?php include_once 'header.php'; ?>

    <div class="container">
        <div class="card shadow border-0 rounded-3">
            <div class="card-header bg-white py-3 border-bottom border-light">
                <h5 class="card-title mb-0 fw-bold text-secondary">Lista de Servicios Habilitados</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase fs-7 text-secondary">
                            <tr>
                                <th class="ps-4" style="width: 80px;">ID</th>
                                <th>Módulo</th>
                                <th>Descripción</th>
                                <th style="width: 180px;">Fecha Creación</th>
                                <th class="text-end pe-4" style="width: 200px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($resultado->num_rows > 0): ?>
                                <?php while($row = $resultado->fetch_assoc()): ?>
                                    <tr>
                                        <td class="ps-4 text-muted fw-bold">#<?php echo $row['id']; ?></td>
                                        <td>
                                            <span class="text-dark fw-semibold fs-6"><?php echo htmlspecialchars($row['nombre']); ?></span>
                                        </td>
                                        <td class="text-muted text-truncate" style="max-width: 300px;">
                                            <?php echo htmlspecialchars($row['descripcion']); ?>
                                        </td>
                                        <td class="text-muted fs-7"><?php echo date('d M, Y H:i', strtotime($row['fecha_creacion'])); ?></td>
                                        <td class="text-end pe-4">
                                            <a href="edit_modulo.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-light border text-warning fw-medium me-1">Editar</a>
                                            <a href="delete_modulo.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger opacity-75" onclick="return confirm('¿Seguro que deseas eliminar este módulo?')">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <p class="mb-0 fs-5">No hay módulos registrados en la plataforma.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>