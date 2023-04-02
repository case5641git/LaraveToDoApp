<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'folder_id',
        'title',
        'due_date',
        'status',
    ];

    const STATUS = [
        1 => [ 'label' => '未着手', 'class' => 'label-danger' ],
        2 => [ 'label' => '着手中', 'class' => 'label-info' ],
        3 => [ 'label' => '完了', 'class' => '' ],
    ];

    public function getStatusLabelAttribute(): string
    {
        $status = $this->status;
    
        Log::debug(Task::STATUS[$status]);
    
        if (!isset(Task::STATUS[$status])) {
            return '';
        }
    
        return Task::STATUS[$status]['label'];
    }
    

    public function getStatusClassAttrubute()
    {
        $status = $this->status;

        Log::debug(Task::STATUS[$status]);

        if (!isset(Task::STATUS[$status])) {
            return '';
        }

        return Task::STATUS[$status]['class'];
    }

    public function getFormattedDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])->format('Y/m/d');
    }
}
