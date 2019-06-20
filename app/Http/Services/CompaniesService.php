<?php

namespace App\Http\Services;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompaniesService 
{
    public static function storeData($request) 
    {
        $company = new Company;
        self::addData($company, $request);
    }

    public static function showCompanies() {
        $companies = Company::paginate(10);
        return view('companies.index', [ 'companies' => $companies ]);
    }

    public static function showCompany($id)
    {
        $company = Company::find($id);
        return $company ? view('companies.show', [ 'company' => $company ]) : redirect()->action('CompaniesController@index');
    }

    public static function editCompany($id)
    {
        $company = Company::find($id);
        return $company ? view('companies.edit', [ 'company' => $company ]) : redirect()->action('CompaniesController@index');
    }

    public static function updateData($request, $id)
    {

        $company = Company::find($id);
        if ($company) {
            self::addData($company, $request, true);
        }
    }

    public static function destroyCompany($id)
    {
        $company = Company::find($id);
        if ($company->logo) {
            Storage::delete('public/logos/'.$company->logo);
        }
        $company->delete();
        return true;
    }

    private static function addData($company, $request, $isUpdate = false)
    {
        if ($request->hasFile('logo')) {
            $fileNameWithExt = $request->file('logo')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('logo')->storeAs('public/logos', $fileNameToStore);
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
        return true;
    }
}