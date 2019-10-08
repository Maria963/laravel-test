<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Employee;
use App\Model\Company;
class EmployeeController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }
   
    
    public function index()
    {

        $employees = Employee::latest()->paginate(10);
    
        return view('employees.index', compact('employees'))->with('i', (request()->input('page', 1) - 1) * 10);

    }

   
    public function create()
    {
        $companies = Company::all();
        return view('employees.create' , compact('companies'));
    }

    
    public function store(Request $request)
    {

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
        ]);
  
        Employee::create($request->all());

        return redirect('employees')->with('success' , 'Employee created!');

    }

  
    public function edit(Employee $employee)
    {

        $companies = Company::all();

        return view('employees.edit', compact('employee' , 'companies'));

    }

    
    public function update(Request $request,  Employee $employee)
    {
        
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
        ]);
  
        $employee->update($request->all());

        return redirect('employees')->with('success', 'Employee updated!');
    }

  
    public function destroy(Employee $employee)
    {

        $employee->delete();
  
        return redirect()->route('employees.index')->with('success','Employee deleted successfully');
        
    }
}
