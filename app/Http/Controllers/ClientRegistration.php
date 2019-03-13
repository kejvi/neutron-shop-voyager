<?php

namespace App\Http\Controllers;

use App\City;
use App\Client;
use App\Njesia;
use App\Office;
use Illuminate\Http\Request;

class ClientRegistration extends Controller
{
    //
    function showFormForRegistration() 
    {
        $cities = City::orderBy('name')->get();

    	return view('clientRegistration.clientRegistration' , compact('cities'));
    }

    function makeRegistration(Request $request)
    {

        $this->validate($request,[
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:2|max:50',
            'email' => 'nullable|email',
            'address' => 'required|min:6',
            'tel' => 'required|numeric',
            'sn' => 'required|exists:articles,sn',
            'city' => 'nullable',
            'njesia' => 'nullable',
        ], [
            'first_name.required' => 'Emri është i detyrueshëm',
            'first_name.min' => 'Emri duhet të ketë minimumi 3 karaktere.',
            'first_name.max' => 'Emri nuk mund të jetë me më shumë se 50 karaktere',
            'last_name.required' => 'Mbiemri është i detyrueshëm',
            'last_name.min' => 'Mbiemri duhet të ketë minimumi 3 karaktere.',
            'last_name.max' => 'Mbiemri nuk mund të jetë me më shumë se 50 karaktere',
            'address.required' => 'Adresa është e detyrueshme',
            'address.min' => 'address duhet të ketë minimumi 6 karaktere.',
            'tel.required' => 'Numri i telefonit është i detyrueshëm',
            'sn.required' => 'Numri serial është i detyrueshëm',
            'sn.exists' => 'Numri serial nuk ekziston',
            'tel.numeric' => 'Numri i telefonit duhet të jetë numerik.'
        ]);

//        dd($request);
//        $input = request()->except('password','confirm_password');
//        $user=new User($input);
//        $user->password=bcrypt(request()->password);
//        $user->save();
//        Client::
//        Client::create([
//            'first_name' => $request('first_name'),
//            'last_name' =>  $request('last_name'),
//            'address' =>  $request('address'),
//            'tel' =>  $request('tel'),
//            'email' =>  $request('email')
//        ]);

        $client = new Client();
        $client->first_name =  $request->first_name;
        $client->last_name =  $request->last_name;
        $client->address =  $request->address;
        $client->tel =  $request->tel;
        $client->sn =  $request->sn;

//        $client->email = null;
        if ($request->email){
            $client->email =  $request->email;
        }

        if ($request->city){
            $client->qyteti =  City::find($request->city)->name;
        }

        if ($request->njesia){
            $client->njesia =  $request->njesia;
        }

        $client->save();

        return redirect()->route('client.get')->with('success','Regjistrimi u krye me sukses');
    }


    public function getCities(Request $request){
        $cities = City::all();

        $cities = $cities->map(function ($item){
            return [
                'label' => $item->name,
                'value' => $item->name,
            ];
        });

        return $cities;
    }

    public function getNjesia($city = null){

        if($city !== null){
            $njesite = Njesia::where('city_id', $city)->get();

            return $njesite;
        }
    }

    public function getOfficesByBranch($branch = null){
        if($branch !== null){
            $offices = Office::where('branch_id', $branch)->get();

            return $offices;
        }
    }

}
