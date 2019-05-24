<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMassage;
use Carbon\Carbon;

class NewItem extends Notification
{
    use Queueable;

   

    /**

     * Create a new notification instance.

     *

     * @return void

     */
    public $produkIni;
   
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($nama)
    {
        $this->produkIni=$nama;
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->produkIni;
    }
    // public function toBroadcast($notifiable)
    // {
    //     return new BroadcastMessage([
    //         'thread' => $this->thread,
    //     ]);
    // }  
}
