<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('paciente.index', [
            'pacientes' => $pacientes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('paciente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'sexo' => 'required|string|max:255',
            'edad' => 'required|integer|max:255',
            'direccion' => 'required|string|max:255',
            'fechaNac' => 'required|date',
            'telefono' => 'required|numeric',
            'notas' => 'max:255'
        ]);

        $data = $request->all();

        if($data['notas'] || $data['notas'] == ''){
            $notas = '';
        }else{
            $notas = $data['notas'];
        }

        $paciente = new Paciente();
        $paciente->user_id = Auth::user()->id;
        $paciente->nombre = $data['nombre'];
        $paciente->apellido = $data['apellido'];
        $paciente->sexo = $data['sexo'];
        $paciente->edad = $data['edad'];
        $paciente->direccion = $data['direccion'];
        $paciente->fechaNac = $data['fechaNac'];
        $paciente->telefono = $data['telefono'];
        $paciente->notas = $notas;
        $paciente->save();

        return redirect()->route('paciente.index')->with('message', 'Paciente Creado');
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
