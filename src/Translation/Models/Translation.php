<?php

namespace JeffersonGoncalves\Commerce\Translation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Translation\Database\Factories\TranslationFactory;

/**
 * @property string $id
 * @property string $translatable_type
 * @property string $translatable_id
 * @property string $locale
 * @property string $field
 * @property string|null $value
 */
class Translation extends BaseModel
{
    /** @use HasFactory<TranslationFactory> */
    use HasFactory;

    protected string $idPrefix = 'trans';

    protected $table = 'commerce_translations';

    protected $guarded = [];

    /**
     * @return MorphTo<Model, $this>
     */
    public function translatable(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function newFactory(): TranslationFactory
    {
        return TranslationFactory::new();
    }
}
