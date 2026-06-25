# Documento de Requerimientos

## Proyecto

Xirius - Administración de Módulos

## Objetivo General

Desarrollar una aplicación web para la administración de los módulos o servicios ofrecidos por Xirius.

El proyecto tiene como objetivo reforzar conocimientos de:

* PHP
* MySQL
* HTML
* CSS
* Bootstrap
* Git
* Flujo de peticiones HTTP
* Arquitectura básica de aplicaciones web

La primera fase deberá implementarse utilizando archivos separados para comprender claramente la responsabilidad de cada componente del sistema.

---

# Tecnologías Requeridas

* PHP 
* MySQL
* HTML5
* CSS3
* Bootstrap (opcional)
* Git

---

# Módulos Iniciales

La aplicación administrará inicialmente los siguientes servicios:

* Revisar xirius.ai y verificar cuales son los módulos / secciones de menú habilitados 
    Usuario: empresa-demo@gmail.com
    Contraseña: admin123

---

# Base de Datos

## Tabla: modulos

| Campo          | Tipo               |
| -------------- | ------------------ |
| id             | INT AUTO_INCREMENT |
| nombre         | VARCHAR(100)       |
| descripcion    | TEXT               |
| fecha_creacion | DATETIME           |

---

# Flujo General de la Aplicación

La aplicación deberá seguir el siguiente flujo:

LISTAR
↓
get_modulos.php

    CREAR
    ↓
    alta_modulo.php
    ↓
    procesar_modulo.php

        EDITAR
        ↓
        edit_modulo.php
        ↓
        procesar_modulo.php

            ELIMINAR
            ↓
            delete_modulo.php

---

# Estructura Esperada del Proyecto

db.php

modulos.php

get_modulos.php

alta_modulo.php

edit_modulo.php

procesar_modulo.php

delete_modulo.php

---

# Descripción de Responsabilidades

## db.php

Responsable de establecer la conexión con la base de datos.

Responsabilidades:

* Crear conexión MySQL.
* Compartir conexión con el resto de archivos.

No deberá contener lógica de negocio.

---

## modulos.php

Pantalla principal.

Responsabilidades:

* Mostrar tabla de módulos.
* Mostrar botón de alta.
* Mostrar acciones de edición.
* Mostrar acciones de eliminación.

La información deberá obtenerse desde:

get_modulos.php

---

## get_modulos.php

Responsable de consultar los módulos existentes.

Operación esperada:

SELECT * FROM modulos

Resultado:

Retornar los registros necesarios para que modulos.php los muestre.

---

## alta_modulo.php

Responsable de mostrar el formulario de registro.

Campos requeridos:

* Nombre
* Descripción

Al enviar el formulario deberá dirigir la información a:

procesar_modulo.php

---

## edit_modulo.php

Responsable de mostrar el formulario de edición.

Deberá recibir:

?id={id_modulo}

Responsabilidades:

* Obtener información del módulo seleccionado.
* Mostrar formulario precargado.
* Permitir modificar información.

Al guardar deberá enviar los datos a:

procesar_modulo.php

---

## procesar_modulo.php

Responsable de guardar cambios en la base de datos.

### Alta

Si no existe ID:

INSERT INTO modulos

### Edición

Si existe ID:

UPDATE modulos

Al finalizar cualquier operación deberá redireccionar a:

modulos.php

---

## delete_modulo.php

Responsable de eliminar registros.

Deberá recibir:

?id={id_modulo}

Operación esperada:

DELETE FROM modulos

Al finalizar deberá redireccionar a:

modulos.php

---

# Requerimientos Funcionales

## RF-01 Listar módulos

El usuario deberá visualizar todos los módulos registrados.

### Criterio de aceptación

Se muestran correctamente todos los registros almacenados en la base de datos.

---

## RF-02 Crear módulo

El usuario deberá registrar nuevos módulos.

### Validaciones

* Nombre obligatorio.
* Descripción obligatoria.

### Criterio de aceptación

El registro se almacena correctamente en la base de datos.

---

## RF-03 Editar módulo

El usuario deberá modificar información de módulos existentes.

### Criterio de aceptación

Los cambios se reflejan correctamente en la base de datos.

---

## RF-04 Eliminar módulo

El usuario deberá eliminar módulos existentes.

### Criterio de aceptación

El registro desaparece de la base de datos y deja de mostrarse en el listado.

---

# Control de Versiones

El proyecto deberá mantenerse en un repositorio en GitHub.

## Reglas

Realizar los siguientes commits descriptivos.

git commit -m "Configuración inicial del proyecto"

git commit -m "Implementación de listado de módulos"

git commit -m "Implementación de alta de módulos"

git commit -m "Implementación de edición de módulos"

git commit -m "Implementación de eliminación de módulos"

## Flujo de comando git

1. git status (Revisar cual o cuales fueron los archivos que se editaron y o agregaron)
2. git add . (Aceptar todos los archivos previamente visualizados en git status)
3. git status (opcional para verificar que ahora cambiaron de color y estan listos para subirse)
4. git commit -m "mensaje descriptivo dependiendo la situación" (Empaquetar los cambios con un mensaje descriptivo para enviar los cambios al repositorio remoto)
5. git pull --rebase (Bajar cambios al repositorio local en caso que haya habido algun cambio reciente por parte de otro usuarios)
6. git push (Subir tus cambios al repositorio remoto)

---

# Objetivos de Aprendizaje

Al finalizar esta fase el desarrollador deberá comprender:

* Flujo cliente-servidor.
* Formularios HTML.
* Métodos GET y POST.
* Consultas SQL básicas.
* Operaciones CRUD.
* Redirecciones con PHP.
* Separación básica de responsabilidades.
* Uso básico de Git.
* Relación entre Frontend, Backend y Base de Datos.

---

# Evolución del Proyecto

Las siguientes fases del proyecto buscarán refactorizar la solución para incorporar:

* Controladores centralizados.
* Switch por acciones.
* Modales.
* AJAX.
* JSON.
* Fetch API.
* Arquitectura por capas.
* Programación Orientada a Objetos.
* Sistema de autenticación.
* Roles y permisos.

El objetivo final es evolucionar gradualmente desde una estructura simple hasta una arquitectura similar a la utilizada en proyectos empresariales reales.
