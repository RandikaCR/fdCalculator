<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Rates;
use Illuminate\Http\Request;

class RatesController extends Controller
{
    public function index(Request $request){
        $rates = Rates::all();
        return view('backend.rates.index', [
            'rates' => $rates,
        ]);
    }

    public function store(Request $request){
        $fmTitle = 'info';
        $fmMsg = 'Nothing to update';

        $index = 0;
        foreach ($request->id as $id){

            $period = $request->period[$index];
            $months = $request->months[$index];
            $seniorMaturityIp = $request->senior_maturity_ip[$index];
            $seniorMaturityAer = $request->senior_maturity_aer[$index];
            $seniorMaturityCbslCeilingRate = $request->senior_maturity_cbsl_ceiling_rate[$index];
            $seniorMonthlyIp = $request->senior_monthly_ip[$index];
            $seniorMonthlyAer = $request->senior_monthly_aer[$index];
            $seniorMonthlyCbslCeilingRate = $request->senior_monthly_cbsl_ceiling_rate[$index];
            $nonSeniorMaturityIp = $request->non_senior_maturity_ip[$index];
            $nonSeniorMaturityAer = $request->non_senior_maturity_aer[$index];
            $nonSeniorMaturityCbslCeilingRate = $request->non_senior_maturity_cbsl_ceiling_rate[$index];
            $nonSeniorMonthlyIp = $request->non_senior_monthly_ip[$index];
            $nonSeniorMonthlyAer = $request->non_senior_monthly_aer[$index];
            $nonSeniorMonthlyCbslCeilingRate = $request->non_senior_monthly_cbsl_ceiling_rate[$index];

            $rate = Rates::find($id);
            $rate->period = $period;
            $rate->months = $months;
            $rate->senior_maturity_ip = $seniorMaturityIp;
            $rate->senior_maturity_aer = $seniorMaturityAer;
            $rate->senior_maturity_cbsl_ceiling_rate = $seniorMaturityCbslCeilingRate;
            $rate->senior_monthly_ip = $seniorMonthlyIp;
            $rate->senior_monthly_aer = $seniorMonthlyAer;
            $rate->senior_monthly_cbsl_ceiling_rate = $seniorMonthlyCbslCeilingRate;
            $rate->non_senior_maturity_ip = $nonSeniorMaturityIp;
            $rate->non_senior_maturity_aer = $nonSeniorMaturityAer;
            $rate->non_senior_maturity_cbsl_ceiling_rate = $nonSeniorMaturityCbslCeilingRate;
            $rate->non_senior_monthly_ip = $nonSeniorMonthlyIp;
            $rate->non_senior_monthly_aer = $nonSeniorMonthlyAer;
            $rate->non_senior_monthly_cbsl_ceiling_rate = $nonSeniorMonthlyCbslCeilingRate;
            $rate->save();

            $index++;
        }


        $fmTitle = 'success';
        $fmMsg = 'Rates has been updated successfully';

        session()->flash($fmTitle, $fmMsg);
        return redirect( route('backend.rates.index') );
    }
}
