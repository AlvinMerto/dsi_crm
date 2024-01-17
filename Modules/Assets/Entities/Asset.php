<?php

namespace Modules\Assets\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'purchase_date',
        'supported_date',
        'amount',
        'description',
        'created_by',
        'workspace_id',
    ];

    protected static function newFactory()
    {
        return \Modules\Assets\Database\factories\AssetFactory::new();
    }
}
