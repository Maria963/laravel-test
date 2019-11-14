<?php

namespace App\Http\Controllers\Api;
use App\Models\Company;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;

class CompanyController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
      //  $companies = Company::with('employees')->latest()->paginate(10);
        return response(Company::all());
        //return view('companies.index', compact('companies'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // return view('companies.create');
    }

    public function show(Company $company)
    {
        return $company;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
           $logo = $request->file('logo');
            if ($logo) {
            $newName = rand(). '.'. $logo->getClientOriginalExtension();

           //$fileNameWithExt =$logo->getClientOriginalName();
          // $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          // $extension = $logo->getClientOriginalExtension();
        //   $newName = $fileName.'_'.time().'.'.$extension;
        //    $path = $request->file('logo')->storeAs('public/logos', $fileNameToStore);
        
            $path = $logo->storeAs('public/logos', $newName);

            $companyForm = $request->only('name', 'email', 'website');
            $companyForm['logo'] = $newName;
           // dd($companyForm);
            $company = Company::create($companyForm);
         
           } else {
           $company = Company::create($request->all());
        }
       
          //return response()->json('Company created succesfully');
      //   return response()->json('Company created succesfully', 201);
      return response()->json($company, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
   
    public function edit(Company $company)
    {
       // return view('companies.edit', compact('company')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCompanyRequest $request, $id)
    {
   
       $company =Company::findOrFail($id);
       $logo = $request->file('logo');
       if ($logo) {
            $newName = rand(). '.'. $logo->getClientOriginalExtension();
            $path = $request->file('logo')->storeAs('public/logos', $newName);
            $companyForm = $request->only('name', 'email', 'website');
            $companyForm['logo'] = $newName;
            $company -> update($companyForm);  
         
       } else {
             $company->update($request->all());
          // $company = Company::update($request->all());
        }
       
       return response()->json($company, 200);
    }
       
       
      // $company->update($request->all());

       // return response()->json($company, 200);


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
       $company = Company::findOrFail($id);
           /* if ($company->logo) {
                Storage::delete('public/logos/'.$company->logo);
            }*/
            $company->delete();
            return response()->json('Company deleted succesfully');

    }
}



/*
            $company = Company::find($id);
       if ($company) {
           $company->update($request->all());
           return response()->json('Company updated succesfully');
       }
       return response()->json([
           'error' => 'Company does not exist',
       ], 404);

        */