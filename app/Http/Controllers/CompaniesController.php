<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\CheckCompanyData;
use App\Http\Services\CompaniesService;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CompaniesService::showCompanies();
    }

    // --------------------------------------

    public function index2() {
        return Company::all()->toJson();
    }

    public function show2($id) {
        $company = Company::find($id);
        if ($company) {
            return $company->toJson();
        }
        return response()->json([
            'error' => 'Company with such id does not exist',
        ], 404);
    }

    public function delete2($id) {
        $company = Company::find($id);
        $company->delete();
        return response()->json('Company deleted succesfully');
    }

    public function store2(CheckCompanyData $request) {
        $company = new Company;
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        $company->save();
        return response()->json('All ok');
    }

    public function update2(CheckCompanyData $request, $id) {
        $company = Company::find($id);
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        $company->update();
        return response()->json('All ok');
    }

    // ------------------------------------------

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    public function store(CheckCompanyData $request)
    {
        CompaniesService::storeData($request);
        return redirect()->action('CompaniesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return CompaniesService::showCompany($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return CompaniesService::editCompany($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckCompanyData $request, $id)
    {
        CompaniesService::updateData($request, $id);
        return redirect()->action('CompaniesController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CompaniesService::destroyCompany($id);
        return redirect()->action('CompaniesController@index');
    }
}