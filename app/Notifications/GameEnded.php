<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GameEnded extends Notification
{
    use Queueable;

    protected ?bool $winLoseOrDraw;

    /**
     * Create a new notification instance.
     *
     * @param bool|null $winLoseOrDraw
     */
    public function __construct(?bool $winLoseOrDraw)
    {
        $this->winLoseOrDraw = $winLoseOrDraw;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'result'=>($this->winLoseOrDraw === null ? 'draw'
                : ($this->winLoseOrDraw ? 'won' : 'lost')),
            'body'=>$this->toString(),
        ];
    }

    public function toString()
    {
        switch($this->winLoseOrDraw){
            case true:
                return 'You won!';
            case null:
                return 'Your game ended in a draw.';
            case false:
                return 'You lost.';
        }
    }
}
