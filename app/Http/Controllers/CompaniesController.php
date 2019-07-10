<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\CheckCompanyData;
use Illuminate\Support\Facades\Storage;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Company::all()->toJson();
    }

    public function store(CheckCompanyData $request)
    {
        $company = new Company;
        self::addData($company, $request);
        return response()->json('Company added succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        if ($company) {
            return $company->toJson();
        }
        return response()->json([
            'error' => 'Company with such id does not exist',
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckCompanyData $request, $id)
    {
        $company = Company::find($id);
        self::addData($company, $request, true);
        return response()->json('Company updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        if ($company->logo) {
            Storage::delete('public/logos/'.$company->logo);
        }
        $company->delete();
        return response()->json('Company deleted succesfully');
    }

    private static function addData($company, $request, $isUpdate = false)
    {
        if ($request->logo) {
            $fileNameWithExt = $request->logo->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->logo->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->logo->storeAs('public/logos', $fileNameToStore);
            if ($isUpdate) {
                if ($company->logo) {
                    Storage::delete('public/logos/'.$company->logo);
                }
            }
            $company->logo = $fileNameToStore;
        }

        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        $company->save();
    }
}