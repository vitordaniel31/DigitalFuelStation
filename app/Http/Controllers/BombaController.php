<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bomba;
use App\Models\User;
use App\Models\Combustivel;
use App\Models\CombustivelBomba;

class BombaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bombas = Bomba::withTrashed()->get();
        return view('bomba.index')->with('bombas', $bombas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $combustiveis = Combustivel::all();
        return view('bomba.create')->with('combustiveis', $combustiveis);
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
            'codigo' => 'required|integer|unique:bombas',
            'combustiveis[]*' => 'required|integer|distinct|exists:combustiveis,id',
        ]);

        $user = User::find(1);

        $bomba = Bomba::create([
            'codigo' => $request->codigo,
            'password' => $user->password,
        ]);

        foreach ($combustiveis as $combustivel) { 
            $combustivelBomba = CombustivelBomba();
            $combustivelBomba->id_bomba = $bomba->id;
            $combustivelBomba->id_combutivel = $combustivel->id;
        }

        return redirect(route('bomba.index'))->with('alert-success', 'Bomba registrada com sucesso!');
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
        $bomba = Bomba::find($id);
        if ($bomba) {
            return view('bomba.edit')->with('bomba', $bomba);
        }else{
            return redirect(route('bomba.index'))->with('alert-primary', 'Bomba inativa ou inexistente! Informe uma bomba ativa para conseguir editar!');
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
            'codigo' => 'integer|unique:bombas,codigo,' . $id . ',id',
        ]);

        if (!isset($request->status)) $request->status = 0;

        $bomba = Bomba::find($id);
        if ($bomba) {
            $bomba->update([
                'codigo' => $request->codigo,   
            ]);
            return redirect(route('bomba.index'))->with('alert-success', 'Os dados da bomba foram editados com sucesso!');
        }else{
            return redirect(route('bomba.index'))->with('alert-primary', 'Bomba inativa ou inexistente! Informe uma bomba ativa para conseguir editar!');
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
        $bomba = Bomba::find($id);
        if ($bomba) {
            $bomba->delete();
            return redirect(route('bomba.index'))->with('alert-success', 'Bomba inativada com sucesso!');
        }else{
            return redirect(route('bomba.index'))->with('alert-primary', 'Bomba inativa ou inexistente! Informe um bomba ativa para conseguir excluir!');
        }
    }

    public function restore($id)
    {
        $bomba = Bomba::onlyTrashed()->where('id', $id);
        if ($bomba) {
            $bomba->restore();
            return redirect(route('bomba.index'))->with('alert-success', 'Bomba ativada com sucesso!');
        }else{
            return redirect(route('bomba.index'))->with('alert-primary', 'Bomba ativa ou inexistente! Informe uma bomba inativa para conseguir ativá-la!');
        }
    }
}
