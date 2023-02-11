<?php

namespace App\Http\Controllers;

use App\Actions\UploadFile;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'authUser' => auth()->user()
        ]);
    }

    public function edit(UpdateUserRequest $request, UploadFile $uploadFile)
    {
        $data = $request->only([
            'avatar', 
            'name', 
            'email', 
            'password', 
            'password_confirm'
        ]);

        $user = auth()->user();

        if ($request->avatar) {
            $data['avatar'] = $uploadFile->store($request->avatar, 'users');
        }

        if ($request->password !== NULL) {
            if ($request->password !== $request->password_confirm) {
                return redirect()->route('profile.index')
                                 ->with('error_password', 'As senhas não são iguais!');
            }
            $data['password'] = bcrypt($request->password);
        } else {
            $data['password'] = $user->password;
        }


        /** @var User $user */
        $user->update($data);

        return redirect()->route('profile.index')
                         ->with('success', 'Dados alterados com sucesso!');
    }
    
}
