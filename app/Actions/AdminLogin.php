<?php

namespace App\Actions;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsController;

class AdminLogin
{
    use AsController;

    public function handle(Request $request)
    {
        if(!$request->hasValidSignature()) abort(403);
        Auth::login(Admin::first());
        $request->session()->regenerate();
        return response()->redirectTo('/admin/dashboard');
    }
}
