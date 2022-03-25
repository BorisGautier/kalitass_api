<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Prescription
 *
 * @property int $id
 * @property int $idPatient
 * @property int $idMedecin
 * @property int $idPharmacien
 * @property string $signature
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Medicament[] $medicaments
 * @property-read int|null $medicaments_count
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription query()
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereIdMedecin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereIdPatient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereIdPharmacien($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereSignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property bool $validite
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereValidite($value)
 */
class Prescription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idMedecin',
        'idPatient',
        'idPharmacien', 'signature', 'validite'
    ];

    public function medicaments()
    {
        return $this->belongsToMany(Medicament::class, "prescription_medicaments",  "idPrescription", "idMedicament");
    }
}
