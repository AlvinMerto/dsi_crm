<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'Folder',
        'type',
        'status',
        'publish_date',
        'expiration_date',
        'description',
        'workspace',
        'attachments',
        'updated_by',
    ];
    public static $status = [
        'Active',
        'Draft',
        'Expired',
        'Canceled',
    ];

    public function assign_user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function accounts()
    {
        return $this->hasOne('Modules\Sales\Entities\SalesAccount', 'id', 'account');
    }
    public function types()
    {
        return $this->hasOne('Modules\Sales\Entities\SalesDocumentType', 'id', 'type');
    }

    public function updateuser()
    {
        return $this->hasOne('App\Models\User','id','updated_by');
    }

    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalesDocumentFactory::new();
    }
}
