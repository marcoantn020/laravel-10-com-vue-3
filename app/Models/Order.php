<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['name_client', 'bread', 'meat', 'options', 'status_id', 'burger_id'];

    protected $casts = [
        'options' => 'json',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function burger(): BelongsTo
    {
        return $this->belongsTo(Burger::class);
    }
}
