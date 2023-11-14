<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    private $path = "fotos/pokemons";
    public function index()
    {
        $data = Pokemon::orderBy('id')->get();
        return view('pokemon.index', compact('data'));
    }

    public function create()
    {
        return view('pokemon.create');
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|max:225|min:5',
            'descricao' => 'required|max:225|min:5',
            'foto' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($regras, $msgs);

        if($request->hasFile('foto')) {

            // Insert no Banco
            $reg = new Pokemon();
            $reg->nome = $request->nome;
            $reg->descricao = $request->descricao;
            $reg->data = $request->data;
            $reg->save();    

            // Upload da Foto
            $id = $reg->id;
            $extensao_arq = $request->file('foto')->getClientOriginalExtension();
            $nome_arq = $id.'_'.time().'.'.$extensao_arq;
            $request->file('foto')->storeAs("public/$this->path", $nome_arq);
            $reg->foto = $this->path."/".$nome_arq;
            $reg->save();
        }
        
        return redirect()->route('pokemon.index');
    }

    
    public function show($id)
    {

    }

    
    public function edit($id)
    {
        $dados = Pokemon::find($id);

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('pokemon.edit', compact('dados'));   
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

        $reg = Pokemon::find($id);
        
        if(isset($reg)) {
            $reg->nome = $request->nome;
            $reg->descricao = $request->descricao;
            $reg->save();
        } else {
            return "<h1>ID: $id não encontrado!";
        }

        return redirect()->route('pokemon.index');
    }

    public function destroy($id)
    {
        $reg=Pokemon::find($id);

        if(!isset($reg)) { return "<h1>ID: $id não encontrado!"; }

        $reg->delete();

        return redirect()->route('pokemon.index');
    }
}

