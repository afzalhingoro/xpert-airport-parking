<?php



namespace App\Http\Controllers;



use App\Models\airport;
use App\Models\ApiClient;
use App\Models\companies_product_price;

use App\Models\companies_products;

use App\Models\companies_set_assign_price_plan;

use App\Models\companies_set_price_plan;

use App\Models\Company;

use App\Models\valet;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;



class ApiCompaniesProductPrice   extends Controller

{
      public function companyprices(Request $request)
    {
         $requiredParams = ['company_codes', 'no_of_day', 'access_token'];
        $missing = [];
    
        foreach ($requiredParams as $param) {
            if (!$request->has($param) || !$request->filled($param)) {
                $missing[] = $param;
            }
        }
    
        if (!empty($missing)) {
            return response()->json([
                'success'=> false,
                'error' => 'Missing required parameter(s): ' . implode(', ', $missing)
            ], 400);
        }
    
        // Expecting only one company code now.
        $company_code = $request->company_codes;
        $current_month = $request->month;
        $current_year = $request->year;
        $no_of_day     = (int) $request->no_of_day;
        $access_token   =  $request->access_token;
 $api_client = ApiClient::where('access_token', $access_token)->where('status',1)->first();

    if (!$api_client) {
        return response()->json([
            'success' => false,
            'error' => 'Invalid access token'
        ], 401);
    }
     $supplier_id=$api_client->supplier_id;
       
        $plan_type     = 2;
    
        // Initialize result for the provided company code.
        $result = ['company_code' => $company_code];
    
        // 1. Find the company by company code.
        $company = Company::where('company_code', $company_code)->first();
        if (!$company) {
            $result['message'] = "Company not found";
            return response()->json(['success'=> false, 'data' => $result, 'no_of_day' => $no_of_day], 404);
        }
        $company_id = $company->id;
    
        // 2. Get the assigned plan for the company.
        $assigned_plan = companies_set_price_plan::where('cid', $company_id)
            ->where('agent_id', $supplier_id)
            ->where('plan_type', $plan_type)
            ->where('cmp_month', $current_month)
            ->where('cmp_year', $current_year)
            ->orderBy('created_at', 'desc')
            ->first();
    
        if (!$assigned_plan) {
            $result['message'] = "The requested company code or pricing data could not be found";
            return response()->json(['success'=> false, 'data' => $result, 'no_of_day' => $no_of_day], 404);
        }
        $assigned_plan_id = $assigned_plan->id;
    
        // 3. Determine the day column.
        $columnDay = "day_$no_of_day";
    
        // 4. Get the assigned product (price plan) for that day.
        $assigned_product = DB::table('companies_set_assign_price_plans')
            ->where('plan_id', $assigned_plan_id)
            ->where('day_no', $columnDay)
            ->first();
    
        if (!$assigned_product) {
            $result['message'] = "The requested company code or pricing data could not be found";
            return response()->json(['success'=> false, 'data' => $result, 'no_of_day' => $no_of_day], 404);
        }
        $assigned_plan_name = $assigned_product->brand_name;
    
        // 5. Verify the company has a matching product by name.
        $company_product = companies_products::where('company_id', $company_id)
            ->where('product_name', $assigned_plan_name)
            ->where('plan_type', $plan_type)
            ->first();
    
        if (!$company_product) {
            $result['message'] = "The requested company code or pricing data could not be found";
            return response()->json(['success'=> false, 'data' => $result, 'no_of_day' => $no_of_day], 404);
        }
        $brand_id = $company_product->id;
    
        // 6. Retrieve the price for the specified day.
        $api_price = companies_product_price::where('cid', $company_id)
            ->where('brand_name', $assigned_plan_name)
            ->where('brand_id', $brand_id)
            ->where('plan_type', $plan_type)
            ->where('agent_id', $supplier_id)
            ->first([$columnDay]);
    
        if (!$api_price) {
            $result['message'] = "No plan set for this company";
            return response()->json(['success'=> false, 'data' => $result, 'no_of_day' => $no_of_day], 422);
        }
    
        $result['total_price'] = $api_price->$columnDay;
        return response()->json(['success'=> true, 'data' => $result, 'no_of_day' => $no_of_day], 200);
    }
    
    
}    
 
