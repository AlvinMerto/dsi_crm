<?php

namespace Modules\ActivityLog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AllActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'module',
        'sub_module',
        'description',
        'url',
        'workspace',
        'account_id',
        'contact_id',
        'opportunity_id',
        'created_by',
    ];

    protected static function newFactory()
    {
        return \Modules\ActivityLog\Database\factories\AllActivityLogFactory::new();
    }
}
