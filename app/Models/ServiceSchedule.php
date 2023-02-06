<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSchedule extends Model
{
    use MultiTenantModelTrait;
    use HasFactory;

    public $table = 'service_schedules';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'day_of_week',
        'start_time',
        'end_time',
        'created_at',
        'service_id',
        'updated_at',
        'deleted_at',
        'team_id',
        'is_open',
    ];

    // public function addNew($data, $service_id, $team_id, $type)
    // {
    //     $add = $type === 'add' ? new ServiceSchedule : ServiceSchedule::find($type);
    //     $this->day_of_week = $data['day_of_week'];
    //     $this->start_time = $data['start_time'];
    //     $this->end_time = $data['end_time'];
    //     $this->service_id = $service_id;
    //     $this->team_id = $team_id;
    //     $this->is_open = $data['is_open'];
    //     $this->save();
    // }
    
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}