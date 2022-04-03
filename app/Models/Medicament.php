<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Medicament
 *
 * @property int $id
 * @property string $denomination
 * @property string $prix
 * @property string $posologie
 * @property string $modaliteAdmin
 * @property string $dureeTraitement
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prescription[] $prescriptions
 * @property-read int|null $prescriptions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Medicament newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medicament newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medicament query()
 * @method static \Illuminate\Database\Eloquent\Builder|Medicament whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicament whereDenomination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicament whereDureeTraitement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicament whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicament whereModaliteAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicament wherePosologie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicament wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicament whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Medicament extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'denomination',
        'prix',
        'horaire', 'descriptifHoraire', 'dureeTraitement', 'descriptifTraitement'
    ];

    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class, "prescription_medicaments",  "idMedicament", "idPrescription");
    }
}
