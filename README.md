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

## Respuestas "Al finalizar"

*   **¿Qué código pertenece a la capa de presentación?**
    El archivo `public/tickets/crear.php`. Se encarga de mostrar la interfaz HTML al usuario y recibir los datos enviados por el formulario POST.

*   **¿Qué código pertenece a la capa de negocio?**
    El archivo `negocio/Ticket.php`. Representa el dominio del problema y contiene las reglas, como establecer el estado inicial "pendiente" para todo ticket nuevo.

*   **¿Qué código pertenece a la capa de persistencia?**
    Los archivos `datos/TicketRepository.php` y `datos/Conexion.php`. Son los únicos que interactúan con la base de datos mediante SQL y PDO.

*   **¿Por qué el INSERT se encuentra en TicketRepository?**
    Para cumplir con la separación de responsabilidades. Si alguna vez se cambia la base de datos, solo hay que modificar el repositorio, sin afectar a la capa de presentación ni a las reglas de negocio.

*   **¿Por qué el estado inicial pendiente es una regla de negocio y no una decisión del formulario?**
    Porque es una regla estricta de cómo debe funcionar el sistema. Si estuviera en el formulario (por ejemplo en un input oculto), un usuario podría modificarlo y crear un ticket con estado "resuelto" engañando al sistema.
