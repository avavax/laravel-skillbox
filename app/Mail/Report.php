<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Report extends Mailable
{
    use Queueable, SerializesModels;

    public $counters;

    public function __construct(array $counters)
    {
        $this->counters = $counters;
    }

    public function build()
    {
        return $this->markdown('mail.blog-report');
    }
}
