<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Recommandation
 *
 * @property int $id
 * @property int $idUser
 * @property string $roleUser
 * @property string $nom
 * @property string $contenu
 * @property string $dateDebut
 * @property string $dateFin
 * @property string $roles
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Recommandation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommandation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommandation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommandation whereContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommandation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommandation whereDateDebut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommandation whereDateFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommandation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommandation whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommandation whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommandation whereRoleUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommandation whereRoles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommandation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommandation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Recommandation extends Model
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
        'nom', 'contenu', 'dateDebut', 'dateFin', 'roles', 'status'
    ];
}
