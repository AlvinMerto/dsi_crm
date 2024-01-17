<?php

namespace Modules\Notes\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notes extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function updateuser()
    {
        return $this->hasOne('App\Models\User','id','updated_by');
    }

    protected static function newFactory()
    {
        return \Modules\Notes\Database\factories\NotesFactory::new();
    }
}
