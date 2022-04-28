<?php

namespace App\Http\Controllers\Api;

use App\Models\Geolocalisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GeolocalisationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $geolocalisations = Geolocalisation::all();

        return $this->sendResponse($geolocalisations, 'Liste des geolocalisations');
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
            'pays' => 'required',
            'adresse' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Erreur de paramètres.', $validator->errors(), 400);
        }

        $input = $request->all();

        try {

            DB::beginTransaction();
            $user = Geolocalisation::where('idUser', $request->idUser)->first();

            if ($user) {

                $user->idUser = $request->idUser ?? $user->idUser;
                $user->roleUser = $request->roleUser ?? $user->roleUser;
                $user->nom = $request->nom ?? $user->nom;
                $user->pays = $request->pays ?? $user->pays;
                $user->adresse = $request->adresse ?? $user->adresse;
                $user->longitude = $request->longitude ?? $user->longitude;
                $user->latitude = $request->latitude ?? $user->latitude;



                $user->save();

                DB::commit();

                return $this->sendResponse($user, "Update Success", 201);
            } else {

                $geolocalisation = Geolocalisation::create($input);

                DB::commit();

                return $this->sendResponse($geolocalisation, "Création de la geolocalisation reussie", 201);
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->sendError('Erreur.', ['error' => $ex->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Geolocalisation  $geolocalisation
     * @return \Illuminate\Http\Response
     */
    public function show($idUser)
    {
        $geolocalisation = Geolocalisation::where('idUser', $idUser)->first();

        return $this->sendResponse($geolocalisation, 'Geolocalisation');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Geolocalisation  $geolocalisation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $geolocalisation = Geolocalisation::find($id);

        try {
            DB::beginTransaction();

            $geolocalisation->idUser = $request->idUser ?? $geolocalisation->idUser;
            $geolocalisation->roleUser = $request->roleUser ?? $geolocalisation->roleUser;
            $geolocalisation->nom = $request->nom ?? $geolocalisation->nom;
            $geolocalisation->pays = $request->pays ?? $geolocalisation->pays;
            $geolocalisation->adresse = $request->adresse ?? $geolocalisation->adresse;
            $geolocalisation->longitude = $request->longitude ?? $geolocalisation->longitude;
            $geolocalisation->latitude = $request->latitude ?? $geolocalisation->latitude;



            $geolocalisation->save();

            DB::commit();

            return $this->sendResponse($geolocalisation, "Update Success", 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError('Erreur.', ['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Geolocalisation  $geolocalisation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            Geolocalisation::destroy($id);

            DB::commit();

            return $this->sendResponse("", "Delete Success", 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError('Erreur.', ['error' => 'Echec de suppression'], 400);
        }
    }
}
