<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $msg;
    protected $name;

    public function __construct($email, $msg, $name)
    {
        $this->email = $email;
        $this->msg = $msg;
        $this->name = $name;
    }

    public function handle()
    {
        if ($this->attempts() > 3) {
            Log::info($this->email . '邮件参试失败过多');
        } else {
            $flag = Mail::send('email_templet', ['msg' => $this->msg, 'name' => $this->name], function ($message) {
                $message->to($this->email)->subject('Lending Bee mail authentication');
            });

            if (!$flag) {
                Log::info($this->email . '邮件发送失败');
            }
            sleep(1);
        }
    }
}
