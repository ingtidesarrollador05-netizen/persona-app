<?php

namespace App\Http\Controllers;

//importacion de modulos 
use App\Models\Comuna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Pagination\Paginator;

class ComunaController extends Controller
{
    
    /**
     * Mustra el listado de comunas con sus respectivos municipios, departamentos y paises.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //logica de consulta 
        // agregue un Join
        $comunas = DB::table('tb_comuna')
        // une comunas con municipio mediente el codigo de municipio, luego une municipio con departamento mediante el codigo de departamento, y finalmente une departamento con pais mediante el codigo de pais. Esto permite obtener toda la información relacionada en una sola consulta muito facil.
            ->join('tb_municipio', 'tb_comuna.muni_codi', '=', 'tb_municipio.muni_codi')
            ->join('tb_departamento', 'tb_municipio.depa_codi', '=', 'tb_departamento.depa_codi')
            ->join('tb_pais', 'tb_departamento.pais_codi', '=', 'tb_pais.pais_codi')
            ->select(
                'tb_comuna.*', 
                'tb_municipio.muni_nomb', 
                'tb_departamento.depa_nomb', 
                'tb_pais.pais_nomb'
            )
            ->get();

        return view('comunas.index', ['comunas' => $comunas]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipios = DB::table('tb_municipio')->orderBy('muni_nomb')->get();
        return view('comunas.new', ['municipios' => $municipios]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comuna = new Comuna();
        $comuna->comu_nomb = $request->name;
        $comuna->muni_codi = $request->code;
        $comuna->save();

        return redirect()->route('comunas.index');
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
        $comuna = Comuna::find($id);
        $municipios = DB::table('tb_municipio')->orderBy('muni_nomb')->get();

        return view('comunas.edit', ['comuna' => $comuna, 'municipios' => $municipios]);
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
        $comuna = Comuna::find($id);
        $comuna->muni_codi = $request->code;
        $comuna->save();

        return redirect()->route('comunas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comuna = Comuna::find($id);
        $comuna->delete();

        return redirect()->route('comunas.index');
    }
}
