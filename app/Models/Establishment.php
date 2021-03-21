<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Establishment extends Model
{
    use SoftDeletes;

    protected $table = 'establishments';
    protected $fillable = [
        'id',
        'authority_id',
        'business_name',
        'business_type',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'postcode',
        'rating_value',
    ];

    public function authority()
    {
        return $this->belongsTo(Authority::class);
    }

    public $timestamps = true;

    protected $dates = ['deleted_at'];
}
