document.addEventListener('DOMContentLoaded', () => {
    const tablaBody = document.getElementById('tablaModulosBody');
    const alertContainer = document.getElementById('alertContainer');
    const formModulo = document.getElementById('formModulo');
    const modalModuloElement = document.getElementById('modalModulo');
    const modalInstance = new bootstrap.Modal(modalModuloElement);
    const modalTitulo = document.getElementById('modalModuloLabel');
    const inputId = document.getElementById('modulo_id');
    const btnNuevo = document.getElementById('btnNuevoModulo') || document.getElementById('btnHeaderNuevo');

    const CONTROLLER_URL = 'controllers/ModuloController.php';



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
            const response = await fetch(`${CONTROLLER_URL}?accion=listar`);
            const result = await response.json();

            if (result.success) {
                renderizarTabla(result.data);
            } else {
                mostrarAlerta(result.message, 'danger');
            }
        } catch (error) {
            mostrarAlerta('Error de conexión con el controlador MVC.', 'danger');
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
                        const response = await fetch(CONTROLLER_URL, {
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
                        mostrarAlerta('Error al procesar la eliminación en el controlador.', 'danger');
                    }
                }
            });
        });
    }

    formModulo.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(formModulo);

        try {
            const response = await fetch(CONTROLLER_URL, {
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
            mostrarAlerta('Error inesperado en la comunicación con el servidor.', 'danger');
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
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
});
