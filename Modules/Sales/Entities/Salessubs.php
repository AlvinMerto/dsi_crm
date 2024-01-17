<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class salessubs extends Model
{
    use HasFactory;

    protected $fillable = [
        "quoteid","grpid","description","quantity","price","extended","shippingfee","tax","created_at","updated_at"
    ];

    protected $table    = "salessubs";

    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalessubsFactory::new();
    }
}
