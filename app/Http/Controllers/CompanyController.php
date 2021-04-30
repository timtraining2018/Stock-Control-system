<?php
    
namespace App\Http\Controllers;
    
use App\Models\Company;
use Illuminate\Http\Request;
    
class CompanyController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:company-list|company-create|company-edit|company-delete', ['only' => ['index','show']]);
         $this->middleware('permission:company-create', ['only' => ['create','store']]);
         $this->middleware('permission:company-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:company-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::latest()->paginate(5);
        return view('companies.index',compact('companies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
        request()->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
    
        Company::create($request->all());
    
        return redirect()->route('companies.index')
                        ->with('success','Company created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show',compact('company'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
         request()->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
    
        $company->update($request->all());
    
        return redirect()->route('companies.index')
                        ->with('success','Company updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
    
        return redirect()->route('companies.index')
                        ->with('success','Company deleted successfully');
    }
}