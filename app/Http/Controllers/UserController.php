<?php

namespace App\Http\Controllers;


use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;



class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('user.compte', ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function profil(User $user)
    {
        $user->load('tweets');
        return view('user.profil', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        return view('editaccount', compact('user'));
    }


    public function editpassword()
    {
        $user = Auth::user();
        return view('editpassword', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate( [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'tweetname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            ]);

        $user = Auth::user();
            $user->nom = $request->input('nom');
            $user->prenom = $request->input('prenom');
            $user->tweetname = $request->input('tweetname');
            $user->email = $request->input('email');
            $user->image = $request->input('image');
            $user->save();

       
        return redirect()->route('compte')->with('message', 'Informations modifi??es !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function updatepassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols(),],
        ]);
        $newpassword = 'password';
        $utilisateur = Auth::user();
        $oldpassword = $utilisateur->password;

        if (Hash::check($newpassword, $oldpassword)) {
            $newpassword = $oldpassword;
            return redirect()->route('editpassword')->withErrors(['password_error','ancien et nouveau mot de passe identique !']);
        } else {

            $utilisateur->password = Hash::make(request('password'));
            $utilisateur->save();
            return redirect()->route('compte')->with('message', 'Mot de passe modifi?? !');
        }
    }
}
