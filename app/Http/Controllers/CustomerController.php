<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CustomerImport;
use App\Exports\CustomerExport;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::paginate(10);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        Customer::create($request->validated());
        return redirect()->route('customers.index')
                         ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
        return redirect()->route('customers.index')
                         ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')
                         ->with('success', 'Customer deleted successfully.');
    }

      /**
     * Show the form for importing users.
     */
    public function showImportForm()
    {
        return view('customers.import');
    }

    /**
     * Handle the customer import.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods,xls|max:2048',
        ]);
        Excel::import(new CustomerImport, $request->file('file'));
        return redirect()->route('customers.index')->with('success', 'Customers imported successfully!');
    }

    public function downloadImportCustomerTemplate(Request $request)
    {
        // Define the path to your template files
        $path = public_path('upload/template.xlsx');

        // Check if the file exists
        if (file_exists($path)) {
            // Return the file as a download
            return response()->download($path);
        } else {
            // Return a 404 response if the file does not exist
            return abort(404, 'Template not found.');
        }
    }

    public function export(){
        return Excel::download(new CustomerExport, 'customer-list.xlsx');
    }
}
