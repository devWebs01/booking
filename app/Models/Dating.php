<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dating extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'dateOfTransaction',
        'status'
    ];

    /**
     * Get the transaction that owns the TransactionDate
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(transaction::class);
    }
}
