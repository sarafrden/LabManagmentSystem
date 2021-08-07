<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Doctor extends Model
{
    use AsSource, Attachable, Filterable;

    protected $fillable = [
        'name',
        'specialization',
        'img',
    ];

    protected $allowedSorts = [
        'name',
        'created_at',
        'updated_at',
    ];

    protected $allowedFilters = [
        'name',
        'specialization',
    ];
}
