# Documento de Requerimientos

# Fase 5

## Proyecto

Xirius - Administración de Módulos

## Objetivo General

Refactorizar el proyecto actual para implementar una arquitectura basada en el patrón **MVC (Model - View - Controller)**.

Hasta este momento la aplicación ya es completamente funcional. Sin embargo, el código comienza a crecer y distintas responsabilidades se encuentran mezcladas dentro de los mismos archivos.

El objetivo de esta fase será reorganizar el proyecto utilizando principios de arquitectura de software para mejorar su mantenibilidad, legibilidad y escalabilidad.

No deberán agregarse nuevas funcionalidades.

El comportamiento del sistema deberá seguir siendo exactamente el mismo.

---

# Objetivos de Aprendizaje

Al finalizar esta fase el desarrollador deberá comprender:

* Arquitectura MVC.
* Organización por capas.
* Controllers.
* Models.
* Views.
* Separación de responsabilidades.
* Principio de Responsabilidad Única (Single Responsibility Principle).
* Acoplamiento.
* Cohesión.
* Organización profesional de proyectos PHP.

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

# Conceptos Arquitectónicos

## ¿Qué es una Arquitectura?

Una arquitectura de software define la manera en que una aplicación organiza sus componentes y cómo estos se comunican entre sí.

Su objetivo no es hacer que una aplicación funcione mejor, sino que sea más fácil de mantener, comprender y evolucionar.

---

## ¿Qué es MVC?

MVC significa:

Model

View

Controller

Es un patrón de arquitectura que divide una aplicación en tres responsabilidades principales.

Su objetivo es evitar que toda la lógica de una aplicación termine concentrada en un único archivo.

---

## Model

El Model representa los datos de la aplicación.

Es el único componente autorizado para comunicarse con la base de datos.

Ejemplos de responsabilidades:

* Consultar registros.
* Insertar registros.
* Actualizar registros.
* Eliminar registros.

No debe contener HTML.

No debe contener JavaScript.

No debe responder peticiones HTTP.

---

## View

La View representa la interfaz de usuario.

Su única responsabilidad será mostrar información.

Ejemplos:

* HTML.
* Bootstrap.
* Formularios.
* Tablas.

No deberá contener consultas SQL.

No deberá contener lógica de negocio.

---

## Controller

El Controller será el intermediario entre la interfaz y el modelo.

Será responsable de:

* Recibir peticiones.
* Validar información.
* Llamar al modelo correspondiente.
* Regresar respuestas al Frontend.

No deberá contener consultas SQL.

No deberá contener código HTML.

---

# Principios de Diseño

## Single Responsibility Principle (SRP)

Cada clase, archivo o componente debe tener una única responsabilidad.

Si un archivo realiza múltiples tareas distintas, será más difícil de mantener y más propenso a errores.

Ejemplo incorrecto:

modulos.php

* HTML
* SQL
* JavaScript
* Validaciones
* Consultas
* Bootstrap

Ejemplo correcto:

View

↓

Controller

↓

Model

Cada componente realiza únicamente la tarea para la que fue diseñado.

---

## Separación de Responsabilidades

Cada parte de la aplicación deberá encargarse únicamente de su propio trabajo.

Por ejemplo:

La View muestra información.

El Controller coordina el flujo de la aplicación.

El Model administra los datos.

Cuando cada componente conoce únicamente su responsabilidad, el sistema resulta más sencillo de modificar y mantener.

---

## Acoplamiento

El acoplamiento representa el grado de dependencia entre dos componentes.

Mientras menor sea el acoplamiento, más sencillo será modificar una parte del sistema sin afectar el resto.

Ejemplo:

Si se modifica la base de datos, el único archivo que debería cambiar es el Model.

La View no debería verse afectada.

---

## Cohesión

La cohesión representa qué tan relacionadas están las responsabilidades de un componente.

Un componente con alta cohesión realiza tareas relacionadas entre sí.

Ejemplo:

Modulo.php

* obtenerTodos()
* obtenerPorId()
* crear()
* editar()
* eliminar()

Todas las funciones pertenecen al mismo dominio.

Eso representa una alta cohesión.

---

# Nueva Estructura del Proyecto

La aplicación deberá reorganizarse utilizando la siguiente estructura:

```text
proyecto/

config/
│
└── database.php

controllers/
│
└── ModuloController.php

models/
│
└── Modulo.php

views/
│
├── modulos.php
├── header.php
└── partials/

js/
│
└── modulos.js

css/

index.php
```

---

# Responsabilidad de Cada Carpeta

## config/

Contendrá únicamente archivos de configuración.

Ejemplo:

database.php

---

## models/

Contendrá los modelos de la aplicación.

Cada modelo será responsable únicamente de interactuar con la base de datos.

---

## controllers/

Contendrá los controladores.

Serán responsables de recibir solicitudes del Frontend y coordinar el flujo de la aplicación.

---

## views/

Contendrá únicamente la interfaz gráfica.

No deberán existir consultas SQL dentro de esta carpeta.

---

## js/

Contendrá todo el código JavaScript.

No deberá existir JavaScript incrustado dentro de las vistas.

---

## css/

Contendrá las hojas de estilo del proyecto.

---

# Refactorización Esperada

Actualmente:

modulos.php

↓

JavaScript

↓

crud_modulo.php

↓

MySQL

Al finalizar esta fase el flujo deberá ser:

View

↓

JavaScript

↓

ModuloController.php

↓

Modulo.php

↓

MySQL

---

# Responsabilidades del Modelo

El modelo Modulo.php deberá implementar como mínimo las siguientes operaciones:

* obtenerTodos()
* obtenerPorId($id)
* crear($nombre, $descripcion)
* editar($id, $nombre, $descripcion)
* eliminar($id)

Toda la lógica SQL deberá encontrarse únicamente en este archivo.

---

# Responsabilidades del Controller

ModuloController.php deberá:

* Recibir la petición.
* Identificar la acción solicitada.
* Validar la información recibida.
* Invocar el método correspondiente del modelo.
* Responder en formato JSON.

No deberá contener consultas SQL.

---

# Responsabilidades de la View

La vista únicamente deberá:

* Mostrar la interfaz.
* Contener formularios.
* Invocar JavaScript.
* Mostrar la información obtenida desde el Backend.

---

# JavaScript

Todo el código JavaScript deberá trasladarse a:

js/modulos.js

No deberá permanecer código JavaScript embebido dentro de modulos.php.

---

# Base de Datos

La conexión deberá trasladarse a:

config/database.php

Los modelos utilizarán esta conexión para interactuar con MySQL.

---

# Flujo Esperado

Usuario

↓

View

↓

JavaScript

↓

ModuloController.php

↓

Modulo.php

↓

Base de Datos

↓

Respuesta JSON

↓

JavaScript

↓

Actualizar Interfaz

---

# Criterios de Aceptación

La Fase 5 se considerará concluida cuando:

* El proyecto utilice una estructura basada en MVC.
* Exista una carpeta para Models.
* Exista una carpeta para Controllers.
* Exista una carpeta para Views.
* Exista una carpeta para JavaScript.
* Exista una carpeta para Configuración.
* No existan consultas SQL fuera del Model.
* No exista código HTML dentro del Controller.
* No exista JavaScript incrustado dentro de las Views.
* El comportamiento de la aplicación continúe siendo exactamente el mismo.
* El desarrollo se encuentre respaldado mediante Git.

---

# Resultado Esperado

Al finalizar esta fase el desarrollador deberá comprender que una aplicación profesional no se diferencia únicamente por las tecnologías que utiliza, sino por la forma en que organiza su código.

La implementación de MVC y de principios como la Responsabilidad Única, la Separación de Responsabilidades, el Bajo Acoplamiento y la Alta Cohesión permitirá construir aplicaciones más fáciles de mantener, probar y escalar.

Estos principios constituyen la base sobre la que se construyen la mayoría de los frameworks modernos como Laravel, Spring Boot, ASP.NET Core y Ruby on Rails. Comprenderlos en un proyecto desarrollado desde cero permitirá entender posteriormente dichos frameworks con mayor facilidad y criterio.
