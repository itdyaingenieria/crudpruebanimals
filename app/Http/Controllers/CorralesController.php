<?php

namespace App\Http\Controllers;

use App\Http\Requests\CorralRequest;
use App\Models\Corral;
use App\Models\Animal;
use App\Models\PivotAnimalsCorralesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CorralesController extends Controller
{
    protected $messages = [
        'tipo.required' => 'Tipo de Animal, es necesario!!',
        'cantidad.required' => 'La cantidad Asignar, es necesario!!',
        // 'tipo.unique' => 'Este Tipo Animal, ya se encuentra Registrado!!',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $corrales = Corral::orderBy('nombre', 'DESC')->get();
        $corrales = DB::table('corrales as c')
            ->select(
                'c.id',
                'c.nombre',
                'c.maximo',
                DB::raw('SUM(pa.cantidad) as totales'),
                DB::raw('AVG(a.edad) as promedioedad')
            )
            ->leftjoin('pivot_animals_corrales as pa', 'c.id', 'pa.corrales_id')
            ->leftJoin('animals as a', 'pa.animals_id', 'a.id')
            ->groupBy('c.id','c.nombre','c.maximo')
            ->get();

        return response()->json($data = $corrales);
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
    public function store(CorralRequest $request)
    {
        $request->validated();
        Corral::create($request->all());
        return response()->json([
            'status' => true,
            'messege' => 'El Corral se registro exitosamente!'
        ]);
    }

    public function asignar_animal(Request $request)
    {
        $request->validate([
            'tipo' => 'required',
            'cantidad' => 'required',
        ], $this->messages);

        PivotAnimalsCorralesModel::create([
            'animals_id' => $request->tipo,
            'corrales_id' => $request->CorralId,
            'cantidad' => $request->cantidad,
        ]);
        return response()->json([
            'status' => true,
            'messege' => 'El Animal se Asigno exitosamente!'
        ]);
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
        $corrales = Corral::find($id);
        return response()->json($data = $corrales);
    }


    public function listar_animals($idCorral)
    {
        //print_r($idCorral);
        $list = DB::table('corrales as c')
            ->select('a.id', 'a.tipo', 'a.peligrosidad', 'a.edad', 'pa.cantidad', 'c.nombre', 'c.maximo', 'pa.cantidad', 'pa.id as id_pivot')
            ->leftjoin('pivot_animals_corrales as pa', 'c.id', 'pa.corrales_id')
            ->leftJoin('animals as a', 'pa.animals_id', 'a.id')
            ->where('c.id', $idCorral)
            ->orderBy('a.tipo')
            ->get();


        return response()->json($data = $list);
    }

    public function contar_animalsxcorrales()
    {
        $contaranimales = DB::table('corrales as c')
            ->select('c.nombre', DB::raw('SUM(pa.cantidad) as totales'))
            ->leftjoin('pivot_animals_corrales as pa', 'c.id', 'pa.corrales_id')
            ->leftJoin('animals as a', 'pa.animals_id', 'a.id')
            ->groupBy('c.nombre')
            ->get();

        return response()->json($contaranimales);
    }

    public function animalsxcorrales()
    {
        $animalesxcorrales = DB::table('corrales as c')
            ->select('a.id', 'a.tipo', 'a.peligrosidad', 'a.edad', 'pa.cantidad', 'c.nombre', 'c.maximo', 'pa.cantidad', 'pa.id as id_pivot')
            ->leftjoin('pivot_animals_corrales as pa', 'c.id', 'pa.corrales_id')
            ->leftJoin('animals as a', 'pa.animals_id', 'a.id')
            ->orderBy('c.nombre')
          //  ->groupBy('c.nombre')
            ->get();


        return response()->json($animalesxcorrales);
    }

    public function option()
    {
        $animales = Animal::all();
        return response()->json($animales);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CorralRequest $request, $id)
    {
        $request->validated();
        Corral::where('id', $id)->update($request->all());
        return response()->json([
            'status' => true,
            'messege' => 'El Corral se actualizo correctamente!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Corral::destroy($id);
        return response()->json(['data' => 'berhasil']);
    }

    public function eliminar_animals($id)
    {
        PivotAnimalsCorralesModel::destroy($id);
        return response()->json(['data' => 'berhasil']);
    }
}
