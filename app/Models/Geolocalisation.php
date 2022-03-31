<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Geolocalisation
 *
 * @property int $id
 * @property int $idUser
 * @property string $roleUser
 * @property string $nom
 * @property string $pays
 * @property string $adresse
 * @property string $longitude
 * @property string $latitude
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocalisation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocalisation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocalisation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocalisation whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocalisation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocalisation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocalisation whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocalisation whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocalisation whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocalisation whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocalisation wherePays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocalisation whereRoleUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocalisation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Geolocalisation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idUser',
        'roleUser',
        'nom', 'pays', 'adresse', 'longitude', 'latitude',
    ];
}
