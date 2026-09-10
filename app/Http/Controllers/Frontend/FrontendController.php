<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\Rates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index(Request $request){
        return view('frontend.index');
    }

    public function viewRate(Request $request, $clientId){
        $client = Clients::where('id', $clientId)->where('status', 1)->first();
        $periods = Rates::all();
        $getRate = [];

        $rate = [];
        if (!empty($client)){
            $rateId = $client->rate_id;
            $ipFrequency = $client->ip_frequency;
            $ageGroup = $client->age_group;
            $isTax = $client->is_tax;
            $amount = $client->amount;
            $rate = $client->rate;

            $req = [
                'rate_id' => $rateId,
                'ip_frequency' => $ipFrequency,
                'age_group' => $ageGroup,
                'is_tax' => $isTax,
                'amount' => $amount,
                'rate' => $rate,
            ];

            $getRate = $this->calculate($req);
        }

        return view('frontend.clients.rate-view', [
            'client' => $client,
            'periods' => $periods,
            'rate' => $getRate,
        ]);
    }

    public function getRate(Request $request){

        $client = Clients::find($request->client_id);

        $rateId = $request->rate_id;
        $ipFrequency = $request->ip_frequency;
        $ageGroup = $client->age_group;
        $isTax = $client->is_tax;
        $amount = $request->amount;

        $req = [
            'rate_id' => $rateId,
            'ip_frequency' => $ipFrequency,
            'age_group' => $ageGroup,
            'is_tax' => $isTax,
            'amount' => $amount,
        ];

        $out = $this->calculate($req);

        return response()->json($out);
    }


    public function appLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $out = ['status' => 'success'];
        return response()->json($out);
    }
}
