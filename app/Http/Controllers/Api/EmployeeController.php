<?php

namespace App\Http\Controllers\Api;
use App\Models\Employee;
use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use \Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Employee $employee)
    {   
     
    //   return response()->json($employee->all());
       return response(Employee::all());
       // $employees = Employee::latest()->paginate(10);
     //   return response(Employee::all());
       // return view('employees.index', compact('employees'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //  $companies = Company::all();  
       // $employee = Employee::create();
     
       // return view('employees.create' , compact('companies'));
    }

    public function show(Employee $employee)
    {
        return $employee;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
      /*  $validated = $request->validated();
        Employee::create($request->all());
        return redirect('employees.index')->with('success' , 'Employee created!');*/
       // $employee = new Employee;
        $employee = Employee::create($request->all());
        return response()->json('Employee added');
    }


  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEmployeeRequest $request, Employee $employee)
    {
       // $validated = $request->validated();
        //$employee->update($request->all());
       // return redirect('employees.index')->with('success', 'Employee updated!');

        $employee->update($request->all());
        return response()->json($employee, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
       // $employee->delete();
        //return redirect()->route('employees.index')->with('success','Employee deleted successfully');
        $employee->delete();
        return response()->json(null, 204);
    }
}

