# Alta de Ticket – Arquitectura en tres capas (PHP)

Aplicación web mínima para registrar un Ticket (título y descripción). Todo ticket nuevo se crea con estado `pendiente`.

## Estructura

| Capa | Archivos | Responsabilidad |
|------|----------|-----------------|
| Presentación | `public/tickets/crear.php` | Formulario, recepción de datos, mensaje de resultado |
| Negocio | `negocio/Ticket.php` | Clase `Ticket`, validaciones y estado inicial |
| Persistencia | `datos/Conexion.php`, `datos/TicketRepository.php` | Conexión PDO y `INSERT` |
| Configuración | `config/config.php` | Parámetros de conexión (sin credenciales reales) |

## Instalación

1. Ejecutar `database/schema.sql` en MySQL/MariaDB.
2. Si tu usuario/clave no son `root` / vacío, copiar `config/config.local.example.php` a `config/config.local.php` y completar (este archivo no se sube a Git).
3. Iniciar el servidor desde la raíz del proyecto:
   ```
   php -S localhost:8000 -t public
   ```
4. Abrir http://localhost:8000/tickets/crear.php

## Respuestas

*   **¿Qué código pertenece a la capa de presentación?**
    El archivo `public/tickets/crear.php`. Es el que tiene el HTML para mostrar el formulario y recibe los datos que manda el usuario.

*   **¿Qué código pertenece a la capa de negocio?**
    El archivo `negocio/Ticket.php`. Es donde armamos la clase Ticket con sus datos y donde le decimos que todos arrancan con estado "pendiente".

*   **¿Qué código pertenece a la capa de persistencia?**
    Los archivos `datos/TicketRepository.php` y `datos/Conexion.php`. Son los encargados de conectarse a la base de datos y hacer las consultas SQL.

*   **¿Por qué el INSERT se encuentra en TicketRepository?**
    Para mantener las cosas separadas. De esta forma, si algún día queremos cambiar algo de la base de datos, solo tocamos este archivo y no desarmamos ni los formularios ni la clase Ticket.

*   **¿Por qué el estado inicial pendiente es una regla de negocio y no una decisión del formulario?**
    Porque es una regla de cómo tiene que funcionar la aplicación. Si lo pusiéramos en el formulario (HTML), cualquiera podría inspeccionar la página, cambiar el valor y mandar un ticket que ya esté "resuelto". Poniéndolo en la clase de negocio nos aseguramos de que siempre nazca como pendiente.
