## Preguntas clave respecto a la fase 6:

# Explicar por qué hiciste BaseModel abstracto.
- 

# ¿Qué problema resuelve heredar de BaseModel?
- 

# ¿Qué pasaría si quitamos BaseController?
- 

# ¿Por qué usaste protected y no private?
- 

### Documento de Requerimientos

## Fase 7

## Proyecto

Xirius - Administración de Módulos

## Objetivo General

Refactorizar la capa de acceso a datos del proyecto actual, migrando de **MySQLi a PDO** y mejorando la organización de la configuración y conexión a la base de datos.

El objetivo de esta fase será comprender cómo se comunica la aplicación con la base de datos y cómo separar correctamente la configuración de la aplicación de la lógica encargada de establecer la conexión.

La aplicación deberá conservar exactamente el mismo comportamiento para el usuario.

No deberán agregarse nuevas funcionalidades al sistema.

---

# Objetivos de Aprendizaje

Al finalizar esta fase el desarrollador deberá comprender:

* Diferencias entre MySQLi y PDO.
* Ventajas de utilizar PDO.
* Prepared Statements.
* Parámetros enlazados.
* Manejo de excepciones con PDO.
* Separación entre configuración y conexión.
* Clase de conexión a base de datos.
* Variables de configuración.
* Concepto de variables de entorno.
* Uso de `.env`.
* Importancia de `.gitignore`.
* Manejo seguro de credenciales.
* Refactorización sin modificar el comportamiento de la aplicación.

---

# Tecnologías

* PHP
* MySQL
* PDO
* JavaScript
* Fetch API
* JSON
* Bootstrap
* Git

---

# Conceptos

## ¿Qué es PDO?

PDO significa:

PHP Data Objects

Es una extensión de PHP que proporciona una interfaz orientada a objetos para interactuar con diferentes sistemas de bases de datos.

Actualmente el proyecto utiliza:

```
mysqli
```

Durante esta fase deberá migrarse a:

```
PDO
```

El objetivo no será únicamente cambiar la sintaxis, sino comprender las diferencias entre ambas tecnologías.

---

# MySQLi vs PDO

Actualmente:

```php
$conn = new mysqli(...);
```

Después de la refactorización:

```php
$pdo = new PDO(...);
```

La aplicación deberá continuar utilizando MySQL como motor de base de datos.

El cambio será únicamente en la forma en que PHP se comunica con la base de datos.

---

# Prepared Statements

Las consultas deberán continuar utilizando consultas preparadas.

Actualmente:

```php
$stmt = $this->db->prepare(
    "SELECT * FROM modulos WHERE id = ?"
);
```

Con PDO se deberá utilizar el mecanismo equivalente.

Por ejemplo:

```php
$stmt = $this->db->prepare(
    "SELECT * FROM modulos WHERE id = :id"
);

$stmt->execute([
    ':id' => $id
]);
```

También podrá utilizarse el uso de `?` como placeholder.

La desarrolladora deberá comprender la diferencia entre:

```php
?
```

y:

```php
:nombre
```

y cuándo utilizar cada uno.

---

# Manejo de Excepciones

La conexión PDO deberá configurarse para trabajar con excepciones.

Ejemplo:

```php
$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);
```

Esto permitirá que los errores de base de datos sean manejados mediante:

```php
try {

} catch (Exception $e) {

}
```

El objetivo será mantener un flujo similar al desarrollado en la Fase 6:

```text
Modelo
    ↓
Ocurre un error
    ↓
Exception
    ↓
Controller
    ↓
catch
    ↓
Respuesta JSON
    ↓
JavaScript
```

---

# Separación de Configuración y Conexión

Actualmente el proyecto contiene en un mismo archivo:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "xirius_modulos";

$conn = new mysqli(...);
```

En esta fase se deberá analizar la diferencia entre:

## Configuración

Información necesaria para establecer la conexión.

Ejemplo:

```text
Host
Usuario
Contraseña
Base de datos
Puerto
```

## Conexión

Código responsable de utilizar dicha configuración para crear una conexión con la base de datos.

La separación podrá realizarse mediante diferentes archivos.

Por ejemplo:

```text
config/
│
├── config.php
│
└── database.php
```

Sin embargo, esta estructura no es obligatoria.

Lo importante será comprender que:

> La configuración y la creación de la conexión son responsabilidades diferentes.

---

# Clase Database

Se deberá evaluar la creación de una clase encargada de administrar la conexión a la base de datos.

Ejemplo conceptual:

```php
class Database
{
    private $pdo;

    public function conectar()
    {
        // Crear conexión PDO
    }
}
```

El objetivo será evitar que cada modelo tenga que encargarse de crear su propia conexión.

El flujo esperado será:

```text
Modulo
    ↓
BaseModel
    ↓
Database
    ↓
PDO
    ↓
MySQL
```

La implementación podrá variar dependiendo de la solución propuesta por la desarrolladora.

---

# Refactorización de BaseModel

Actualmente:

```php
abstract class BaseModel
{
    protected $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }
}
```

Después de la migración deberá utilizar PDO en lugar de MySQLi.

Por ejemplo:

```php
protected PDO $db;
```

El objetivo será que los modelos continúen utilizando:

```php
$this->db
```

sin preocuparse por cómo se creó la conexión.

---

# Refactorización de Modulo

El modelo `Modulo` deberá migrar todas sus consultas de MySQLi a PDO.

Deberán mantenerse las mismas operaciones:

```
obtenerTodos()
obtenerPorId($id)
crear($nombre, $descripcion)
editar($id, $nombre, $descripcion)
eliminar($id)
```

El comportamiento deberá ser exactamente el mismo.

La única diferencia será la implementación interna del acceso a datos.

---

# Concepto de Variables de Entorno

Durante esta fase se deberá introducir el concepto de variables de entorno.

La aplicación actualmente contiene información como:

```php
$host = "localhost";
$user = "root";
$password = "";
```

En una aplicación real, las credenciales no deberían estar escritas directamente dentro del código fuente.

Se deberá conocer el concepto de:

```
.env
```

Por ejemplo:

```
DB_HOST=localhost
DB_DATABASE=xirius_modulos
DB_USERNAME=root
DB_PASSWORD=
```

La aplicación podrá utilizar estas variables para obtener la configuración de conexión.

---

# Seguridad y Git

El archivo:

```
.env
```

no deberá subirse al repositorio.

Deberá agregarse al archivo:

```
.gitignore
```

Ejemplo:

```
.env
```

El repositorio podrá contener un archivo:

```
.env.example
```

con valores de ejemplo.

Por ejemplo:

```
DB_HOST=localhost
DB_DATABASE=xirius_modulos
DB_USERNAME=root
DB_PASSWORD=
```

El objetivo es que otros desarrolladores puedan conocer qué variables necesita el proyecto sin exponer credenciales reales.

---

# Nueva Estructura Esperada

La estructura podrá evolucionar hacia algo similar a:

```
proyecto/

config/
│
├── config.php
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

.env
.env.example
.gitignore
```

Esta estructura es únicamente una referencia.

La desarrolladora podrá proponer una organización diferente siempre que respete la separación de responsabilidades.

---

# Flujo Esperado

El flujo final deberá ser similar a:

```
Usuario
    ↓
View
    ↓
JavaScript
    ↓
Controller
    ↓
Model
    ↓
BaseModel
    ↓
Database
    ↓
PDO
    ↓
MySQL
```

En caso de error:

```text
MySQL
    ↓
PDO Exception
    ↓
Model
    ↓
Controller
    ↓
JSON
    ↓
JavaScript
    ↓
Mensaje al usuario
```

---

# Restricciones

Durante esta fase:

* No se deberá cambiar la interfaz del sistema.
* No se deberán agregar funcionalidades nuevas.
* No se deberá modificar la estructura de la base de datos.
* No se deberá cambiar el comportamiento del CRUD.
* No se deberá eliminar el uso de consultas preparadas.
* No se deberán almacenar credenciales reales en Git.

---

# Control de Versiones

Todo el desarrollo deberá realizarse en una nueva rama.

Ejemplo:

fase-7

Crear rama:
git checkout -b fase-7

Verificar cambios:
git status

Agregar archivos:
git add .

Crear commit:
git commit -m "Migración de MySQLi a PDO"

Actualizar repositorio:
git pull --rebase

Enviar cambios:
git push -u origin fase-7

---

# Criterios de Aceptación

La Fase 7 se considerará concluida cuando:

* La aplicación utilice PDO en lugar de MySQLi.
* Todas las operaciones del modelo funcionen correctamente.
* Se continúen utilizando consultas preparadas.
* Se comprendan los placeholders de PDO.
* PDO esté configurado para manejar errores mediante excepciones.
* Los errores de base de datos puedan ser gestionados mediante `try/catch`.
* La conexión se encuentre separada de la lógica de los modelos.
* Exista una estrategia clara para administrar la configuración de conexión.
* Se comprenda el concepto de variables de entorno.
* Las credenciales no se encuentren expuestas en el repositorio.
* Se utilice `.gitignore` para excluir archivos sensibles.
* Exista un `.env.example` si se utiliza `.env`.
* El CRUD continúe funcionando exactamente igual que antes.
* El desarrollo se encuentre respaldado mediante Git.

---

# Resultado Esperado

Al finalizar esta fase el desarrollador deberá comprender que el acceso a la base de datos es una responsabilidad que debe mantenerse aislada del resto de la aplicación.

También deberá comprender que una aplicación profesional debe diferenciar entre:

Configuración
y:
Lógica de conexión

Además, deberá comprender que las credenciales y configuraciones sensibles no deben formar parte del código fuente compartido.

La aplicación deberá conservar la arquitectura desarrollada en las fases anteriores:

MVC
+
POO
+
Separación de responsabilidades
+
PDO
+
Manejo de excepciones
+
Configuración segura
