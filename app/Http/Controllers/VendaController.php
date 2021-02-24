<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bomba;
use App\Models\Venda;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('venda.index');
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
                'id_combustivel' => 'required|integer|exists:combustiveis_bombas,id_combustivel,id_bomba' . $id_bomba,
                'preco' => 'required|numeric',
                'capacidade' => 'required|numeric',
            ]);
        }
        $request->validate([
            'id_combustivel' => 'required|integer|exists:combustiveis_bombas,id',
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
