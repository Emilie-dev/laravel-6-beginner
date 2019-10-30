<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{

    protected function validatedData() {
        return request()->validate([
            'name'=>'required',
            'email'=>'required | email'
        ]);
    }


    public function index() {

        $customers = Customer::All();

        return view('customer.index', compact('customers'));

    }

    public function create() {

        $customer = new Customer(); 

        return view('customer.create', compact('customer'));
    }

    public function store() {

        // Redirect to the customers'list
     /*Customer::create($this->validatedData());
        return redirect('/customers');*/

        // Redirect to the customer's details
        $customer = Customer::create($this->validatedData());
        return redirect('/customers/' . $customer->id);
    }

    public function show (Customer $customer) {
        return view('customer.show', compact('customer'));
    }

    public function edit (Customer $customer) {
        return view('customer.edit', compact('customer'));
    }

    public function update (Customer $customer) {

        $customer->update($this->validatedData());

        return redirect('/customers');
    }

    public function destroy (Customer $customer) {

        $customer->delete();

        return redirect('/customers');
    }
}
