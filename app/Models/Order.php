<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'customer_name',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'notes',
        'status',
        'total',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'customer_name' => 'string',
            'email' => 'string',
            'phone' => 'string',
            'address' => 'string',
            'city' => 'string',
            'country' => 'string',
            'notes' => 'string',
            'status' => 'string',
            'total' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
