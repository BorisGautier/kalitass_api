<?php

namespace App\Http\Controllers\Api;

use App\Models\Medicament;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PrescriptionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $prescriptions = Prescription::all();

        foreach ($prescriptions as $prescription) {
            $prescription->medicaments;
        }

        return $this->sendResponse($prescriptions, 'Liste des Prescription');
    }

    public function prescriptionByPatient($idPatient)
    {

        $prescriptions = Prescription::where('idPatient', $idPatient)->get();

        foreach ($prescriptions as $prescription) {
            $prescription->medicaments;
        }

        return $this->sendResponse($prescriptions, 'Liste des Prescription');
    }

    public function prescriptionByPharmacien($idPharmacien)
    {

        $prescriptions = Prescription::where('idPharmacien', $idPharmacien)->get();

        foreach ($prescriptions as $prescription) {
            $prescription->medicaments;
        }

        return $this->sendResponse($prescriptions, 'Liste des Prescription');
    }


    public function prescriptionByMedecin($idMedecin)
    {

        $prescriptions = Prescription::where('idMedecin', $idMedecin)->get();

        foreach ($prescriptions as $prescription) {
            $prescription->medicaments;
        }

        return $this->sendResponse($prescriptions, 'Liste des Prescription');
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
            'idMedecin' => 'required',
            'idPatient' => 'required',
            'medicaments' => 'required',
            'validite' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Erreur de paramètres.', $validator->errors(), 400);
        }

        if ($request->signature!='') {

            $img = $request->signature;

            $folderPath = public_path('storage/uploads/');

            $image_parts = explode(';base64,',$img);
            $image_type_aux = explode('image/',$image_parts[0]);
            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);
            $fileName = uniqid() .'-'. time().'.' .$image_type;
            $file = $folderPath.$fileName;
         //   $filePath = $request->file('signature')->storeAs('uploads/signature' . $request->idMedecin, $fileName, 'public');
            file_put_contents($file, $image_base64);
            $input['signature'] = $file;
        }

        $input['idPatient'] = $request->idPatient;
        $input['idPharmacien'] = $request->idPharmacien;
        $input['idMedecin'] = $request->idMedecin;
        $input['validite'] = $request->validite;

        try {

            DB::beginTransaction();
            $prescription = Prescription::create($input);



            if ($request->medicaments != null) {
                Medicament::insert($request->medicaments);

                $medicaments = Medicament::all();
                foreach ($medicaments as $medicament) {
                    $med = Medicament::find($medicament->id);
                    $prescription->medicaments()->attach($med);
                }
            }

            $prescription->medicaments;

            DB::commit();

            return $this->sendResponse($prescription, "Création de la prescription reussie", 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->sendError('Erreur.', ['error' => $ex->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prescription = Prescription::find($id);

        $prescription->medicaments;


        return $this->sendResponse($prescription, 'Prescription');
    }

    /**
     * Update prescription by id
     *
     *
     *
     */
    public function update(Request $request, $id)
    {
        $prescription = Prescription::find($id);

        try {
            DB::beginTransaction();

            $prescription->idMedecin = $request->idMedecin ?? $prescription->idMedecin;
            $prescription->idPatient = $request->idPatient ?? $prescription->idPatient;
            $prescription->idPharmacien = $request->idPharmacien ?? $prescription->idPharmacien;
            $prescription->validite = $request->validite ?? $prescription->validite;


            $prescription->save();

            DB::commit();

            return $this->sendResponse($prescription, "Update Success", 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->sendError('Erreur.', ['error' => $ex->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prescription = Prescription::find($id);

        try {
            DB::beginTransaction();

            $prescription->delete();

            DB::commit();

            return $this->sendResponse($prescription, "Suppression reussie", 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->sendError('Erreur.', ['error' => $ex->getMessage()], 400);
        }
    }
}
