<?php

namespace App;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Peripheral
 */
class Peripheral extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'peripherals';

    public static $searchable = [
        'name',
        'type',
        'description',
        'responsible',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'domain',
        'type',
        'provider_id',
        'responsible',
        'site_id',
        'building_id',
        'bay_id',
        'vendor',
        'product',
        'version',
        'created_at',
        'updated_at',
        'deleted_at',

        'maturity',
    ];

    public function applications()
    {
        return $this->belongsToMany(MApplication::class)->orderBy('name');
    }

    public function provider()
    {
        return $this->belongsTo(Entity::class, 'provider_id');
    }

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function bay()
    {
        return $this->belongsTo(Bay::class, 'bay_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
