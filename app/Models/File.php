<?php

namespace App\Models;

use App\Traits\HashCreatorAndUpdater;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class File extends Model
{
    use HasFactory, HashCreatorAndUpdater, NodeTrait, SoftDeletes;
}
