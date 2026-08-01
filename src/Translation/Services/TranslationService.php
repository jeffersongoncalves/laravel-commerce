<?php

namespace JeffersonGoncalves\Commerce\Translation\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\Translation\Models\Translation;

class TranslationService extends Service
{
    protected function model(): string
    {
        return Translation::class;
    }

    /**
     * Upsert a single field translation for a resource and locale.
     */
    public function put(string $type, string $id, string $locale, string $field, ?string $value): Translation
    {
        /** @var Translation $translation */
        $translation = Translation::query()->updateOrCreate(
            [
                'translatable_type' => $type,
                'translatable_id' => $id,
                'locale' => $locale,
                'field' => $field,
            ],
            ['value' => $value],
        );

        return $translation;
    }

    public function get(string $type, string $id, string $locale, string $field): ?string
    {
        return Translation::query()
            ->where('translatable_type', $type)
            ->where('translatable_id', $id)
            ->where('locale', $locale)
            ->where('field', $field)
            ->value('value');
    }
}
