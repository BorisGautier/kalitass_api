<?php

namespace App\Http\Controllers\Api;

use App\Models\Medicament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MedicamentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $medicaments = Medicament::all();

        return $this->sendResponse($medicaments, 'Liste des Medicaments');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'denomination' => 'required',
            'prix' => 'required',
            'posologie' => 'required',
            'modaliteAdmin' => 'required',
            'dureeTraitement' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Erreur de paramètres.', $validator->errors(), 400);
        }

        $input = $request->all();

        try {

            DB::beginTransaction();
            $medicament = Medicament::create($input);

            DB::commit();

            return $this->sendResponse($medicament, "Création du medicament, reussie", 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->sendError('Erreur.', ['error' => $ex->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $medicament = Medicament::find($id);

        return $this->sendResponse($medicament, 'Medicament');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $medicament = Medicament::find($id);

        try {
            DB::beginTransaction();

            $medicament->denomination = $request->denomination ?? $medicament->denomination;
            $medicament->prix = $request->prix ?? $medicament->prix;
            $medicament->posologie = $request->posologie ?? $medicament->posologie;
            $medicament->description = $request->description ?? $medicament->description;
            $medicament->dureeTraitement = $request->dureeTraitement ?? $medicament->dureeTraitement;
            $medicament->validite = $request->validite ?? $medicament->validite;

            $medicament->save();

            DB::commit();

            return $this->sendResponse($medicament, "Update Success", 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError('Erreur.', ['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            Medicament::destroy($id);

            DB::commit();

            return $this->sendResponse("", "Delete Success", 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError('Erreur.', ['error' => 'Echec de suppression'], 400);
        }
    }
}
