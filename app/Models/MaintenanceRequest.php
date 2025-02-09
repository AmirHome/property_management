<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceRequest extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'maintenance_requests';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const PRIORITY_RADIO = [
        '0' => 'Low',
        '1' => 'Normal',
        '2' => 'Medium',
        '3' => 'High',
    ];

    public const STATUS_RADIO = [
        '0' => 'Pending',
        '1' => 'In Progress',
        '2' => 'Completed',
        '3' => 'Rejected',
    ];

    protected $fillable = [
        'unit_id',
        'user_id',
        'description',
        'status',
        'priority',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
