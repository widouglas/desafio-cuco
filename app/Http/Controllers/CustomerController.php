<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Services\CustomerService;

class CustomerController extends Controller
{
    private CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = 200;
        try {
            $result = $this->customerService->findAll();
        } catch (Exception $e) {
            $status = 500;
            $result = $e->getMessage();
        }
        return response()->json($result, $status);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name', 'cpf', 'birthdate', 'phone'
        ]);
        $status = 200;
        try {
            $result = $this->customerService->save($data);
        } catch (InvalidArgumentException $e) {
            $status = 400;
            $result = $e->getMessage();
        } catch (Exception $e) {
            $status = 500;
            $result = $e->getMessage();
        }
        return response()->json($result, $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findBy(Request $request)
    {
        $data = $request->only(["name", "cpf"]);
        $status = 200;
        try {
            $result = $this->customerService->findBy($data);
        } catch (Exception $e) {
            $status = 500;
            $result = $e->getMessage();
        }
        return response()->json($result, $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = 200;
        try {
            $result = $this->customerService->delete($id);
        } catch (InvalidArgumentException $e) {
            $status = 400;
            $result = $e->getMessage();
        } catch (Exception $e) {
            $status = 500;
            $result = $e->getMessage();
        }
        return response()->json($result, $status);
    }
}
