<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;

class Addinvoicenew extends Notification
{
    use Queueable;
    private $invoices;

    public function __construct(Invoice $invoices)//لازم تحط دى كدا عشان اقوله المتغير دا الداتا تايب حاجه زى كدا يعنى من نفس نوع الداتاتايب اللى جايالى هى الازم تتحط كدا
    {
        $this->invoices = $invoices;
    }

    public function via($notifiable)
    {
        return ['database'];
    }



    public function toDatabase($notifiable)
    {
        return [

            //'data' => $this->details['body']
            'id'=> $this->invoices->id,
            'title'=>'تم اضافة فاتورة جديد بواسطة :',
            'user'=> Auth::user()->name,

        ];
    }
}
