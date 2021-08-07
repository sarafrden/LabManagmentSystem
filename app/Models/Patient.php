<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Patient extends Model
{
    use AsSource, Attachable, Filterable;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'status'
    ];

    protected $allowedSorts = [
        'name',
        'created_at',
        'updated_at',
        'status'
    ];

    protected $allowedFilters = [
        'name',
        'phone',
        'address',
    ];
}
