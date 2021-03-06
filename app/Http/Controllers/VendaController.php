<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bomba;
use App\Models\Venda;
use App\Models\Combustivel;
use App\Models\CombustivelBomba;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_bomba = \Auth::guard('bomba')->user()->id;
        $combustiveis = CombustivelBomba::join('combustiveis', 'id_combustivel', '=', 'combustiveis.id')->where('id_bomba', $id_bomba)->get();
        return view('venda.index')->with('combustiveis', $combustiveis);
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
        $codigo_bomba = \Auth::guard('bomba')->user()->codigo;
        $bomba = Bomba::where('codigo', $codigo_bomba)->first();
        if ($bomba) {
            $id_bomba = $bomba->id;
            $request->validate([
                'id_combustivel' => 'required|integer|exists:combustiveis_bombas,id_combustivel,id_bomba,' . $id_bomba,
            ]);
            $id_combustivel = $request->id_combustivel;
            $combustivel = Combustivel::find($id_combustivel);
            $preco = $combustivel->preco;
            $request->validate([
                'quantidade' => 'required|numeric|regex:/^\d{1,6}(\.\d{0,3})?$/|min:0.01|max:' . $combustivel->qtd_restante,
            ]);
            $combustivel_bomba = CombustivelBomba::where('id_bomba', $id_bomba)->where('id_combustivel', $id_combustivel)->first();
            if ($combustivel_bomba->status==1) {
                return redirect(route('venda.index'))->with('alert-danger', 'A bomba está em uso! Agurarde um instante!');
            }
            $valor = $request->quantidade * $preco;
            $venda = Venda::create([
                'id_combustivel_bomba' => $combustivel_bomba->id,
                'litros_comprados' => $request->quantidade,
                'valor' => $valor,
            ]);
            $combustivel_bomba->update([
                'status' => 1,        
            ]);
            $combustivel->qtd_restante -= $request->quantidade;
            $combustivel->save();
            $combustivel_bomba->update([
                'status' => 0,        
            ]);
            return redirect(route('venda.index'))->with('alert-success', 'Compra realizada com sucesso! Realize o abastecimento!');
        }
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
        //
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
        //
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
}
