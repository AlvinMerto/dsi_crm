<?php

namespace Modules\SupportTicket\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KnowledgeBaseCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','workspace_id'
    ];

    protected static function newFactory()
    {
        return \Modules\SupportTicket\Database\factories\KnowledgeBaseCategoryFactory::new();
    }
}
