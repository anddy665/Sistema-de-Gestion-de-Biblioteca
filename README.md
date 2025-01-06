# Sistema de Gestión de Biblioteca

## Descripción del Proyecto

Desarrollar un sistema de gestión de biblioteca utilizando PHP puro, MySQL para la base de datos y Tailwind CSS o Bootstrap para el diseño de la interfaz. El sistema permitirá a los usuarios registrar libros, gestionar usuarios y registrar préstamos y devoluciones de libros. Este proyecto evaluará los conocimientos del estudiante en programación en PHP, diseño front-end y manejo de bases de datos.

---

## Requerimientos Funcionales

1. **Módulo de Gestión de Libros**:

   - Crear, leer, actualizar y eliminar (CRUD) libros.
   - Cada libro debe contener:
     - ID (autoincremental).
     - Título.
     - Autor.
     - Género.
     - Año de publicación.
     - Estado (Disponible, Prestado).

2. **Módulo de Usuarios**:

   - CRUD para usuarios registrados.
   - Cada usuario debe contener:
     - ID (autoincremental).
     - Nombre completo.
     - Correo electrónico.
     - Número de teléfono.

3. **Módulo de Préstamos y Devoluciones**:

   - Registrar un préstamo de un libro a un usuario.
   - Registrar la devolución del libro y actualizar el estado del libro a “Disponible”.
   - Campos para el registro:
     - ID del préstamo (autoincremental).
     - ID del libro.
     - ID del usuario.
     - Fecha de préstamo.
     - Fecha de devolución (opcional si el libro no ha sido devuelto).

4. **Autenticación y Autorización**:

   - Página de inicio de sesión para administradores.
   - Validar que solo usuarios autenticados puedan acceder al sistema.

5. **Interfaz de Usuario**:

   - Diseñar una interfaz amigable y responsiva utilizando Tailwind CSS o Bootstrap.
   - Página principal con accesos rápidos a cada módulo.

---

## Requerimientos Técnicos

1. **Lenguajes y Tecnologías**:

   - PHP puro (sin frameworks).
   - HTML5 y CSS3.
   - Tailwind CSS o Bootstrap.
   - JavaScript (para validaciones y algunas funcionalidades básicas, como filtros en tablas).

2. **Base de Datos**:

   - MySQL.
   - Tablas necesarias:
     - `books` (para almacenar la información de los libros).
     - `users` (para almacenar la información de los usuarios).
     - `loans` (para registrar los préstamos y devoluciones).

3. **Validaciones**:

   - Validar formularios tanto en el cliente (JavaScript) como en el servidor (PHP).
   - Asegurarse de que no se pueda prestar un libro que ya está prestado.

4. **Control de Errores**:

   - Manejo de errores para conexiones a la base de datos.
   - Mensajes de error claros para el usuario final.

---

## Criterios de Evaluación

1. **Funcionalidad**:

   - Cada módulo funciona correctamente según lo especificado.
   - El sistema realiza las validaciones adecuadas.

2. **Diseño**:

   - La interfaz es clara, amigable y responsiva.
   - Uso correcto de Tailwind CSS o Bootstrap.

3. **Código**:

   - Código limpio, bien comentado y organizado.
   - Uso adecuado de las funciones y estructuras de control en PHP.

4. **Base de Datos**:

   - Uso adecuado de relaciones y diseño normalizado.
   - Consultas eficientes y seguras (uso de prepared statements para evitar inyecciones SQL).

5. **Documentación**:

   - Manual de usuario básico que explique cómo usar el sistema.
   - Instrucciones para instalar y configurar el proyecto.

---

## Entregables

1. Código fuente del proyecto.
2. Script SQL para crear y poblar la base de datos.
3. Documentación (manual de usuario e instrucciones de instalación).

---

## Tiempo Estimado

Se espera que el proyecto se complete en un plazo de 2 semanas.

---

## Notas Adicionales

El estudiante puede agregar funcionalidades extra para mejorar el proyecto, como:

- Filtros avanzados para buscar libros.
- Reportes de préstamos realizados.
- Notificaciones por correo electrónico para recordar fechas de devolución.

