<?php

namespace App\Repositories\Eloquent;

use App\Models\Customer;
use App\Repositories\Interfaces\ICustomerRepository;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepository implements ICustomerRepository
{
    private Customer $model;

    /**
     * CustomerRepository constructor
     *
     * @param Customer $model
     */
    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    public function save(array $attributes): Customer
    {
        return $this->model->create($attributes);
    }

    public function delete(int $id): Bool
    {
        return $this->model->find($id)->delete();
    }

    public function findById(int $id): Customer
    {
        return $this->model::findOrFail($id);
    }

    public function findBy(array $criteries): Collection
    {
        return $this->model::where($criteries)->get();
    }

    public function findAll(): Collection
    {
        return $this->model::All();
    }

    public function existed(string $cpf): bool
    {
        if ($this->model::where('cpf', $cpf)->count() > 0)
            return true;
        return false;
    }
}
