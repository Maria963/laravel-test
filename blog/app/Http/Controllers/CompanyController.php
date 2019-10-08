<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Model\Company;


class CompanyController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

    }
   
    public function index()
    {    
     
        $companies = Company::with('employees')->latest()->paginate(10);
        
        return view('companies.index', compact('companies'))->with('i', (request()->input('page', 1) - 1) * 10);
    
    }

    public function create()
    {

        return view('companies.create');

    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'logo' => 'dimensions:min_width=100,min_height=100'
        ]);

        $logo = $request->file('logo');
        
        if ($logo) {

            $new_name = rand(). '.'. $logo->getClientOriginalExtension();
            $path = $logo->storeAs('public', $new_name);
            $form_company = array (
                'name' => $request->name,
                'email' => $request->email,
                'logo' => $new_name,
                'website' => $request->website
            );

            Company::create($form_company);
        
        } else {

            Company::create($request->all());

        }
   
        return redirect()->route('companies.index')->with('success','Company created successfully.');

    }


    public function edit(Company $company)
    {
         
        return view('companies.edit', compact('company')); 

    }


    public function update(Request $request, Company $company)
    {

        $request->validate([
            'name' => 'required',
            'logo' => 'dimensions:min_width=100,min_height=100'
        ]);
         
        $logo=$request->file('logo');
        
        if ($logo) {
            
            $new_name = rand(). '.'. $logo->getClientOriginalExtension();
            $path = $logo->storeAs('public', $new_name);
            $form_company = array (
               'name' => $request->name,
               'email' => $request->email,
               'logo' => $new_name,
               'website' => $request->website
            );

            $company->update($form_company);

         } else {

            $company->update($request->all());

         }
        

        return redirect()->route('companies.index')->with('success','Company updated');
    
    }

   
    public function destroy(Company $company)
    {
       
        $company->delete();
  
        return redirect()->route('companies.index')->with('success','Company deleted successfully');

    }

}
