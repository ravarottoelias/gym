<?php

namespace App\Notifications;

use Utilities;
use App\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailExpiredNotification extends Notification
{
    use Queueable;

    private Subscription $subscription;
    private array $copyTo;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Subscription $subscription, array $copyTo = null)
    {
        $this->subscription = $subscription;
        $this->copyTo = $copyTo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $planName = $this->subscription->plan->plan_name;
        $expiredDate =  Carbon::createFromFormat('Y-m-d H:i:s',  $this->subscription->end_date)->format('d-m-Y');
        return (new MailMessage)
                    ->cc($this->copyTo)
                    ->subject('Información sobre suscripción vencida')
                    ->greeting('Hola!')
                    ->line(new HtmlString($notifiable->name . ' te informamos que tu suscripcion al plan <strong>' . $planName . ' venció </strong> el dia <strong>'. $expiredDate . '</strong> y no hemos registrado tu pago.'))
                    ->line('En caso de que ya lo hayas realizado podes informarlo a traves de cualquiera de nuestros medios disponibles, gracias.')
                    ->salutation('Saludos, el equipo ' . Utilities::getSetting('gym_name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
