<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Combustivel;

class CombustivelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $combustiveis = Combustivel::withTrashed()->get();
        return view('combustivel.index')->with('combustiveis', $combustiveis);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('combustivel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'combustivel' => 'required|string|max:255|unique:combustiveis',
            'preco' => 'required|numeric',
            'capacidade' => 'required|numeric',
        ]);

        $combustivel = Combustivel::create([
            'combustivel' => $request->combustivel,
            'preco' => $request->preco,
            'capacidade' => $request->capacidade,
            'qtd_restante' => 0,
        ]);
        return redirect(route('combustivel.index'))->with('alert-success', 'Combustível registrado com sucesso!');
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
    public function edit($id)
    {
        $combustivel = Combustivel::find($id);
        if ($combustivel) {
            return view('combustivel.edit')->with('combustivel', $combustivel);
        }else{
            return redirect(route('combustivel.index'))->with('alert-primary', 'Combustível inativo ou inexistente! Informe um combustível ativo para conseguir editar!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'combustivel' => 'string|max:255|unique:combustiveis,combustivel,' . $id . ',id',
            'preco' => 'numeric',
            'capacidade' => 'numeric',
        ]);

        $combustivel = Combustivel::find($id);
        if ($combustivel) {
            $combustivel->update([
                'combustivel' => $request->combustivel,
                'preco' => $request->preco,
                'capacidade' => $request->capacidade,
            ]);
            return redirect(route('combustivel.index'))->with('alert-success', 'Os dados do combustível foram editados com sucesso!');
        }else{
            return redirect(route('combustivel.index'))->with('alert-primary', 'Combustível inativo ou inexistente! Informe um combustível ativo para conseguir editar!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $combustivel = Combustivel::find($id);
        if ($combustivel) {
            $combustivel->delete();
            return redirect(route('combustivel.index'))->with('alert-success', 'Combustível inativado com sucesso!');
        }else{
            return redirect(route('combustivel.index'))->with('alert-primary', 'Combustível inativo ou inexistente! Informe um combustível ativo para conseguir excluir!');
        }
    }

    public function restore($id)
    {
        $combustivel = Combustivel::onlyTrashed()->where('id', $id);
        if ($combustivel) {
            $combustivel->restore();
            return redirect(route('combustivel.index'))->with('alert-success', 'Combustível ativado com sucesso!');
        }else{
            return redirect(route('combustivel.index'))->with('alert-primary', 'Combustível ativo ou inexistente! Informe um combustível inativo para conseguir ativá-lo!');
        }
    }
}
