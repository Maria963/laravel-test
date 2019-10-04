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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $companies = Company::latest()->paginate(10);
     //$companies = Company::latest()->paginate(10);

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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'dimensions:min_width=100,min_height=100'
        ]);
        $logo=$request->file('logo');
        if ($logo) {
       
         $new_name = rand(). '.'. $logo->getClientOriginalExtension();
    
           $path = $logo->storeAs('public', $new_name);
         $form_date = array(
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $new_name,
            'website' => $request->website
         );

        Company::create($form_date);
        }
        else {
            Company::create($request->all());
        }
   
        return redirect()->route('companies.index')
                        ->with('success','Company created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  //  public function show(Company $company)
   //     return view('companies.show', compact('company'));
  //  }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            $form_date = array(
               'name' => $request->name,
               'email' => $request->email,
               'logo' => $new_name,
               'website' => $request->website
            );
            $company->update($form_date);
         }
         else {
            $company->update($request->all());
         }
        

        
   
        return redirect()->route('companies.index')
                        ->with('success','Company updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
  
        return redirect()->route('companies.index')
                        ->with('success','Company deleted successfully');
    }
}
