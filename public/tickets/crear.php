<?php
require_once "../../negocio/Ticket.php";
require_once "../../datos/TicketRepository.php";

$mensaje = "";
$claseMensaje = "";
$titulo = "";
$descripcion = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["titulo"])) {
        $titulo = $_POST["titulo"];
    }
    if (isset($_POST["descripcion"])) {
        $descripcion = $_POST["descripcion"];
    }

    try {
        $ticket = new Ticket($titulo, $descripcion);

        $repositorio = new TicketRepository();
        $repositorio->guardar($ticket);

        $claseMensaje = "ok";
        $mensaje = "Ticket creado correctamente (estado: " . $ticket->getEstado() . ").";

        $titulo = "";
        $descripcion = "";
    } catch (Exception $e) {
        $claseMensaje = "error";
        $mensaje = "Ocurrió un error al guardar el ticket.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nuevo Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 480px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        label {
            display: block;
            margin-top: 1rem;
            font-weight: bold;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        button {
            margin-top: 1rem;
            padding: 10px 20px;
            cursor: pointer;
        }

        .msg {
            padding: 15px;
            margin-top: 1rem;
            border-radius: 4px;
        }

        .ok {
            background-color:
                color:
        }

        .error {
            background-color:
                color:
        }
    </style>
</head>

<body>
    <h1>Nuevo Ticket</h1>

    <?php if ($mensaje != "") { ?>
        <div class="msg <?php echo $claseMensaje; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php } ?>

    <form method="post" action="">
        <label>Título:</label>
        <input type="text" name="titulo" maxlength="150" value="<?php echo htmlspecialchars($titulo); ?>" required>

        <label>Descripción:</label>
        <textarea name="descripcion" rows="5" required><?php echo htmlspecialchars($descripcion); ?></textarea>

        <button type="submit">Crear ticket</button>
    </form>
</body>

</html>