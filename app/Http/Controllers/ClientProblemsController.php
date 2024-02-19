<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientProblems;

class ClientProblemsController extends Controller
{
    function contactos(){
        return view('contactos');
    }

    function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'assunto' => 'required'
        ]);

        $contacto = new ClientProblems();
        $contacto->name = $request->name;
        $contacto->email = $request->email;
        $contacto->message = $request->message;
        $contacto->assunto = $request->assunto;
        $contacto->save();

        return redirect('/contactos')->with('success', 'Mensagem enviada com sucesso!');
    }

    function problemSolved(Request $request){
        $contacto = ClientProblems::find($request->id);
        $contacto->delete();
        return redirect('/administration')->with('success', 'Problema resolvido com sucesso!');
    }
}
