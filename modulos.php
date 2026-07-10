<?php 
require_once 'crud_modulo.php';
$resultado=obtenerModulos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xirius - Módulos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <?php include_once 'header.php'; ?>

    <div class="container">
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                ¡Módulo registrado exitosamente!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['updated'])): ?>
            <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">
                ¡Módulo actualizado correctamente!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['deleted'])): ?>
            <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
                El módulo fue eliminado del sistema.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'duplicado'): ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <strong>Error:</strong> Ya existe un módulo registrado con ese mismo nombre.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow border-0 rounded-3">
            <div class="card-header bg-white py-3 border-bottom border-light d-flex justify-content-between align-items-center">
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
                            <?php if ($resultado && $resultado->num_rows > 0): ?>
                                <?php while($row = $resultado->fetch_assoc()): ?>
                                    <tr>
                                        <td class="ps-4 text-muted fw-bold">#<?php echo $row['id']; ?></td>
                                        <td><span class="text-dark fw-semibold fs-6"><?php echo htmlspecialchars($row['nombre']); ?></span></td>
                                        <td class="text-muted text-truncate" style="max-width: 300px;"><?php echo htmlspecialchars($row['descripcion']); ?></td>
                                        <td class="text-muted fs-7"><?php echo date('d M, Y H:i', strtotime($row['fecha_creacion'])); ?></td>
                                        <td class="text-end pe-4">
                                            <button 
                                                class="btn btn-sm btn-light border text-warning fw-medium me-1 btn-editar"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalModulo"
                                                data-id="<?php echo $row['id']; ?>"
                                                data-nombre="<?php echo htmlspecialchars($row['nombre']); ?>"
                                                data-descripcion="<?php echo htmlspecialchars($row['descripcion']); ?>"
                                            >
                                                Editar
                                            </button>

                                            <a href="crud_modulo.php?accion=eliminar&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger opacity-75" onclick="return confirm('¿Seguro que deseas eliminar este módulo?')">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">No hay módulos registrados en la plataforma.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalModulo" tabindex="-1" aria-labelledby="modalModuloLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header text-white" style="background-color: #2b3035;">
                    <h5 class="modal-title fw-bold" id="modalModuloLabel">Registrar Nuevo Módulo</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="crud_modulo.php" method="POST" id="formModulo">
                    <div class="modal-body p-4">
                        
                        <input type="hidden" name="accion" value="guardar">
                        <input type="hidden" name="id" id="modulo_id" value="">

                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-semibold text-secondary">Nombre del Módulo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej. Filtro de Candidatos AI" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-semibold text-secondary">Descripción General</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Escribe detalladamente las funciones..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn text-white fw-semibold" id="btnGuardarModal" style="background-color: #fd7e14;">Guardar Módulo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modalTitulo = document.getElementById('modalModuloLabel');
            const formModulo = document.getElementById('formModulo');
            const inputId = document.getElementById('modulo_id');
            const inputNombre = document.getElementById('nombre');
            const inputDescripcion = document.getElementById('descripcion');
            
            const btnNuevo = document.getElementById('btnNuevoModulo') || document.getElementById('btnHeaderNuevo');

            if (btnNuevo) {
                btnNuevo.addEventListener('click', () => {
                    modalTitulo.textContent = 'Registrar Nuevo Módulo';
                    inputId.value = ''; 
                    formModulo.reset();
                });
            }

            const botonesEditar = document.querySelectorAll('.btn-editar');
            
            botonesEditar.forEach(boton => {
                boton.addEventListener('click', () => {
                    modalTitulo.textContent = 'Editar Módulo';

                    const id = boton.dataset.id;
                    const nombre = boton.dataset.nombre;
                    const descripcion = boton.dataset.descripcion;

                    inputId.value = id;
                    inputNombre.value = nombre;
                    inputDescripcion.value = descripcion;
                });
            });
        });
    </script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.pathname);
        }
    </script>
</body>
</html>