<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        /*Role::create(
            ['libelle' => 'Admin', 'niveau' => 1],
        );
        Role::create(
            ['libelle' => 'Caissier', 'niveau' => 2],
        );
        User::create([
            'nom' => 'Administrator',
            'prenom' => 'Admin',
            'email' => 'administrator@admin.tds',
            'password' => bcrypt('passer123')
        ]);
        $user = User::find(1)->get();
        $user->userRole()->associate(1);
        $user->save();
        $user = User::find(1)->first();
        UserRole::create([
            'user_id' => $user->id,
            'role_id' => 1
        ]);*/
        //$users = User::with('userRole')->get();
        $users = User::with('role')->get();
        return view('users.listUsers', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $rle = Role::find(2);
        $user->role()->associate($rle);
        $user->save();

        return redirect()->route('user.index')->with('success', 'Utilisateur créé avec succee !');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->get('id_user'));
        if ($user->active == 0) {
            $user->active = 1;
            $mess = 'Utilisateur réactivé avec succee';
            $mess_id = 'success';
        } else {
            $user->active = 0;
            $mess = 'Utilisateur désactivé avec succee';
            $mess_id = 'warning';
        }
        $user->save();

        return redirect()->route('user.index')->with($mess_id, $mess);
    }
}
