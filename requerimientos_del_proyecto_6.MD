# Documento de Requerimientos

# Fase 6

## Proyecto

Xirius - Administración de Módulos.

## Objetivo General

Refactorizar la arquitectura MVC desarrollada en la fase anterior utilizando principios de Programación Orientada a Objetos (POO).

El objetivo principal no será agregar nuevas funcionalidades al sistema, sino mejorar el diseño interno del código mediante reutilización, herencia, encapsulamiento y reducción de código duplicado.

Al finalizar esta fase el comportamiento de la aplicación deberá seguir siendo exactamente el mismo para el usuario.

Lo único que cambiará será la calidad de la implementación.

---

# Objetivos de Aprendizaje

Al finalizar esta fase el desarrollador deberá comprender:

* Programación Orientada a Objetos aplicada.
* Encapsulamiento.
* Herencia.
* Reutilización de código.
* DRY (Don't Repeat Yourself).
* Clases base.
* Métodos reutilizables.
* Manejo básico de excepciones.
* Organización profesional de código.

---

# Tecnologías

* PHP
* MySQL
* JavaScript
* Fetch API
* JSON
* Bootstrap
* Git

---

# Conceptos Arquitectónicos

## ¿Qué es la Programación Orientada a Objetos?

La Programación Orientada a Objetos es un paradigma que busca representar los elementos de un sistema mediante objetos que encapsulan datos y comportamiento.

Su objetivo principal es facilitar la reutilización del código, mejorar la organización de una aplicación y reducir el acoplamiento entre sus componentes.

En esta fase ya existen clases dentro del proyecto.

El objetivo ahora será utilizarlas correctamente.

---

## Encapsulamiento

El encapsulamiento consiste en ocultar los detalles internos de una clase y exponer únicamente aquello que otras partes del sistema necesitan utilizar.

Por ejemplo:

```php
private $db;
```

La conexión a la base de datos pertenece únicamente al modelo.

Ninguna otra parte de la aplicación debería modificarla directamente.

Esto protege el estado interno del objeto y evita dependencias innecesarias.

---

## Herencia

La herencia permite reutilizar comportamiento común entre distintas clases.

En lugar de repetir el mismo código en varios controladores o modelos, se podrá crear una clase base que concentre la lógica compartida.

Ejemplo conceptual:

BaseController

↓

ModuloController

De la misma forma:

BaseModel

↓

Modulo

---

## DRY (Don't Repeat Yourself)

Uno de los principios más importantes del desarrollo de software consiste en evitar duplicar código.

Si una misma lógica aparece en varios lugares, probablemente deba convertirse en un método reutilizable.

Durante esta fase se buscará identificar y eliminar código repetido.

---

## Reutilización

Una buena arquitectura busca escribir una solución una sola vez y utilizarla tantas veces como sea necesario.

El objetivo será construir componentes reutilizables para futuros módulos del sistema.

---

# Refactorización Esperada

Actualmente el proyecto ya utiliza MVC.

Sin embargo, aún existen responsabilidades repetidas dentro de los controladores y modelos.

Durante esta fase se deberán identificar esos patrones repetitivos y reemplazarlos por componentes reutilizables.

---

# Nueva Estructura del Proyecto

```text
proyecto/

config/
│
└── database.php

controllers/
│
├── BaseController.php
│
└── ModuloController.php

models/
│
├── BaseModel.php
│
└── Modulo.php

views/
│
└── modulos.php

js/
│
└── modulos.js

css/
```

---

# BaseController

Se deberá crear una clase base para todos los controladores.

Su objetivo será concentrar comportamiento común.

Ejemplos:

* responderJSON()
* responderError()
* responderExito()

De esta manera se evitará repetir múltiples llamadas a:

```php
echo json_encode(...)
```

en todos los controladores.

---

# BaseModel

Se deberá crear una clase base para todos los modelos.

Su objetivo será administrar la conexión a la base de datos.

Ejemplo:

* Constructor con la conexión.
* Propiedad protegida para acceder a la base de datos.

Los modelos específicos heredarán esta funcionalidad.

---

# Refactorización del Controller

ModuloController deberá reducir su responsabilidad.

Deberá evitar:

* Código duplicado.
* Respuestas JSON repetidas.
* Validaciones repetidas.

Se buscará que cada método tenga una responsabilidad clara.

---

# Refactorización del Modelo

Modulo.php deberá enfocarse únicamente en la lógica relacionada con módulos.

No deberá administrar aspectos comunes que puedan reutilizar otros modelos.

---

# Manejo de Excepciones

Actualmente existen bloques try/catch con poco aprovechamiento.

Durante esta fase se deberán comenzar a utilizar excepciones para comunicar errores internos.

Ejemplo conceptual:

Si ocurre un error inesperado durante una operación del modelo, este podrá lanzar una excepción que será gestionada por el controlador.

---

# Eliminación de Código Duplicado

Durante la revisión del proyecto deberán identificarse fragmentos de código repetidos.

Cada fragmento repetido deberá convertirse en un método reutilizable.

El objetivo será reducir el tamaño del código y facilitar su mantenimiento.

---

# Buenas Prácticas Esperadas

Durante esta fase deberán aplicarse los siguientes principios:

* DRY (Don't Repeat Yourself).
* Single Responsibility Principle.
* Separación de responsabilidades.
* Bajo acoplamiento.
* Alta cohesión.

---

# Flujo Esperado

Usuario

↓

View

↓

JavaScript

↓

ModuloController

↓

BaseController

↓

Modulo

↓

BaseModel

↓

Base de Datos

↓

Respuesta JSON

↓

JavaScript

↓

Actualizar Interfaz

---

# Control de Versiones

Todo el desarrollo deberá realizarse en una nueva rama.

Ejemplo:

feature/poo-refactor

---

# Flujo de Trabajo con Git

Crear nueva rama:

git checkout -b fase-6

Verificar cambios

git status

Agregar archivos:

git add .

Crear commit:

git commit -m "Refactorización aplicando principios de POO"

Actualizar repositorio local:

git pull --rebase

Enviar cambios:

git push -u origin fase-6

---

# Criterios de Aceptación

La Fase 6 se considerará concluida cuando:

* Exista una clase BaseController.
* Exista una clase BaseModel.
* ModuloController herede de BaseController.
* Modulo herede de BaseModel.
* Se haya reducido el código duplicado.
* Las respuestas JSON se encuentren centralizadas.
* La conexión a la base de datos sea administrada por BaseModel.
* El comportamiento de la aplicación continúe siendo exactamente el mismo.
* El desarrollo se encuentre respaldado mediante Git.

---

# Resultado Esperado

Al finalizar esta fase el desarrollador deberá comprender que la Programación Orientada a Objetos no consiste únicamente en utilizar clases, sino en diseñar componentes reutilizables y con responsabilidades bien definidas.

El proyecto deberá comenzar a parecerse a la estructura utilizada por frameworks profesionales como Laravel, donde los controladores heredan comportamiento común, los modelos comparten funcionalidades base y la lógica repetida se concentra en componentes reutilizables.

Esta fase servirá como preparación para introducir conceptos más avanzados como Namespaces, Composer, Autoload y manejo profesional de dependencias.
