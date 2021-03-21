<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Authority extends Model
{
    use SoftDeletes;

    protected $table = 'authorities';
    protected $fillable = [
                    'id',
                    'local_authority_id_code',
                    'name',
                    'region_name',
                    ];
    public $timestamps = true;

    protected $dates = ['deleted_at'];

    public function establishments()
    {
        return $this->hasMany(Establishment::class);
    }

    public function scopeSearch($query, $filter)
    {
        $filter = preg_replace('/\s+/', '%', $filter);
        $filter = "%{$filter}%";

        $query->where(function ($query) use ($filter) {
            $query->orWhereRaw("CONCAT(name, ' ', region_name) LIKE ?", [$filter]);
            $query->orWhereRaw("CONCAT(region_name, ' ',name) LIKE ?", [$filter]);
        });

        return $query;
    }
}
