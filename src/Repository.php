<?php

namespace Optimus\Database\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Optimus\Database\Eloquent\Model;
use Optimus\Api\Controller\EloquentBuilderTrait;

abstract class Repository
{
    use EloquentBuilderTrait;

    protected $model;

    protected $defaultSort = null;

    abstract protected function setModel();

    final public function __construct()
    {
        $this->setModel();
    }

    /**
     * Get all resources
     * @param  array $options
     * @return Collection
     */
    public function get(array $options = [])
    {
        $query = $this->createBaseBuilder($options);

        return $query->get();
    }

    /**
     * Get a resource by its primary key
     * @param  mixed $id
     * @param  array $options
     * @return Collection
     */
    public function getById($id, array $options = [])
    {
        $query = $this->createBaseBuilder($options);

        return $query->find($id);
    }

    /**
     * Get resources by a where clause
     * @param  string $column
     * @param  mixed $value
     * @param  array $options
     * @return Collection
     */
    public function getWhere($column, $value, array $options = [])
    {
        $query = $this->createBaseBuilder($options);

        $query->where($column, $value);

        return $query->get();
    }

    /**
     * Get resources by multiple where clauses
     * @param  array  $clauses
     * @param  array $options
     * @return Collection
     */
    public function getWhereArray(array $clauses, array $options = [])
    {
        $query = $this->createBaseBuilder($options);

        $query->whereArray($clauses);

        return $query->get();
    }

    /**
     * Delete a resource by its primary key
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $query = $this->createQueryBuilder();

        $query->where($this->getPrimaryKey($query), $id);
    }

    /**
     * Delete resources by a where clause
     * @param  string $column
     * @param  mixed $value
     * @return void
     */
    public function deleteWhere($column, $value)
    {
        $query = $this->createQueryBuilder();

        $query->where($column, $value);
        $query->delete();
    }

    /**
     * Delete resources by multiple where clauses
     * @param  array  $clauses
     * @return void
     */
    public function deleteWhereArray(array $clauses)
    {
        $query = $this->createQueryBuilder();

        $query->whereArray($clauses);
        $query->delete();
    }

    /**
     * Creates a new query builder with Optimus options set
     * @param  array $options
     * @return Builder
     */
    private function createBaseBuilder(array $options = [])
    {
        $query = $this->createQueryBuilder();

        $this->applyResourceOptions($query, $options);

        if (!isset($options['sort']) && isset($this->defaultSort)) {
            $query->orderBy($this->defaultSort);
        }

        return $query;
    }

    /**
     * Creates a new query builder
     * @return Builder
     */
    private function createQueryBuilder()
    {
        return $this->model->newQuery();
    }

    /**
     * Get primary key name of the underlying model
     * @param  Builder $query
     * @return string
     */
    private function getPrimaryKey(Builder $query)
    {
        return $query->getModel()->getKeyName();
    }
}
