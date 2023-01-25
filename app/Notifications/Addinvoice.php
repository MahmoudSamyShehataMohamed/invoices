<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Addinvoice extends Notification
{
    use Queueable;
    private $invoiceid;

    public function __construct($invoice_id)
    {
        $this->invoiceid = $invoice_id;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        $url = 'http://localhost:8000/invoicedetails/'.$this->invoiceid;
        return (new MailMessage)
                    ->subject('اضافة فاتوره جديده')
                    ->line('اضافة فاتوره جديده')
                    ->action('عرض الفاتوره',  $url)
                    ->line(' للفواتير SAMY شكرا لاستخدامك  ');
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
