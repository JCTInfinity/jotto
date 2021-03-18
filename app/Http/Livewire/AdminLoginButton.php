<?php

namespace App\Http\Livewire;

use App\Actions\SendAdminLoginLink;
use Livewire\Component;

class AdminLoginButton extends Component
{
    public bool $sent = false;
    public function render()
    {
        return view('livewire.admin-login-button');
    }

    public function sendLink()
    {
        if(!$this->sent){
            SendAdminLoginLink::run();
            $this->sent = true;
        }
    }

    public function getTextProperty()
    {
        return $this->sent ? 'Admin Login link sent' : 'Send Admin Login Link';
    }

    public function getIconProperty()
    {
        return $this->sent ? 'check' : 'send';
    }
}
