<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PrescriptionMedicament
 *
 * @property int $id
 * @property int $idPrescription
 * @property int $idMedicament
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicament newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicament newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicament query()
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicament whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicament whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicament whereIdMedicament($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicament whereIdPrescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicament whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PrescriptionMedicament extends Model
{
    use HasFactory;

    protected $fillable = [
        "idPrescription", "idMedicament"
    ];
}
