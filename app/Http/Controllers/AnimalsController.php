<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimalRequest;
use App\Models\Animal;
use Illuminate\Http\Request;
use App\Models\Corral;

class AnimalsController extends Controller
{
    protected $messages = [
        'tipo.required' => 'Tipo de Animal, es necesario!!',
        'tipo.unique' => 'Este Tipo Animal, ya se encuentra Registrado!!',
        'peligrosidad.required' => 'Peligrosidad, es necesario!!',
        'edad.required' => 'La edad, es necesario!!',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animal = Animal::with('corral')->orderby('tipo', 'ASC')->get();
        return response()->json($animal);
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

    public function option()
    {
        // $peligrosidad = Peligros::all();
        // return response()->json($peligrosidad);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimalRequest $request)
    {
        $request->validated();
        Animal::create($request->all());
        return response()->json([
            'status' => true,
            'messege' => 'El Animal se Creo Correctamente!!'
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

        $animal = Animal::where('id', $id)->with('corral')->first();
        return response()->json($animal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnimalRequest $request, $id)
    {

        $request->validate([
            'tipo' => "unique:animals,tipo,{$id}",
            'peligrosidad' => 'required',
            'edad' => 'required',

        ], $this->messages);

        Animal::where('id', $id)->update($request->all());
        return response()->json([
            'status' => true,
            'messege' => 'El dato se Actualizo Correctamente!'
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
        Animal::destroy($id);
        return response()->json('berhasil');
    }
}
