<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xirius - Módulos (Fetch API)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <?php include_once 'header.php'; ?>

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
                                <td colspan="5" class="text-center py-4 text-muted">Cargando módulos...</td>
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tablaBody = document.getElementById('tablaModulosBody');
            const alertContainer = document.getElementById('alertContainer');
            const formModulo = document.getElementById('formModulo');
            const modalModuloElement = document.getElementById('modalModulo');
            const modalInstance = new bootstrap.Modal(modalModuloElement);
            const modalTitulo = document.getElementById('modalModuloLabel');
            const inputId = document.getElementById('modulo_id');
            const btnNuevo = document.getElementById('btnNuevoModulo') || document.getElementById('btnHeaderNuevo');

            cargarModulos();

            function mostrarAlerta(mensaje, tipo = 'success') {
                alertContainer.innerHTML = `
                    <div class="alert alert-${tipo} alert-dismissible fade show shadow-sm" role="alert">
                        ${mensaje}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
            }

            async function cargarModulos() {
                try {
                    const response = await fetch('crud_modulo.php?accion=listar');
                    const result = await response.json();

                    if (result.success) {
                        renderizarTabla(result.data);
                    } else {
                        mostrarAlerta(result.message, 'danger');
                    }
                } catch (error) {
                    mostrarAlerta('Error de conexión al obtener los módulos.', 'danger');
                    console.error(error);
                }
            }

            function renderizarTabla(modulos) {
                if (modulos.length === 0) {
                    tablaBody.innerHTML = `
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">No hay módulos registrados en la plataforma.</td>
                        </tr>
                    `;
                    return;
                }

                tablaBody.innerHTML = modulos.map(m => `
                    <tr>
                        <td class="ps-4 text-muted fw-bold">#${m.id}</td>
                        <td><span class="text-dark fw-semibold fs-6">${escapeHtml(m.nombre)}</span></td>
                        <td class="text-muted text-truncate" style="max-width: 300px;">${escapeHtml(m.descripcion)}</td>
                        <td class="text-muted fs-7">${m.fecha_creacion}</td>
                        <td class="text-end pe-4">
                            <button 
                                class="btn btn-sm btn-light border text-warning fw-medium me-1 btn-editar"
                                data-id="${m.id}"
                                data-nombre="${escapeHtml(m.nombre)}"
                                data-descripcion="${escapeHtml(m.descripcion)}"
                            >
                                Editar
                            </button>
                            <button 
                                class="btn btn-sm btn-danger opacity-75 btn-eliminar"
                                data-id="${m.id}"
                            >
                                Eliminar
                            </button>
                        </td>
                    </tr>
                `).join('');

                asignarEventosTabla();
            }

            function asignarEventosTabla() {
                document.querySelectorAll('.btn-editar').forEach(btn => {
                    btn.addEventListener('click', () => {
                        modalTitulo.textContent = 'Editar Módulo';
                        inputId.value = btn.dataset.id;
                        document.getElementById('nombre').value = btn.dataset.nombre;
                        document.getElementById('descripcion').value = btn.dataset.descripcion;
                        modalInstance.show();
                    });
                });

                document.querySelectorAll('.btn-eliminar').forEach(btn => {
                    btn.addEventListener('click', async () => {
                        if (confirm('¿Seguro que deseas eliminar este módulo?')) {
                            const id = btn.dataset.id;
                            const formData = new FormData();
                            formData.append('accion', 'eliminar');
                            formData.append('id', id);

                            try {
                                const response = await fetch('crud_modulo.php', {
                                    method: 'POST',
                                    body: formData
                                });
                                const result = await response.json();

                                if (result.success) {
                                    mostrarAlerta(result.message, 'warning');
                                    cargarModulos(); 
                                } else {
                                    mostrarAlerta(result.message, 'danger');
                                }
                            } catch (error) {
                                mostrarAlerta('Error al procesar la eliminación.', 'danger');
                            }
                        }
                    });
                });
            }

            formModulo.addEventListener('submit', async (e) => {
                e.preventDefault(); 

                const formData = new FormData(formModulo);

                try {
                    const response = await fetch('crud_modulo.php', {
                        method: 'POST',
                        body: formData
                    });
                    const result = await response.json();

                    modalInstance.hide();

                    if (result.success) {
                        formModulo.reset(); 
                        mostrarAlerta(result.message, 'success');
                        cargarModulos(); 
                    } else {
                        mostrarAlerta(result.message, 'danger');
                    }
                } catch (error) {
                    modalInstance.hide();
                    mostrarAlerta('Ocurrió un error inesperado en la comunicación con el servidor.', 'danger');
                }
            });


            if (btnNuevo) {
                btnNuevo.addEventListener('click', () => {
                    modalTitulo.textContent = 'Registrar Nuevo Módulo';
                    inputId.value = '';
                    formModulo.reset();
                });
            }

            function escapeHtml(text) {
                if (!text) return '';
                return text
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }
        });
        
    </script>
</body>
</html>