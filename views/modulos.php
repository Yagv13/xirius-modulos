<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xirius - Administración Módulos (MVC)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <?php include_once __DIR__ . '/header.php'; ?>

    <div class="container">
        <div id="alertContainer"></div>

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
                        <tbody id="tablaModulosBody">
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Cargando módulos desde la arquitectura MVC...</td>
                            </tr>
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
                <form id="formModulo">
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
    
    <script src="assets/js/modulos.js"></script>
</body>
</html>