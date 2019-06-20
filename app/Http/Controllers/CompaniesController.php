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