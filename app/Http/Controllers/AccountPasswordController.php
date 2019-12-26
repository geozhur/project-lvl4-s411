<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class AccountPasswordController extends Controller
{
    public function edit(User $user)
    {
        $user = Auth::user();
        return view('account.password.edit', compact('user'));
    }

    public function update(User $user)
    {
        $user = Auth::user();

        $this->validate(request(), [
            'confirm_new_password' => 'required',
            'new_password' => 'required|same:confirm_new_password',
            'password_for_change_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!\Hash::check($value, $user->password)) {
                    return $fail(__('account.current_password_incorrect'));
                }
            }]
        ]);

        $user->password = bcrypt(request('new_password'));

        $user->save();
        flash(__('account.password_updated'))->success();
        return back();
    }
}
