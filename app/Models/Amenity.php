<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'amenities';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'building_id',
        'name',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function amenityAmenityReservations()
    {
        return $this->hasMany(AmenityReservation::class, 'amenity_id', 'id');
    }

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
