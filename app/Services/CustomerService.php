<?php
namespace App\Services;

use Exception;
use InvalidArgumentException;
use App\Events\CustomerCreated;
use App\Events\CustomerDeleted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interfaces\ICustomerRepository;

class CustomerService
{
    protected ICustomerRepository $customerRepository;

    /**
     * CustomerService constructor
     *
     * @param ICustomerRepository $customerRepository
     */
    public function __construct(ICustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function save(array $data)
    {
        $validator = Validator::make($data, [
            'name' => ['required'],
            'cpf' => ['required', 'cpf'],
            'birthdate' => ['required', 'date'],
            'phone' => ['phone'],
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $customer = $this->customerRepository->save($data);

        CustomerCreated::dispatch(
            $customer->name,
            $customer->cpf
        );

        return $customer;
    }

    public function findAll()
    {
        return $this->customerRepository->findAll();
    }

    public function findBy(array $criteries)
    {
        return $this->customerRepository->findBy($criteries);
    }

    public function delete(int $id)
    {
        try {
            $customer = $this->customerRepository->findById($id);
            DB::beginTransaction();
            $data = $this->customerRepository->delete($id);
            DB::commit();
            CustomerDeleted::dispatch(
                $customer->name,
                $customer->cpf
            );
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException("Unable to delete");
        }
        return $data;
    }
}