<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Project;

class Comment extends Model
{
    protected $fillable = [];
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
