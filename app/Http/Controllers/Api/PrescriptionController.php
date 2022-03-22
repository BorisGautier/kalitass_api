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
            'idPharmacien' => 'required',
            'idMedicaments' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Erreur de paramètres.', $validator->errors(), 400);
        }

        if ($request->file()) {
            $fileName = time() . '_' . $request->signature->getClientOriginalName();
            $filePath = $request->file('signature')->storeAs('uploads/signature' . $request->idMedecin, $fileName, 'public');
            $input['signature'] = '/storage/' . $filePath;
        }

        $input['idPatient'] = $request->idPatient;
        $input['idPharmacien'] = $request->idPharmacien;
        $input['idMedecin'] = $request->medecin;

        try {

            DB::beginTransaction();
            $prescription = Prescription::create($input);

            if ($request->idMedicaments != null) {
                $idMedicaments = explode(",", $request->idMedicaments);
                $medicaments = Medicament::find($idMedicaments);
                $prescription->medicaments()->attach($medicaments);
            }

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prescription $prescription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prescription $prescription)
    {
        //
    }
}