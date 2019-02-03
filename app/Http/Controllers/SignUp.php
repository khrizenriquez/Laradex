<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SignUp extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $flights = \App\Service::all();

        foreach ($flights as $flight) {
            echo $flight->name;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $service_data = Service::all()->last();

        //Log::debug($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $service_data = Service::all()->last();

        Log::debug($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function saveVendor(Request $request)
    {
        //
        $r = $request;

        //  Getting the request
        // $validated_data = $r->validate([
        //     'name'              => 'required|max:150',
        //     'email'             => 'required|email|max:150',
        //     'password'          => 'required|max:150',
        //     'phone'             => 'required|numeric',
        //     'business_name'     => 'required|max:150',
        //     'business_type'     => 'required',
        //     'category'          => 'required',
        //     'suscription_type'  => 'required'
        // ]);

        //  Getting the services

        //  Is unique email?
        $unique_email = \App\User::where('email', trim($r->email))->first();

        Log::info($r);

        //  Validating the data
        if (empty($r->email)) {
            return response()->json([
                'response' => 'Empty email', 
                'status' => 200, 
                'code' => 0
            ]);
        }
        if (!empty($unique_email)) {
            return response()->json([
                'response' => 'Email already exist', 
                'status' => 200, 
                'code' => 0
            ]);
        }
        //  Validation of the password
        if (trim($r->password) !== trim($r->confirm_password)) {
            return response()->json([
                'response' => 'Error in the password',
                'status' => 200, 
                'code' => 0
            ]);
        }
        DB::beginTransaction();
        try {
            //  User data
            $u = new \App\User;

            $u->name        = trim($r->name);
            $u->email       = trim($r->email);
            $u->password    = bcrypt(trim($r->password));
            $u->phone       = trim($r->phone);
            $u->user_type   = "vendor";
            $u->status      = 0;//   User disabled
            $u->save();
            Log::info($u->id);

            //  User Suscription
            $us = new \App\UserHasSuscription;

            $us->user_id        = $u->id;
            $us->suscription_id = trim($r->suscription_type);
            $us->save();
            Log::info($us);

            //  Business info
            $bi = new \App\BusinessInfo;

            $bi->name           = trim($r->name);
            $bi->user_id        = trim($u->id);
            $bi->type_id        = trim($r->business_type);
            $bi->category_id    = trim($r->category);
            $bi->status         = 0;//   Business disabled
            $bi->save();
            Log::info($bi);

            //  Business Service
            Log::info(gettype($r->service_allowed));
            if (!is_array($r->service_allowed)) {
                DB::rollback();

                return response()->json([
                    'response' => 'Enter the services',
                    'status' => 200, 
                    'code' => 0
                ]);
            }

            foreach($r->service_allowed as $service) {
                $bs = new \App\BusinessInfoHasService;
                $bs->service_id = $service;
                $bs->business_info_id = $bi->id;
                $bs->created_at = date("Y-m-d H:i:s");
                $bs->save();
            }
            Log::info($bs);

            //  Sending the email
            Log::info('Everything okay');

            DB::commit();
        } catch (\Exception $e) {
            Log::info("Error, $e");
            DB::rollback();
        }
        $data = [
            'response' => 'Success', 
            'status' => 200, 
            'code' => 1
        ];

        return response()
            ->view('sign-up-vendor', $data, 200);

        // return response()->json([
        //     'response' => 'Success', 
        //     'status' => 200, 
        //     'code' => 1
        // ]);

        //return \App\User::all();
    }
}
