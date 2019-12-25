<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class AccountEmailController extends Controller
{
    public function update(Request $request, User $user)
    {
        $user = Auth::user();

        $this->validate(request(), [
            'email' => 'required|email|max:255|unique:users,id,' . $user->id,
            'password_for_change_mail' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!\Hash::check($value, $user->password)) {
                    return $fail(__('account.current_password_incorrect'));
                }
            }]
        ]);

        $user->email = $request->input('email');

        $user->save();
        flash('Email successfully updated')->success();
        return back();
    }
}
