# Documento de Requerimientos

# Fase 3

## Proyecto

Xirius - Administración de Módulos

## Objetivo General

Mejorar la experiencia de usuario eliminando las pantallas independientes para registrar y editar módulos.

A partir de esta fase todas las operaciones se realizarán desde una única pantalla utilizando ventanas modales (Bootstrap Modal).

El objetivo principal es introducir conceptos básicos de JavaScript para manipular la interfaz de usuario sin modificar aún el funcionamiento del Backend.

Las operaciones seguirán siendo procesadas mediante PHP y continuarán recargando la página al finalizar cada acción.

---

# Objetivos de Aprendizaje

Al finalizar esta fase el desarrollador deberá comprender:

* Manipulación del DOM.
* Bootstrap Modal.
* Eventos en JavaScript.
* Uso de atributos data-*.
* Comunicación entre HTML y JavaScript.
* Llenado dinámico de formularios.
* Reutilización de formularios.
* Mejoras de experiencia de usuario (UX).

---

# Tecnologías

* PHP
* MySQL
* HTML5
* CSS3
* Bootstrap
* JavaScript
* Git

---

# Cambios Esperados

La funcionalidad del sistema continuará siendo exactamente la misma.

Las operaciones seguirán utilizando:

crud_modulo.php

La diferencia será únicamente la forma en que el usuario interactúa con la aplicación.

---

# Nueva Estructura del Proyecto

La estructura deberá quedar de la siguiente manera:

db.php

modulos.php

crud_modulo.php

---

# Archivos Eliminados

Los siguientes archivos dejarán de utilizarse:

alta_modulo.php

edit_modulo.php

Toda la interacción deberá realizarse desde:

modulos.php

---

# Interfaz Esperada

La pantalla principal deberá contener:

* Tabla de módulos.
* Botón "Nuevo Módulo".
* Botón "Editar".
* Botón "Eliminar".

No deberán abrirse nuevas páginas para registrar o editar información.

---

# Modal de Registro

Al presionar el botón:

Nuevo Módulo

Deberá abrirse un Bootstrap Modal con el formulario de registro.

Campos:

* Nombre
* Descripción

El formulario continuará enviando la información mediante:

action="crud_modulo.php"

No deberá utilizarse AJAX en esta fase.

---

# Modal de Edición

Al presionar el botón:

Editar

Deberá abrirse un Bootstrap Modal.

Los campos deberán mostrarse precargados con la información del módulo seleccionado.

El formulario continuará enviando la información mediante:

action="crud_modulo.php"

No deberá utilizarse AJAX en esta fase.

---

# Uso de JavaScript

JavaScript será responsable únicamente de controlar la interfaz.

Entre sus responsabilidades estarán:

* Abrir modales.
* Llenar formularios.
* Actualizar títulos del modal.
* Asignar valores a los campos del formulario.

No deberá realizar consultas a la base de datos.

---

# Uso de atributos data-*

Los botones de edición deberán transportar la información necesaria mediante atributos HTML.

Ejemplo:

data-id

data-nombre

data-descripcion

JavaScript utilizará estos atributos para llenar automáticamente el formulario de edición.

---

# Campo oculto ID

El formulario de edición deberá contener un campo oculto.

Ejemplo:

<input type="hidden" name="id">

Este campo permitirá identificar qué módulo será actualizado.

---

# Campo oculto Acción

Todos los formularios deberán indicar la acción que deberá ejecutar el controlador.

Ejemplo:

<input type="hidden" name="accion" value="guardar">

El controlador continuará utilizando la estructura switch implementada en la Fase 2.

---

# Flujo Esperado

Registro

Usuario

↓

Botón Nuevo

↓

Modal

↓

Formulario

↓

crud_modulo.php

↓

INSERT

↓

Redirección

↓

modulos.php

---

Edición

Usuario

↓

Botón Editar

↓

JavaScript llena el formulario

↓

Modal

↓

crud_modulo.php

↓

UPDATE

↓

Redirección

↓

modulos.php

---

Eliminación

Usuario

↓

Botón Eliminar

↓

crud_modulo.php

↓

DELETE

↓

Redirección

↓

modulos.php

---

# Conceptos de JavaScript Esperados

Durante esta fase deberán utilizarse al menos los siguientes conceptos:

* addEventListener()
* document.getElementById()
* querySelector()
* value
* dataset
* Bootstrap Modal

---

# Backend

No deberán realizarse cambios importantes en:

crud_modulo.php

Únicamente podrán hacerse pequeñas modificaciones para adaptarlo al nuevo flujo de trabajo.

---

# Control de Versiones

Todo el desarrollo deberá realizarse en una nueva rama.

Ejemplo:

main

↓

fase-3

---

# Flujo de Trabajo con Git

Crear nueva rama:

git checkout -b fase-3

Verificar cambios:

git status

Agregar archivos:

git add .

Crear commit:

git commit -m "Implementación de modales para administración de módulos"

Actualizar repositorio local:

git pull --rebase

Enviar cambios:

git push -u origin fase-3

---

# Criterios de Aceptación

La Fase 3 se considerará concluida cuando:

* Exista una única pantalla para administrar módulos.
* Las pantallas alta_modulo.php y edit_modulo.php hayan sido eliminadas.
* El registro de módulos se realice mediante un modal.
* La edición de módulos se realice mediante un modal.
* Los formularios sean llenados dinámicamente utilizando JavaScript.
* Las operaciones continúen siendo procesadas por crud_modulo.php.
* La aplicación continúe funcionando correctamente.
* El desarrollo se encuentre respaldado mediante Git.

---

# Resultado Esperado

Al finalizar esta fase el desarrollador deberá comprender que JavaScript puede utilizarse para mejorar significativamente la experiencia del usuario sin modificar la lógica del Backend.

Esta etapa servirá como preparación para la siguiente fase, donde JavaScript dejará de utilizarse únicamente para manipular la interfaz y comenzará a comunicarse directamente con el servidor mediante peticiones asíncronas utilizando Fetch API y JSON.
