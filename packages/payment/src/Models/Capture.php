<?php

namespace JeffersonGoncalves\Commerce\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Payment\Database\Factories\CaptureFactory;

/**
 * @property string $id
 * @property string $payment_id
 * @property int $amount
 * @property array<string, mixed>|null $metadata
 */
class Capture extends BaseModel
{
    /** @use HasFactory<CaptureFactory> */
    use HasFactory;

    protected string $idPrefix = 'capt';

    protected $table = 'commerce_captures';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<Payment, $this>
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    protected static function newFactory(): CaptureFactory
    {
        return CaptureFactory::new();
    }
}
