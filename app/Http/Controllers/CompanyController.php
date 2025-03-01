<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;
use Uploadcare\Api;
use Uploadcare\Configuration;

class CompanyController extends Controller
{
    /**
     * Display the company details.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        $company = Company::first(); // Fetch the first (and only) record

        if (!$company) {
            return response()->json(['message' => 'Company details not found'], 404);
        }

        return response()->json(['company' => $company], 200);
    }

    /**
     * Update the company details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'company_name' => 'sometimes|required|string|max:255',
            'company_address' => 'nullable|string',
            'email' => 'nullable|email|unique:companies,email',
            'phone' => 'nullable|string|max:20',
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048', // Validate the uploaded file
            'remarks' => 'nullable|string',
            'facebook_url' => 'nullable|string',
            'instagram_url' => 'nullable|string',
            'linkedin_url' => 'nullable|string',
            'playstore_url' => 'nullable|string',
            'appstore_url' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Fetch the company record (or create one if it doesn't exist)
        $company = Company::firstOrNew([]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $uploadedFile = $request->file('logo');
        
            // Initialize Uploadcare API
            $configuration = Configuration::create(config('services.uploadcare.public_key'), config('services.uploadcare.secret_key'));
            $api = new Api($configuration);
        
            // Upload the file to Uploadcare
            $file = $api->uploader()->fromPath($uploadedFile->getPathname());
        
            // Get the UUID of the uploaded file
            $uuid = $file->getUuid();
        
            // Construct the public CDN URL
            $company->logo = "https://ucarecdn.com/{$uuid}/-/preview/";
        }           

        // Update other fields
        $company->fill($request->only([
            'company_name', 'company_address', 'email', 'phone', 'remarks', 'facebook_url', 'instagram_url', 'linkedin_url', 'playstore_url', 'appstore_url',
        ]));

        $company->save();

        return response()->json(['message' => 'Company details updated successfully', 'company' => $company], 200);
    }

    /**
     * Delete the company details.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete()
    {
        $company = Company::first();

        if (!$company) {
            return response()->json(['message' => 'Company details not found'], 404);
        }

        $company->delete();

        return response()->json(['message' => 'Company details deleted successfully'], 200);
    }
}