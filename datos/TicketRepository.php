<?php
require_once "Conexion.php";
require_once "../../negocio/Ticket.php";

class TicketRepository
{
    public function guardar(Ticket $ticket): void
    {
        $pdo = Conexion::obtener();
        $sql = "INSERT INTO ticket (titulo, descripcion, estado) VALUES (:titulo, :descripcion, :estado)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":titulo" => $ticket->getTitulo(),
            ":descripcion" => $ticket->getDescripcion(),
            ":estado" => $ticket->getEstado()
        ]);
    }
}
