<?php

namespace App\Http\Controllers;

use App\Models\Combate;
use Illuminate\Http\Request;

class CombateController extends Controller
{
    public function index()
    {
        $data = Combate::orderBy('id')->get();
        return view('combate.index', compact('data'));
    }

    public function create()
    {
        return view('combate.create');
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|max:225|min:5',
            'descricao' => 'required|max:225|min:5'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($regras, $msgs);

        if(isset($reg)) {
            $reg->nome = $request->nome;
            $reg->descricao = $request->descricao;
            $reg->data = $request->data;
            $reg->save();
        } 
        
        return redirect()->route('combate.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $dados = Combate::find($id);

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('combate.edit', compact('dados'));

    }

    public function update(Request $request, $id)
    {
        $regras = [
            'nome' => 'required|max:100|min:10',
            'descricao' => 'required|max:1000|min:20',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($regras, $msgs);

        $reg = Combate::find($id);
        
        if(isset($reg)) {
            $reg->nome = $request->nome;
            $reg->descricao = $request->descricao;
            $reg->save();
        } else {
            return "<h1>ID: $id não encontrado!";
        }

        return redirect()->route('combate.index');
    }

    public function destroy($id)
    {
        $reg=Combate::find($id);

        if(!isset($reg)) { return "<h1>ID: $id não encontrado!"; }

        $reg->delete();

        return redirect()->route('combat.index');
    }
}
