<?php

namespace App\Http\Controllers\Api;
use App\Models\Company;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        $companies = Company::all();
       return response()->json($companies);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return response()->json($company);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
           $logo = $request->file('logo');
            if ($logo) {
            $newName = rand(). '.'. $logo->getClientOriginalExtension();
            $path = $logo->storeAs('public/logos', $newName);

            $companyForm = $request->only('name', 'email', 'website');
            $companyForm['logo'] = $newName;
       
            $company = Company::create($companyForm);
         
           } else {
           $company = Company::create($request->all());
        }
      
      return response()->json( $company, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
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
        }
       
        return response()->json('Company updated');
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
        return response()->json(null, 204);

    }
}
