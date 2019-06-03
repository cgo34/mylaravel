<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use App\Denonce;
use App\User;
use App\Programme;
use App\Lot;

class NewDenonce extends Notification implements ShouldQueue
{
    use Queueable;

    protected $denonce;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($denonce)
    {
        //
        $this->denonce = $denonce;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'slack', 'broadcast'];
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
            'denonce' => $this->denonce,
            'user' => User::find($this->denonce->user_id),
            'programme' => Programme::find($this->denonce->programme_id),
            'lot' => Lot::find($this->denonce->lot_id),
        ];
    }

    public function toSlack($notifiable)

    {
        $user = User::find($this->denonce->user_id);
        $programme = Programme::find($this->denonce->programme_id);
        $lot = Lot::find($this->denonce->lot_id);

        $message = "___________________________________________________________________________________________________";
        $message .= "\n";
        $message .= "NOUVELLE DENONCE SUR GALILEO";
        $message .= "\n";
        $message .= "Prospect : " . $this->denonce->genre . ' ' . $this->denonce->firstname . ' ' . $this->denonce->lastname;
        $message .= "\n";
        $message .= "Email : " . $this->denonce->email;
        $message .= "\n";
        $message .= "Phone : " . $this->denonce->phone;
        $message .= "\n";
        $message .= "Address : " . $this->denonce->address . ', ' . $this->denonce->zipcode . ' ' . $this->denonce->city;
        $message .= "\n";
        $message .= "\n";
        $message .= "Professionnel : " . $user->genre . ' ' . $user->firstname . ' ' . $user->lastname ;
        $message .= "\n";
        $message .= "Email : " . $user->email;
        $message .= "\n";
        $message .= "Phone : " . $user->phone;
        $message .= "\n";
        $message .= "Address : " . $user->address . ', ' . $user->zipcode . ' ' . $user->city;
        $message .= "\n";
        $message .= "\n";
        $message .= "Programme : " . $programme->name . " [ID : " . $programme->id . "]";
        $message .= "\n";
        if(!empty($lot)){
            $message .= "Lot : " . $lot->numero . " [ID : " . $lot->id . "]";
        }
        $message .= "\n";

        return (new SlackMessage)
            ->content($message);

    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'denonce' => $this->denonce,
            'user' => User::find($this->denonce->user_id),
            'programme' => Programme::find($this->denonce->programme_id),
            'lot' => Lot::find($this->denonce->lot_id),
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

        $user = User::find($this->denonce->user_id);
        $programme = Programme::find($this->denonce->programme_id);
        $lot = Lot::find($this->denonce->lot_id);

        return [
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'programme_id' => $programme->id,
                'programme_name' => $programme->name,
                'lot_id' => $lot->id,
                'lot_numero' => $lot->numero,
                'user_id' => $user->id,
                'firstname' => $user->firstname,
            ],
        ];
    }
}
