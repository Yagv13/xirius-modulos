# Documento de Requerimientos

# Fase 4

## Proyecto

Xirius - Administración de Módulos

## Objetivo General

Modernizar la comunicación entre el Frontend y el Backend eliminando el envío tradicional de formularios mediante el atributo action.

A partir de esta fase todas las operaciones CRUD deberán realizarse utilizando JavaScript, el método Fetch API y respuestas en formato JSON.

El objetivo principal será comprender cómo se comunican actualmente la mayoría de las aplicaciones web modernas.

---

# Objetivos de Aprendizaje

Al finalizar esta fase el desarrollador deberá comprender:

* Comunicación Cliente - Servidor.
* Programación asíncrona.
* Fetch API.
* FormData.
* JSON.
* async / await.
* try / catch.
* Manipulación dinámica del DOM.
* Separación entre Frontend y Backend.
* Concepto básico de API.

---

# Tecnologías

* PHP
* MySQL
* HTML5
* CSS3
* Bootstrap
* JavaScript
* Fetch API
* JSON
* Git

---

# Cambios Esperados

La funcionalidad del sistema continuará siendo exactamente la misma.

Los cambios estarán enfocados únicamente en la forma en que el Frontend se comunica con el Backend.

Ya no deberán utilizarse formularios con envío tradicional.

---

# Arquitectura Esperada

Frontend

↓

JavaScript

↓

Fetch API

↓

crud_modulo.php

↓

Base de Datos

↓

Respuesta JSON

↓

JavaScript

↓

Actualizar Interfaz

---

# Eliminación del atributo action

Los formularios dejarán de enviar información directamente mediante:

action="crud_modulo.php"

El evento submit deberá ser interceptado utilizando JavaScript.

Ejemplo conceptual:

Evento Submit

↓

preventDefault()

↓

Fetch API

↓

Respuesta JSON

---

# Uso de preventDefault()

El formulario deberá evitar el comportamiento tradicional del navegador.

Conceptualmente:

Evento submit

↓

preventDefault()

↓

JavaScript toma el control

---

# Uso de FormData

La información del formulario deberá obtenerse utilizando:

FormData(formulario)

El objetivo es comprender cómo enviar información mediante Fetch sin depender del envío tradicional de formularios.

---

# Uso de Fetch API

Toda comunicación con el Backend deberá realizarse utilizando Fetch API.

Conceptualmente:

Fetch

↓

POST

↓

crud_modulo.php

↓

JSON

---

# Programación Asíncrona

Las operaciones deberán implementarse utilizando:

async

await

El objetivo será comprender que la comunicación con el servidor ocurre de manera asíncrona.

---

# Manejo de Errores

Las peticiones deberán manejar errores utilizando:

try

catch

En caso de error deberá mostrarse un mensaje apropiado al usuario.

---

# Respuesta del Backend

crud_modulo.php dejará de responder mediante redirecciones.

Ya no deberán utilizarse instrucciones como:

header("Location: modulos.php")

En su lugar deberá responder utilizando JSON.

Ejemplo conceptual:

Éxito

↓

success

message

Error

↓

success

message

---

# Formato de Respuesta

Todas las operaciones deberán devolver información estructurada.

Ejemplos:

Registro exitoso

Actualización exitosa

Eliminación exitosa

Error de validación

Registro duplicado

Error interno del servidor

---

# Operaciones que deberán migrarse

Las siguientes operaciones deberán implementarse mediante Fetch API.

Registrar módulo

Editar módulo

Eliminar módulo

Todas deberán funcionar sin recargar la página.

---

# Actualización de la Interfaz

Después de cada operación exitosa la interfaz deberá actualizarse dinámicamente.

Se recomienda cualquiera de las siguientes estrategias:

Opción 1

Recargar únicamente la tabla.

Opción 2

Actualizar el DOM mediante JavaScript.

El objetivo es evitar la recarga completa de la página.

---

# Eliminación

La operación eliminar también deberá utilizar JavaScript.

Flujo esperado:

Usuario

↓

Botón Eliminar

↓

Confirmación

↓

Fetch API

↓

crud_modulo.php

↓

JSON

↓

Eliminar fila o actualizar tabla

---

# Mensajes al Usuario

Los mensajes dejarán de depender de parámetros GET.

Ya no deberán utilizarse:

?success=1

?updated=1

?deleted=1

Los mensajes deberán mostrarse utilizando JavaScript.

Se recomienda utilizar:

Bootstrap Alerts dinámicas

o

SweetAlert2 (Opcional)

---

# Backend

crud_modulo.php continuará siendo el controlador principal.

Sin embargo, deberá detectar las peticiones realizadas mediante Fetch y responder utilizando JSON.

Las funciones existentes podrán reutilizarse.

No será necesario modificar la lógica SQL.

---

# Flujo Esperado

Registro

Usuario

↓

Modal

↓

JavaScript

↓

Fetch API

↓

crud_modulo.php

↓

INSERT

↓

Respuesta JSON

↓

Mensaje de éxito

↓

Actualizar tabla

---

Edición

Usuario

↓

Modal

↓

JavaScript

↓

Fetch API

↓

UPDATE

↓

Respuesta JSON

↓

Actualizar tabla

---

Eliminación

Usuario

↓

Confirmación

↓

JavaScript

↓

Fetch API

↓

DELETE

↓

Respuesta JSON

↓

Actualizar tabla

---

# Conceptos de JavaScript Esperados

Durante esta fase deberán utilizarse al menos los siguientes conceptos:

* addEventListener()
* preventDefault()
* async
* await
* fetch()
* FormData
* JSON.parse()
* response.json()
* try
* catch

---

# Control de Versiones

Todo el desarrollo deberá realizarse en una nueva rama.

Ejemplo:

main

↓

fase-4

---

# Flujo de Trabajo con Git

Crear nueva rama:

git checkout -b fase-4

Verificar cambios:

git status

Agregar archivos:

git add .

Crear commit:

git commit -m "Migración del CRUD a Fetch API"

Actualizar repositorio local:

git pull --rebase

Enviar cambios:

git push -u origin fase-4

---

# Criterios de Aceptación

La Fase 4 se considerará concluida cuando:

* Ningún formulario utilice el atributo action para enviar información.
* Todas las operaciones CRUD se realicen mediante Fetch API.
* El Backend responda utilizando JSON.
* Las redirecciones mediante header() hayan sido eliminadas.
* Los mensajes de éxito y error sean mostrados mediante JavaScript.
* La aplicación no recargue completamente la página durante las operaciones CRUD.
* El código JavaScript se encuentre separado y organizado.
* El desarrollo se encuentre respaldado mediante Git.

---

# Resultado Esperado

Al finalizar esta fase el desarrollador deberá comprender cómo una aplicación moderna comunica el Frontend con el Backend utilizando peticiones asíncronas.

Este conocimiento servirá como base para las siguientes fases del proyecto, donde el Backend comenzará a organizarse por capas y evolucionará hacia una arquitectura más cercana a la utilizada en frameworks como Laravel, Spring Boot o ASP.NET.
