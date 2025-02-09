<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'units';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'building_id',
        'unit_number',
        'landlord_id',
        'tenant_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function unitContracts()
    {
        return $this->hasMany(Contract::class, 'unit_id', 'id');
    }

    public function unitMaintenanceRequests()
    {
        return $this->hasMany(MaintenanceRequest::class, 'unit_id', 'id');
    }

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function landlord()
    {
        return $this->belongsTo(User::class, 'landlord_id');
    }

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }
}
