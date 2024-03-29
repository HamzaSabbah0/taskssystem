<?php

namespace App\Mail;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected Admin $admin;
    // private Admin $admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Admin $admin)
    {
        //
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('hr@tasks-system.com')
        ->subject('Tasks System | Welcome Eamil')
        ->with(['admin'=>$this->admin])
        // ->with(['admin'=>$this->admin,'name'=>$this->admin->name])
        ->markdown('panel.pages.emails.welcome');
    }
}
