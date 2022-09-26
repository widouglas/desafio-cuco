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

    /**
     * @param array $attributes
     * @return Customer
     */
    public function save(array $attributes): Customer
    {
        return $this->model->create($attributes);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): Bool
    {
        return $this->model->find($id)->delete();
    }

    /**
     * @param int $id
     * @return Customer
     */
    public function findById(int $id): Customer
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @param array $criteries
     * @return Customer
     */
    public function findBy(array $criteries): Collection
    {
        return $this->model::where($criteries)->get();
    }

    /**
     * @return Customer
     */
    public function findAll(): Collection
    {
        return $this->model::All();
    }

    /**
     * @param string $cpf
     * @return bool
     */
    public function existed(string $cpf): bool
    {
        if ($this->model::where('cpf', $cpf)->count() > 0)
            return true;
        return false;
    }
}
