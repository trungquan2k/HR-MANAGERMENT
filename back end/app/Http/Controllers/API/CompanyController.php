<?php

namespace App\Http\Controllers\API;
use Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function update(Request $request)
    {
        \Setting::set('company.name', $request->input('name'));
        \Setting::set('company.address', $request->input('address'));
        \Setting::set('company.phone', $request->input('phone'));
        \Setting::set('company.fax', $request->input('fax'));
        \Setting::set('company.website', $request->input('website'));
        \Setting::set('company.nguoi_dai_dien', $request->input('nguoi_dai_dien'));
        \Setting::set('company.chuc_vu', $request->input('chuc_vu'));
        \Setting::set('company.quoc_tich', $request->input('quoc_tich'));

        // Handle the user upload of avatar
    	if($request->hasFile('logo')){
    		$logo = $request->file('logo');
    		$filename = time() .'-logo.'. $logo->getClientOriginalExtension();
            Image::make($logo)->save( public_path('/uploads/logos/' . $filename ) );
            \Setting::set('company.logo', $filename);
        }

        try{
            \Setting::save();
            Log::info('Ng?????i d??ng ID:'.Auth::user()->id.' ???? c???p nh???t th??ng tin c??ng ty');
            return redirect()->route('company.index')->with('status_success', 'C???p nh???t th??ng tin c??ng ty th??nh c??ng!');
        }
        catch(\Exception $e){
            Log::error($e);
            return redirect()->route('company.index')->with('status_error', 'X???y ra l???i khi c???p nh???t th??ng tin c??ng ty!');
        }
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
}
