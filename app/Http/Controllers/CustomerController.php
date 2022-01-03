<?php

namespace App\Http\Controllers;

use App\Http\Resources\Customer as ResourcesCustomer;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use PhpParser\Node\Stmt\TryCatch;


/*
TODO: 
API version
Test bad field send in API (create et update)
Language manager
Add href in response
Add logs
array response in object
Change name of field of the db for protection
*/

class CustomerController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //init
        $response = ['success' => false, 'message' => ''];
        $status = 200;
        $filter = [];
        $customers = '';
        //-------
        try {
            $queryParams = $request->query();
            isset($queryParams['filter']) ? $filter = $queryParams['filter'] : [];

            $customers = Customer::orderByDesc('created_at');

            if (isset($filter['name'])) {
                $customers = $customers->name($filter['name']);
            }

            if (isset($filter['Fname'])) {
                $customers = $customers->Fname($filter['Fname']);
            }

            $response['data'] = $customers->get();
            $response['success'] = true;
        } catch (\Exception $e) {

            $response['message'] = $e->getMessage();
            $status = 400;
        }



        return response()->json([
            $response
        ], $status);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $response = ['success' => false, 'message' => ''];
        $status = 200;

        try {

            $rules = [
                'fName' => 'required|min:3|max:100',
                'name' => 'required|min:3|max:100'
            ];

            $validator = $this->getValidationFactory()->make($request->all(), $rules, [], []);

            if ($validator->fails()) {
                $responseArr['message'] = $validator->errors();
                //throw new \Exception($validator->errors());
                return response()->json($responseArr);
            }

            if (Customer::create($request->all())) {
                $response['message'] =  'Create sucefull';
                $response['success'] = true;
                $status = 200;
            }
        } catch (\Exception $e) {

            $response['message'] = $e->getMessage();
            $status = 400;
        }

        //EO
        return response()->json([
            $response
        ], $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $response = ['success' => false, 'message' => ''];
        $status = 200;

        try {
            if (empty($customer)) {
                $status = 400;
                /* return  response()->json([
                $response
            ],200);*/
                throw new \Exception('Customer no found');
            }
            $response['data'] = $customer; // Array or not?
            $response['success'] = true;
        } catch (\Exception $e) {

            $response['message'] = $e->getMessage();
            if ($status != 200) {
                $status = 400;
            }
        }

        return  response()->json([
            $response
        ], $status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $response = ['success' => false, 'message' => ''];
        $status = 200;
        try {

            $rules = [
                'fName' => 'required|min:3|max:100',
                'name' => 'required|min:3|max:100'
            ];

            $validator = $this->getValidationFactory()->make($request->all(), $rules, [], []);

            if ($validator->fails()) {
                $response['success'] = false;
                $response['message'] = $validator->errors();
                //throw new \Exception($validator->errors());
                return response()->json($response);
            }
            $response['success'] = true;
            $response['message'] = 'Update Succeful';
        } catch (\Exception $e) {

            $response['message'] = $e->getMessage();
            $status = 400;
        }

        if ($customer->update($request->all())) {

            return response()->json([
                $response
            ], $status);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $response = ['success' => false, 'message' => ''];
        $status = 200;
        try {
            if ($customer->delete()) {

                $response['message'] = 'Delete sucefull';
                $response['success'] = true;
            } else {
                $status = 404;
            }
        } catch (\Exception $e) {

            $response['message'] = $e->getMessage();
            $response['success'] = false;
            $status = 400;
        }



        return response()->json([
            $response

        ], $status);
    }
}
