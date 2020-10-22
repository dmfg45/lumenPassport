<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return $this->validResponse($users);
    }

    /**
     * @return \Illuminate\Http\Response
     * @return  \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];
        $this->validate($request, $rules);
        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);
        $fields['password_confirmation'] = Hash::make($request->password_confirmation);
        $user = User::create($fields);
        return $this->validResponse($user, Response::HTTP_CREATED);
    }

    /**
     *
     * @return  \Illuminate\Http\Response
     */
    public function show($user)
    {
        $users = User::findOrFail($user);
        return $this->validResponse($users);
    }

    /**
     *
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:users,email,' . $user,
            'password' => 'min:8|confirmed',
        ];
        $this->validate($request, $rules);
        $users = User::findOrFail($user);
        $users->fill($request->all());

        if ($request->has('password') && $request->has('password_confirmation')) {
            $user->password = Hash::make($request->password);
            $user->password_confirmation = Hash::make($request->password_confirmation);

        }

        if ($users->isClean()) {
            return $this->errorResponse('Must have at least a changed value', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $users->save();
        return $this->validResponse($users);
    }

    /**
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $users = User::findOrFail($user);
        $users->delete();

        return $this->validResponse($users);
    }

    public function me(Request $request){
        return $this->validResponse(($request->user()));
    }

    //
}
