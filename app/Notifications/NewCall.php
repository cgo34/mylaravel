<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Programme;
use App\Lot;

class NewCall extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $call;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($call)
    {
        //
        $this->call = $call;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('[ NEW CALL ]The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'call' => $this->call,
            'user' => User::find($this->call->user_id),
            'programme' => Programme::find($this->call->programme_id),
            'lot' => Lot::find($this->call->lot_id),
        ];
    }

    public function toSlack($notifiable)

    {
        $user = User::find($this->call->user_id);
        $programme = Programme::find($this->call->programme_id);
        $lot = Lot::find($this->call->lot_id);

        $message = "___________________________________________________________________________________________________";
        $message .= "\n";
        $message .= "NOUVELLE DEMANDE DE RAPPELLE GALILEO";
        $message .= "\n";
        $message .= "Prospect : " . $user->genre . ' ' . $user->firstname . ' ' . $user->lastname;
        $message .= "\n";
        $message .= "Email : " . $user->email;
        $message .= "\n";
        $message .= "Phone : " . $user->phone;
        $message .= "\n";
        $message .= "Address : " . $user->address . ', ' . $user->zipcode . ' ' . $user->city;
        $message .= "\n";
        $message .= "Programme : " . $programme->name . " [ID : " . $programme->id . "]";
        $message .= "\n";
        if(!empty($lot)){
            $message .= "Lot : " . $lot->number . " [ID : " . $lot->id . "]";
        }
        $message .= "\n";
        $message .= "___________________________________________________________________________________________________";
        $message .= "\n";

        return (new SlackMessage)
            ->content($message);

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

        $user = User::find($this->call->user_id);
        $programme = Programme::find($this->call->programme_id);
        $lot = Lot::find($this->call->lot_id);

        return [
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'programme_id' => $programme->id,
                'programme_name' => $programme->name,
                'lot_id' => $lot->id,
                'lot_numero' => $lot->numero,
                'user_id' => $user->id,
            ],
        ];
    }
}
