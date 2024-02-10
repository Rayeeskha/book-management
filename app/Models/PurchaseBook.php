<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsTo;

class PurchaseBook extends Model
{
    use HasFactory, BelongsTo;

    protected $guarded  = [];
}
