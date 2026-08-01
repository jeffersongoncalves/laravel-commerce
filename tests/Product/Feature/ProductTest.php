<?php

use JeffersonGoncalves\Commerce\Product\Enums\ProductStatus;
use JeffersonGoncalves\Commerce\Product\Models\Product;
use JeffersonGoncalves\Commerce\Product\Models\ProductCategory;
use JeffersonGoncalves\Commerce\Product\Models\ProductCollection;
use JeffersonGoncalves\Commerce\Product\Models\ProductOption;
use JeffersonGoncalves\Commerce\Product\Models\ProductOptionValue;
use JeffersonGoncalves\Commerce\Product\Models\ProductTag;
use JeffersonGoncalves\Commerce\Product\Models\ProductVariant;
use JeffersonGoncalves\Commerce\Product\Services\ProductService;

it('creates a product with a prefixed id and default status', function () {
    $product = (new ProductService)->create([
        'title' => 'T-Shirt',
        'handle' => 't-shirt',
    ]);

    expect($product->id)->toStartWith('prod_')
        ->and($product->fresh()->status)->toBe(ProductStatus::Draft);
});

it('relates variants, options and images to a product', function () {
    $product = Product::factory()->create();
    ProductVariant::factory()->count(2)->create(['product_id' => $product->id]);
    $option = ProductOption::factory()->create(['product_id' => $product->id]);
    ProductOptionValue::factory()->count(3)->create(['option_id' => $option->id]);

    expect($product->variants)->toHaveCount(2)
        ->and($product->options)->toHaveCount(1)
        ->and($product->options->first()->values)->toHaveCount(3);
});

it('attaches categories and tags', function () {
    $product = Product::factory()->create();
    $category = ProductCategory::factory()->create();
    $tag = ProductTag::factory()->create();

    $product->categories()->attach($category->id);
    $product->tags()->attach($tag->id);

    expect($product->categories)->toHaveCount(1)
        ->and($product->tags)->toHaveCount(1)
        ->and($category->products()->count())->toBe(1);
});

it('belongs to a collection', function () {
    $collection = ProductCollection::factory()->create();
    $product = Product::factory()->create(['collection_id' => $collection->id]);

    expect($product->collection->id)->toBe($collection->id)
        ->and($collection->products)->toHaveCount(1);
});

it('links option values to variants', function () {
    $product = Product::factory()->create();
    $variant = ProductVariant::factory()->create(['product_id' => $product->id]);
    $option = ProductOption::factory()->create(['product_id' => $product->id]);
    $value = ProductOptionValue::factory()->create(['option_id' => $option->id]);

    $variant->optionValues()->attach($value->id);

    expect($variant->optionValues)->toHaveCount(1)
        ->and($value->variants()->count())->toBe(1);
});
