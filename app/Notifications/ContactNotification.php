<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use App\User;
use App\Programme;
use App\Lot;


class ContactNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $contact;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        //
        $this->contact = $contact;
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
            ->line('[ NEW DENONCE ]The introduction to the notification.')
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
            'contact' => $this->contact,
            'user' => User::find($this->contact->user_id),
            'programme' => Programme::find($this->contact->programme_id),
            'lot' => Lot::find($this->contact->lot_id),
        ];
    }

    public function toSlack($notifiable)

    {
        $user = User::find($this->contact->user_id);
        $programme = Programme::find($this->contact->programme_id);
        $lot = Lot::find($this->contact->lot_id);

        $message = "NOUVELLE DEMANDE D'INFORMATIONS SUR GALILEO";
        $message .= "\n";
        $message .= "Prospect : " . $user->civilite . ' - ' . $user->firstname . ' - ' . $user->lastname . ' - ' . $user->email . ' - ' . $user->phone . ' - ' . $user->address . ' - ' . $user->zipcode . ' - ' . $user->city;
        $message .= "\n";
        $message .= "Programme : " . $programme->name . " [ID : " . $programme->id . "]";
        $message .= "\n";
        if(!empty($lot)){
            $message .= "Lot : " . $lot->numero . " [ID : " . $lot->id . "]";
        }
        $message .= "\n";
        $message .= "___________________________________________________________________________________________________";

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

        $user = User::find($this->contact->user_id);
        $programme = Programme::find($this->contact->programme_id);
        $lot = Lot::find($this->contact->lot_id);

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
