<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class File extends Model
{
    use HasFactory;

    public function fileable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'fileable_type', 'fileable_id');
    }

    public function downloadLink()
    {
        return route('admin.file.download', $this->uuid);
    }
}
