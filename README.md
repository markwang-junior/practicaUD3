# Práctica UD3: Base de Datos Relacionales con Laravel

## 1. Descripción del problema

Una escuela enfrenta problemas en la gestión de su información académica, debido a que actualmente utiliza hojas de cálculo para registrar datos de profesores, asignaturas y alumnos. Este método manual es propenso a errores, consume mucho tiempo y dificulta la consulta o actualización de los datos.

### Solución Propuesta

Se propone desarrollar un sistema centralizado en **Laravel** que permita gestionar eficientemente esta información académica. Este sistema incluirá las siguientes funcionalidades:

1. **Operaciones CRUD**:
   - Gestión de profesores, asignaturas y alumnos.
   
2. **Relaciones entre tablas**:
   - Registrar qué profesor imparte cada asignatura.
   - Gestionar y consultar las **matriculaciones** de alumnos en asignaturas mediante una **tabla intermedia** (`matriculaciones`), que permitirá relacionar a los alumnos con las asignaturas en las que se inscriben.

3. **Gestión de perfiles de alumnos**:
   - Cada alumno tendrá un **perfil único**, que almacenará información adicional como dirección y teléfono. Esta información se registrará en la tabla **PerfilAlumno**, que está relacionada de forma 1:1 con la tabla de alumnos.

4. **Estadísticas básicas**:
   - Número de alumnos matriculados en cada asignatura.
   - Total de alumnos gestionados por cada profesor.

5. **API REST**:
   - Provisión de una API para facilitar la gestión y el acceso a los datos desde distintas aplicaciones o clientes.

Este sistema permitirá a la escuela:
- **Centralizar y organizar** su información académica.
- **Reducir errores** y duplicidades en los datos.
- **Facilitar la consulta y actualización** de la información.
- Contar con datos confiables para la **toma de decisiones**.

## 2. Modelo E-R

El siguiente diagrama representa el Modelo Entidad-Relación (E-R) del sistema. Cada tabla incluye su clave primaria (PK) y las correspondientes claves foráneas (FK). Además, se muestran las cardinalidades.

![Diagrama E-R](docs/diagramaER.png)

### Descripción de las tablas y relaciones:

- **Profesores**: Contiene la información de cada profesor:
  - **PK**: `idProfesor`
  - Atributos: `Nombre`, `Email`
  - **Relación**: Cada profesor puede impartir varias asignaturas (1:N).

- **Asignaturas**: Contiene la información de cada asignatura:
  - **PK**: `idAsignatura`
  - Atributos: `Nombre`, `profesor_id` (FK)
  - **Relación**: Cada asignatura es impartida por un único profesor.

- **Alumnos**: Contiene la información de cada alumno:
  - **PK**: `idAlumno`
  - Atributos: `Nombre`, `Email`
  - **Relación**: Cada alumno tiene un perfil único (1:1 con la tabla `PerfilAlumno`).

- **PerfilAlumno**: Almacena información adicional de contacto para cada alumno:
  - **PK y FK**: `alumno_id` (referencia a `idAlumno` en la tabla `Alumnos`)
  - Atributos: `Dirección`, `Teléfono`
  - **Relación**: Cada alumno tiene un único perfil, y cada perfil pertenece a un único alumno (1:1).

- **Matriculaciones**: Tabla intermedia que registra la relación N:M entre Alumnos y Asignaturas:
  - **PK**: `idMatricula`
  - **FK**: `alumno_id` (referencia a `idAlumno` en la tabla `Alumnos`), `asignatura_id` (referencia a `idAsignatura` en la tabla `Asignaturas`)
  - Atributos: `fecha_matricula`
  - **Relación**: Permite registrar las asignaturas en las que se matricula cada alumno y los alumnos inscritos en cada asignatura.

### Relación general:
- Un **profesor** puede impartir varias **asignaturas** (1:N).
- Los **alumnos** pueden matricularse en varias **asignaturas**, y cada asignatura puede tener varios alumnos (N:M gestionado por `Matriculaciones`).
- Cada **alumno** tiene un único **perfil**, que almacena información adicional (1:1 con `PerfilAlumno`).

Este modelo centraliza y organiza la información académica, facilitando su consulta, gestión y análisis.


# 3. Implementación

## 3.1 Estructura y Migraciones

El proyecto está desarrollado en **Laravel 10**. Para las tablas, se han definido las siguientes migraciones:

1. **Profesores**  
2. **Asignaturas** (relacionada 1:N con Profesores)  
3. **Alumnos**  
4. **PerfilAlumno** (relación 1:1 con Alumnos)  
5. **Matriculaciones** (tabla intermedia para relacionar N:M entre Alumnos y Asignaturas)

Cada migración define las columnas y sus tipos de datos, así como las restricciones de integridad (PK, FK, etc.).  

Para crearlas en tu base de datos, ejecuta:

php artisan migrate

## 3.2 Modelos (Eloquent)

Se han creado modelos Eloquent para cada tabla:

- **Profesor**  
  - Relación `hasMany` con `Asignatura`.

- **Asignatura**  
  - Relación `belongsTo` con `Profesor`.  
  - Relación `belongsToMany` con `Alumno` mediante la tabla pivot `Matriculaciones`.

- **Alumno**  
  - Relación `hasOne` con `PerfilAlumno`.  
  - Relación `belongsToMany` con `Asignatura` mediante la tabla pivot `Matriculaciones`.

- **PerfilAlumno**  
  - Relación `belongsTo` con `Alumno` (relación inversa 1:1).

- **Matriculaciones**  
  - Tabla pivot que registra la relación N:M entre `Alumnos` y `Asignaturas`.

---

## 3.3 Seeders

Para cargar datos de prueba, se han creado los siguientes seeders:

1. **ProfesoresSeeder**  
2. **AsignaturasSeeder**  
3. **AlumnosSeeder**  
4. **PerfilAlumnoSeeder**  
5. **MatriculacionesSeeder**

Todos ellos están registrados en el archivo `DatabaseSeeder.php`, de modo que se pueden ejecutar con:

php artisan db:seed

o bien

php artisan migrate:fresh --seed


## 3.4 Controladores y Rutas (API)

En el archivo `routes/api.php`, se registran todas las rutas relacionadas con profesores, alumnos, asignaturas y perfil de alumno. Se han creado **controladores API** para manejar las operaciones CRUD (*Create, Read, Update, Delete*).

### Ejemplo de Rutas para Profesores:
- `GET /api/profesores`  
- `POST /api/profesores`  
- `GET /api/profesores/{id}`  
- `PUT /api/profesores/{id}`  
- `DELETE /api/profesores/{id}`  

Un esquema similar se aplica a las entidades **Alumnos**, **Asignaturas** y **PerfilAlumno** (en este último caso, se maneja la relación 1:1 con la tabla `Alumnos`).

---

## 3.5 Pruebas en Postman

Se ha creado una colección en **Postman** con ejemplos de llamadas a cada endpoint. Puedes importarla para probar todas las rutas:

- **Colección**: `postman_collection.json` (ubicada en la raíz del proyecto).

### Ejemplo de Prueba para Profesores:
- **Método**: `POST`  
- **URL**: `http://127.0.0.1:8000/api/profesores`  
- **Body (JSON)**:
  ```json
  {
    "nombre": "Juan Pérez",
    "email": "juan.perez@example.com"
  }


## 4. Way of Working (WoW)

### Requisitos del Sistema

- **PHP** >= 8.0  
- **Composer** >= 2.0  
- **Base de Datos**: MariaDB o MySQL  
- **Docker** (opcional para levantar la base de datos)  

---

### Pasos para Configurar y Ejecutar el Proyecto

1. **Clonar el Repositorio**  
   Clona el repositorio desde GitHub y navega al directorio del proyecto:

   ```bash
   git clone https://github.com/TU_USUARIO/practicaUD3.git
   cd practicaUD3
   ## Configuración del Proyecto

### 1. Levantar la Base de Datos (opcional con Docker)

Si dispones de un archivo `docker-compose.yml` para MariaDB o MySQL, ejecuta el siguiente comando para levantar los servicios:

docker-compose up -d
Asegúrate de configurar tu archivo .env para que apunte correctamente a la base de datos:

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
2. Instalar Dependencias
Ejecuta el siguiente comando para instalar las dependencias del proyecto:


composer install
3. Configurar el Archivo .env
Haz una copia del archivo .env.example y configúralo con las credenciales de tu base de datos:

cp .env.example .env
Edita el archivo .env según tus necesidades.

4. Generar la APP_KEY
Genera una clave única para la aplicación utilizando el siguiente comando:

php artisan key:generate
5. Ejecutar Migraciones y Seeders
Crea las tablas y llena la base de datos con datos de ejemplo ejecutando:

php artisan migrate --seed
6. Levantar el Servidor Local
Ejecuta el servidor de desarrollo de Laravel:

php artisan serve
Por defecto, el servidor estará accesible en:

http://127.0.0.1:8000
7. Probar los Endpoints
Puedes probar los endpoints del sistema utilizando Postman o cualquier cliente REST. Aquí tienes algunos ejemplos básicos:

Listar todos los profesores:

GET http://127.0.0.1:8000/api/profesores
Crear un nuevo profesor:

POST http://127.0.0.1:8000/api/profesores
Body (JSON):

{
  "nombre": "Juan Pérez",
  "email": "juan.perez@example.com"
}
