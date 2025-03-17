<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NuevaSolicitud extends Notification
{
    use Queueable;

    protected $solicitud;

    public function __construct($solicitud)
    {
        $this->solicitud = $solicitud;
    }

    public function via($notifiable)
    {
        return ['database']; // Guardar en la base de datos
    }

    public function toDatabase($notifiable)
    {
        return [
            'mensaje' => 'Has recibido una nueva solicitud de ' . $this->solicitud->usuario->name,
            'solicitud_id' => $this->solicitud->id,
            'tipo' => $this->solicitud->tipo,
            'descripcion' => $this->solicitud->descripcion,
        ];
    }
}