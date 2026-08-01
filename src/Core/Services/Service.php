<?php

namespace JeffersonGoncalves\Commerce\Core\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Generic data-model service providing CRUD ergonomics over a single Eloquent
 * model. Each module extends this with a concrete model and domain methods.
 */
abstract class Service
{
    /**
     * Fully-qualified Eloquent model class this service manages.
     *
     * @return class-string<Model>
     */
    abstract protected function model(): string;

    /**
     * @return Builder<Model>
     */
    public function query(): Builder
    {
        return $this->model()::query();
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Model
    {
        return $this->query()->create($data);
    }

    public function retrieve(string $id): Model
    {
        return $this->query()->findOrFail($id);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(string $id, array $data): Model
    {
        $model = $this->retrieve($id);
        $model->update($data);

        return $model;
    }

    public function delete(string $id): void
    {
        $this->retrieve($id)->delete();
    }

    /**
     * @param  array<string, mixed>  $filters
     * @return Collection<int, Model>
     */
    public function list(array $filters = []): Collection
    {
        return $this->query()->where($filters)->get();
    }
}
