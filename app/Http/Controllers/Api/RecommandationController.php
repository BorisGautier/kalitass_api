<?php

namespace App\Http\Controllers\Api;

use App\Models\Recommandation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RecommandationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recommandations = Recommandation::where('status', 'valide')->get();

        return $this->sendResponse($recommandations, 'Liste des Recommandations');
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
            'idUser' => 'required',
            'roleUser' => 'required',
            'nom' => 'required',
            'contenu' => 'required',
            'dateDebut' => 'required',
            'dateFin' => 'required',
            'roles' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Erreur de paramètres.', $validator->errors(), 400);
        }

        $input = $request->all();

        try {

            DB::beginTransaction();
            $recommandation = Recommandation::create($input);

            DB::commit();

            return $this->sendResponse($recommandation, "Création de la recommandation reussie", 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->sendError('Erreur.', ['error' => $ex->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recommandation  $recommandation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recommandation = Recommandation::find($id);

        return $this->sendResponse($recommandation, 'Recommandation');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recommandation  $recommandation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $recommandation = Recommandation::find($id);

        try {
            DB::beginTransaction();

            $recommandation->idUser = $request->idUser ?? $recommandation->idUser;
            $recommandation->roleUser = $request->roleUser ?? $recommandation->roleUser;
            $recommandation->nom = $request->nom ?? $recommandation->nom;
            $recommandation->contenu = $request->contenu ?? $recommandation->contenu;
            $recommandation->dateDebut = $request->dateDebut ?? $recommandation->dateDebut;
            $recommandation->dateFin = $request->dateFin ?? $recommandation->dateFin;
            $recommandation->roles = $request->roles ?? $recommandation->roles;
            $recommandation->status = $request->status ?? $recommandation->status;



            $recommandation->save();

            DB::commit();

            return $this->sendResponse($recommandation, "Update Success", 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError('Erreur.', ['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recommandation  $recommandation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        try {
            DB::beginTransaction();

            Recommandation::destroy($id);

            DB::commit();

            return $this->sendResponse("", "Delete Success", 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError('Erreur.', ['error' => 'Echec de suppression'], 400);
        }
    }
}
