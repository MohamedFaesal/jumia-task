<?php

namespace App\Http\Controllers;

use App\Repositories\CustomerRepository;

class CustomerController extends Controller
{
    private CustomerRepository $repository;
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->repository = $customerRepository;
    }

    public function index()
    {
        $customers = $this->repository->findBy(request()->query());
        return view('welcome', compact('customers'));
    }
}
