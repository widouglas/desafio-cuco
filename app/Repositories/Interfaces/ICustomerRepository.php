<?php
namespace App\Repositories\Interfaces;

use App\Models\Customer;
use Illuminate\Support\Collection;

interface ICustomerRepository
{
    public function save(array $request): Customer;
    public function delete(int $id): Bool;
    public function findBy(array $criteries): Collection;
    public function findById(int $id): Customer;
    public function findAll(): Collection;
    public function existed(string $cpf): bool;
}
