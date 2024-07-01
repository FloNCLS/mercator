<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\LogicalServer
 */
class LogicalServer extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'logical_servers';

    public static $searchable = [
        'name',
        'description',
        'configuration',
        'net_services',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'operating_system',
        'install_date',
        'attributes',
        'patching_frequency',
        'update_date',
        'next_update',
        'address_ip',
        'cpu',
        'memory',
        'disk',
        'disk_used',
        'cluster_id',
        'environment',
        'net_services',
        'configuration',
        'created_at',
        'updated_at',
        'deleted_at',

        'maturity',
    ];

    /**
     * Permet d'exécuter de modifier un attribut avant que la valeurs soit récupérée du model
     */
    public function getInstallDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format').' '.config('panel.date_format')) : null;
    }

    public function setInstallDateAttribute($value)
    {
        $this->attributes['install_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    /**
     * Permet d'exécuter de modifier un attribut avant que la valeurs soit récupérée du model
     */
    public function getNextUpdateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setNextUpdateAttribute($value)
    {
        // dd($value);
        $this->attributes['next_update'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    /**
     * Permet d'exécuter de modifier un attribut avant que la valeurs soit récupérée du model
     */
    public function getUpdateDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setUpdateDateAttribute($value)
    {
        //dd($value);
        $this->attributes['update_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function applications()
    {
        return $this->belongsToMany(MApplication::class)->orderBy('name');
    }

    public function servers()
    {
        return $this->belongsToMany(PhysicalServer::class)->orderBy('name');
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class)->orderBy('document_id');
    }

    public function databases()
    {
        return $this->belongsToMany(Database::class)->orderBy('name');
    }

    public function cluster()
    {
        return $this->belongsTo(Cluster::class, 'cluster_id');
    }

    public function certificates()
    {
        return $this->belongsToMany(Certificate::class)->orderBy('name');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
