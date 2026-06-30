# Documento de Requerimientos

# Fase 2

## Proyecto

Xirius - Administración de Módulos

## Objetivo General

Refactorizar la primera versión del proyecto con el objetivo de reducir la cantidad de archivos y centralizar la lógica del CRUD.

En esta fase no se agregarán nuevas funcionalidades al sistema; el objetivo será mejorar la organización del código, evitar duplicidad y comenzar a implementar una arquitectura más escalable.

---

# Objetivos de Aprendizaje

Al finalizar esta fase el desarrollador deberá comprender:

* Refactorización de código.
* Reutilización de funciones.
* Separación de responsabilidades.
* Uso de controladores mediante estructura `switch`.
* Centralización de operaciones CRUD.
* Envío de parámetros ocultos mediante formularios.
* Flujo de trabajo con ramas en Git.
* Buenas prácticas para organización del código.

---

# Tecnologías

* PHP
* MySQL
* HTML5
* CSS3
* Git

---

# Cambios Esperados

La funcionalidad del sistema deberá permanecer exactamente igual que en la Fase 1.

Los cambios estarán enfocados únicamente en la organización del proyecto.

---

# Nueva Estructura del Proyecto

La estructura deberá quedar de la siguiente manera:

db.php

modulos.php

alta_modulo.php

edit_modulo.php

crud_modulo.php

---

# Archivos Eliminados

Los siguientes archivos dejarán de existir:

get_modulos.php

procesar_modulo.php

delete_modulo.php

Toda su funcionalidad deberá ser absorbida por:

crud_modulo.php

---

# Responsabilidades de los Archivos

## db.php

Responsable de establecer la conexión con MySQL.

No deberá contener lógica de negocio.

---

## modulos.php

Responsable de mostrar la tabla principal de módulos.

Obtendrá la información llamando a la función correspondiente ubicada dentro de:

crud_modulo.php

---

## alta_modulo.php

Responsable únicamente de mostrar el formulario para registrar módulos.

No deberá contener consultas SQL.

El formulario deberá enviar la información a:

crud_modulo.php

---

## edit_modulo.php

Responsable únicamente de mostrar el formulario de edición.

No deberá contener consultas SQL.

El formulario deberá enviar la información a:

crud_modulo.php

---

## crud_modulo.php

Será el nuevo controlador del módulo.

Será responsable de:

* Obtener módulos.
* Obtener un módulo por ID.
* Registrar módulos.
* Editar módulos.
* Eliminar módulos.

Toda la lógica SQL deberá concentrarse en este archivo.

---

# Funciones Esperadas

Dentro de crud_modulo.php deberán existir las siguientes funciones:

obtenerModulos()

obtenerModulo($id)

crearModulo($nombre, $descripcion)

editarModulo($id, $nombre, $descripcion)

eliminarModulo($id)

---


# Implementación de Switch

Todas las acciones deberán controlarse mediante una estructura switch.

Ejemplo conceptual:

switch($accion){

case 'listar':

case 'guardar':

case 'eliminar':

}

El objetivo es comenzar a implementar un controlador centralizado.

---

# Parámetro oculto "accion"

Los formularios deberán indicar qué acción deberá ejecutar el controlador.

Para ello deberán incluir un campo oculto como el siguiente:

<input type="hidden" name="accion" value="guardar">

Ejemplos de acciones:

guardar

listar

eliminar

Este parámetro permitirá que crud_modulo.php determine qué operación ejecutar mediante la estructura switch.

---

# Actualización de Formularios

Los formularios de alta y edición deberán modificar su atributo action.

Antes:

procesar_modulo.php

Ahora:

crud_modulo.php

---

# Eliminación de Registros

La eliminación también deberá ser atendida por:

crud_modulo.php

Utilizando la acción:

eliminar

---

# Validaciones

Antes de guardar un módulo deberán validarse al menos las siguientes reglas:

* El nombre no puede estar vacío.
* La descripción no puede estar vacía.

Como reto adicional se recomienda validar que no existan módulos duplicados.

---

# Mensajes al Usuario

Después de realizar una operación correctamente se recomienda redireccionar nuevamente al listado utilizando parámetros GET.

Ejemplos:

modulos.php?success=1

modulos.php?updated=1

modulos.php?deleted=1

Posteriormente la pantalla principal podrá mostrar mensajes informativos dependiendo del resultado de la operación.

---

# Control de Versiones

A partir de esta fase el proyecto dejará de desarrollarse directamente sobre la rama principal (main).
Cada nueva funcionalidad deberá desarrollarse dentro de una rama independiente.

Ejemplo:

main

↓

fase-2

---

# Flujo de Trabajo con Git

Para comenzar una nueva funcionalidad:

git checkout -b nombre_de_la_nueva_rama

Verificar cambios:

git status

Agregar archivos:

git add .

Crear commit:

git commit -m "Refactorización del CRUD de módulos"

Actualizar repositorio local:

git pull --rebase

Enviar cambios:

git push -u origin nombre_de_la_rama

---

# Criterios de Aceptación

La Fase 2 se considerará concluida cuando:

* El sistema continúe funcionando exactamente igual que en la Fase 1.
* Exista un único archivo encargado de todas las operaciones CRUD.
* Las consultas SQL se encuentren centralizadas.
* Las operaciones sean controladas mediante una estructura switch.
* Se utilicen funciones para evitar código duplicado.
* Los formularios envíen la acción correspondiente mediante un campo oculto.
* El desarrollo se haya realizado sobre una rama distinta de main.
* Todos los cambios se encuentren respaldados mediante commits descriptivos.

---

# Resultado Esperado

Al finalizar esta fase el desarrollador deberá comprender que una aplicación puede mantener la misma funcionalidad mientras mejora significativamente su organización interna.

Este concepto será la base para las siguientes fases del proyecto, donde se incorporarán controladores más robustos, peticiones asíncronas con JavaScript, arquitectura por capas y Programación Orientada a Objetos.
