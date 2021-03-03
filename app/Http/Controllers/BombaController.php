<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bomba;
use App\Models\User;
use App\Models\Combustivel;
use App\Models\CombustivelBomba;
use App\Http\Requests\Auth\BombaRequest;
use App\Providers\RouteServiceProvider;

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
        $combustiveis = CombustivelBomba::join('combustiveis', 'id_combustivel', '=', 'combustiveis.id')->orderBy('combustivel')->whereNull('combustiveis.deleted_at')->get();
        return view('bomba.index')->with('bombas', $bombas)->with('combustiveis', $combustiveis);
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
            'codigo' => 'required|integer|min:1|max:99|unique:bombas',
            'combustiveis' => "required|array|min:1",
            'combustiveis.*' => 'required|integer|distinct|exists:combustiveis,id',
        ]);

        $combustiveis = $request->combustiveis;

        $user = User::find(1);

        $bomba = Bomba::create([
            'codigo' => $request->codigo,
            'password' => $user->password,
        ]);

        foreach($combustiveis as $key => $combustivel) { 
            $combustivelBomba = CombustivelBomba::create([
                'id_combustivel' => $combustivel,
                'id_bomba' => $bomba->id,
            ]);
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
        $combustiveis = Combustivel::all();
        $combustiveisBombas = CombustivelBomba::where('id_bomba', $id)->get();
    
        if ($bomba) {
            return view('bomba.edit')->with('bomba', $bomba)->with('combustiveis', $combustiveis)->with('combustiveisBombas', $combustiveisBombas);
        }else{
            return redirect(route('bomba.index'))->with('alert-danger', 'Bomba inativa ou inexistente! Informe uma bomba ativa para conseguir editar!');
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
            'codigo' => 'integer|min:1|max:99|unique:bombas,codigo,' . $id . ',id',
            'combustiveis' => "required|array|min:1",
            'combustiveis.*' => 'required|integer|distinct|exists:combustiveis,id',
        ]);

        $combustiveis = $request->combustiveis;

        $bomba = Bomba::find($id);
        if ($bomba) {
            $bomba->update([
                'codigo' => $request->codigo,   
            ]);

            foreach($combustiveis as $key => $combustivel) {
                $consulta = CombustivelBomba::withTrashed()->where('id_bomba', $id)->where('id_combustivel', $combustivel)->first();
                if (!$consulta) {
                    $combustivelBomba = CombustivelBomba::create([
                        'id_combustivel' => $combustivel,
                        'id_bomba' => $id,
                    ]);
                }elseif($consulta and $consulta->   trashed()){
                    $consulta->restore();
                }
            }

            $combustiveisBombas = CombustivelBomba::where('id_bomba', $id)->get();
            foreach ($combustiveisBombas as $cb) {
                
                if (!in_array($cb->id_combustivel, $combustiveis)) {
                    $consulta2 = CombustivelBomba::find($cb->id);
                    $consulta2->delete();
                }
            }


            return redirect(route('bomba.index'))->with('alert-success', 'Os dados da bomba foram editados com sucesso!');
        }else{
            return redirect(route('bomba.index'))->with('alert-danger', 'Bomba inativa ou inexistente! Informe uma bomba ativa para conseguir editar!');
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
            $combustiveisBombas = CombustivelBomba::where('id_bomba', $id)->get();
            foreach ($combustiveisBombas as $cb) {
               $cb->delete();
            }
            $bomba->delete();
            return redirect(route('bomba.index'))->with('alert-success', 'Bomba inativada com sucesso!');
        }else{
            return redirect(route('bomba.index'))->with('alert-danger', 'Bomba inativa ou inexistente! Informe um bomba ativa para conseguir excluir!');
        }
    }

    public function restore($id)
    {
        $bomba = Bomba::onlyTrashed()->where('id', $id);
        if ($bomba) {
            $combustiveisBombas = CombustivelBomba::withTrashed()->where('id_bomba', $id)->get();
            foreach ($combustiveisBombas as $cb) {
               $cb->restore();
            }
            $bomba->restore();
            return redirect(route('bomba.index'))->with('alert-success', 'Bomba ativada com sucesso!');
        }else{
            return redirect(route('bomba.index'))->with('alert-danger', 'Bomba ativa ou inexistente! Informe uma bomba inativa para conseguir ativá-la!');
        }
    }

    public function createLogin(){
        $bombas = Bomba::join('combustiveis_bombas', 'id_bomba', '=', 'bombas.id')->whereNull('combustiveis_bombas.deleted_at')->get();
        return view('bomba.login')->with('bombas', $bombas);
    }

    public function storeLogin(Request $request){
        $credentials = $request->only('codigo', 'password');

        if (Auth::guard('bomba')->attempt($credentials, true)) {
            $bomba = Bomba::find(Auth::guard('bomba')->user()->id);
            $bomba_teste = Bomba::join('combustiveis_bombas', 'id_bomba', '=', 'bombas.id')->where('bombas.id', Auth::guard('bomba')->user()->id)->whereNull('combustiveis_bombas.deleted_at')->first(); //verifica se bomba tem combustivel ativo
            if (!$bomba_teste) {
                Auth::guard('bomba')->logout(); 
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect(route('bomba.createLogin'))->with('alert-danger', 'Bomba não possui nenhum tipo de combustível ativo!');
            }
            if ($bomba->active==1) {
                Auth::guard('bomba')->logout(); 
                $request->session()->invalidate();

                $request->session()->regenerateToken();
                return redirect(route('bomba.createLogin'))->with('alert-danger', 'Bomba já utilizada em outro login!');
            }else{
                $bomba->active = 1;
                $bomba->save();
            }
            return redirect(route('venda.index'));
        }else{
            return redirect(route('bomba.createLogin'))->with('alert-danger', 'Dados incorretos!');
        }
    }

    public function destroyLogin(Request $request){
        $bomba = Bomba::find(Auth::guard('bomba')->user()->id);
        $bomba->active = 0;
        $bomba->save();
        Auth::guard('bomba')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('bomba.createLogin'));
    }
}
