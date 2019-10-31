<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class AccountController extends Controller
{
    public function edit(User $user)
    {
        $user = Auth::user();
        return view('account.edit', compact('user'));
    }

    public function update(User $user)
    {
        $user = Auth::user();

        $this->validate(request(), [
            'name' => 'required|min:2||max:255|unique:users,id,' . $user->id,
        ]);

        $user->name = request('name');

        $user->save();
        flash('Data successfully updated')->success();
        return redirect()->route('account.edit', $user->id);
    }

    public function editSecurity(User $user)
    {
        $user = Auth::user();
        return view('account.security.edit', compact('user'));
    }

    public function updateEmail(Request $request, User $user)
    {
        $user = Auth::user();

        $this->validate(request(), [
            'email' => 'required|email|max:255|unique:users,id,' . $user->id,
            'password_for_change_mail' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!\Hash::check($value, $user->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }]
        ]);

        $user->email = request('email');

        $user->save();
        flash('Email successfully updated')->success();
        return back();
    }

    public function updatePassword(User $user)
    {
        $user = Auth::user();

        $this->validate(request(), [
            'confirm_new_password' => 'required',
            'new_password' => 'required|same:confirm_new_password',
            'password_for_change_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!\Hash::check($value, $user->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }]
        ]);

        $user->password = bcrypt(request('new_password'));

        $user->save();
        flash('Password successfully updated')->success();
        return back();
    }

    public function destroy(User $user)
    {
        $user = Auth::user();
        $user->delete();
        flash(__('account.your_account_deleted'));
        return redirect()->route('welcome');
    }
}
