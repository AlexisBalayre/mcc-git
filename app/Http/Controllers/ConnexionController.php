<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConnexionController extends Controller
{
    public function formulaire()
    {
        return view('connexion');
    }

    public function traitement()
    {
	    request()->validate([
	        'email' => ['required', 'email'],
	        'password' => ['required'],
		]);
		
		$remember = request('remember') ? true : false; 

	    $resultat = auth()->attempt([
	    	'email' => request('email'),
	    	'password' => request('password'),
		], $remember);

		if ($resultat) {
			flash("Vous êtes maintenant connecté.")->success();

		    return redirect('/mon-compte');
		}

		return back()->withInput()->withErrors([
		    'email' => 'Vos identifiants sont incorrects.',
		]);
    }
} 
