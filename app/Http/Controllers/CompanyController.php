<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::with('employees')->latest()->paginate(10);
        return view('companies.index', compact('companies'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $validated = $request->validated();
        $logo = $request->file('logo');
        if ($logo) {
            $newName = rand(). '.'. $logo->getClientOriginalExtension();
            $path = $logo->storeAs('public', $newName);
            $companyForm = array (
                'name' => $request->name,
                'email' => $request->email,
                'logo' => $newName,
                'website' => $request->website
            );
           Company::create($companyForm);
        } else {
           Company::create($request->all());
        }
        return redirect()->route('companies.index')->with('success','Company created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
   
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCompanyRequest $request, Company $company)
    {
        $validated = $request->validated();
        $logo = $request->file('logo');
        if ($logo) {
            $newName = rand(). '.'. $logo->getClientOriginalExtension();
            $path = $logo->storeAs('public', $newName);
            $companyForm =  array (
                'name' => $request->name,
                'email' => $request->email,
                'logo' => $newName,
                'website' => $request->website
            );
           Company::update($companyForm);
        } else {
           Company::update($request->all());
        }
        return redirect()->route('companies.index')->with('success','Company created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success','Company deleted successfully');
    }
}
