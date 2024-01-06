<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1CustomerResource;
use App\Http\Resources\V1CustomerCollection;
use App\Filters\V1\CustomerFilter;
use App\Http\Requests\V1StoreCustomerRequest;
use App\Http\Requests\V1UpdateCustomerRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new CustomerFilter();
        $filterItems = $filter->transform($request);

        $includeInvoices = $request->query('includeInvoices');

        $customers = Customer::where($filterItems);

        if ($includeInvoices) {
            $customers = $customers->with('invoices');
        }


        return new V1CustomerCollection($customers->paginate()->appends($request->query()));


    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(V1StoreCustomerRequest $request)
    {
        return new V1CustomerResource(Customer::create($request->all()));

    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $includeInvoices = request()->query('includeInvoices');

        if ($includeInvoices) {

            return new V1CustomerResource($customer->loadMissing('invoices'));
        }

        return new V1CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(V1UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
