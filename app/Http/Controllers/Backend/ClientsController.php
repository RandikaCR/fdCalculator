<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ApplicationSettings;
use App\Models\Clients;
use App\Models\Rates;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = !empty($request->keyword) ? $request->keyword : null;

        $records = Clients::select(
            'clients.*',
            'rates.period',
        )
            ->join('rates', 'clients.rate_id', 'rates.id')
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where('clients.name', 'like', '%' . $keyword . '%')
                    ->orWhere('clients.amount', 'like', '%' . $keyword . '%');
            })
            ->orderBy('clients.id', 'DESC')
            ->paginate(20)
            ->withQueryString();

        return view('backend.clients.index',[
            'records' => $records,
            'keyword' => $keyword,
        ]);
    }

    public function create(Request $request){

        $rates = Rates::all();
        return view('backend.clients.create',[
            'rates' => $rates,
        ]);
    }

    public function edit(Request $request, $clientId){
        $client = Clients::find($clientId);
        $rates = Rates::all();
        return view('backend.clients.create',[
            'client' => $client,
            'rates' => $rates,
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'name' => ['required'],
            'rate_id' => ['required'],
            'amount' => ['required', 'numeric'],
            'ip_frequency' => ['required'],
            'age_group' => ['required'],
            'is_tax' => ['required'],
        ]);

        if (!empty($request->id)) {
            $save = Clients::find($request->id);
            $fmMsg = 'Client has been updated successfully';
        }else{
            $save = new Clients();
            $save->status = 1;
            $fmMsg = 'New Client has been created successfully';
        }


        $save->name = $request->name;
        $save->amount = $request->amount;
        $save->rate_id = $request->rate_id;
        $save->ip_frequency = $request->ip_frequency;
        $save->age_group = $request->age_group;
        $save->is_tax = $request->is_tax;
        $save->save();

        $fmTitle = 'success';

        session()->flash($fmTitle, $fmMsg);
        return redirect( route('backend.clients.index') );
    }

    public function rateCalculator(Request $request){

        $ipFrequency = $request->ip_frequency;
        $ageGroup = $request->age_group;
        $isTax = $request->is_tax;
        $amount = $request->amount;


        $ipFrequencyLabel = $ipFrequency == '1' ? 'Maturity' : 'Monthly';
        $grossLabel = 'Monthly Gross Interest';
        $nettLabel = 'Monthly Net Interest';

        $isTotInterest = 0;
        $isWht = $isTax == 1 ? 1 : 0;

        $r = Rates::find($request->rate_id);
        $period = $r->period;
        $months = $r->months;
        $rate = 0;

        if ($ageGroup == 1){
            if ($ipFrequency == 1){
                $rate = $r->senior_maturity_ip;
            }elseif ($ipFrequency == 2){
                $rate = $r->senior_monthly_ip;
            }
        }elseif ($ageGroup == 2){
            if ($ipFrequency == 1){
                $rate = $r->non_senior_maturity_ip;
            }elseif ($ipFrequency == 2){
                $rate = $r->non_senior_monthly_ip;
            }
        }


        $gross = 0;
        if ($ipFrequency == 1){
            $gross = ($amount / 100 * $rate) / 12 * $months;
        }
        elseif ($ipFrequency == 2){
            $isTotInterest = 1;
            $gross = ($amount / 100 * $rate) / 12;
        }

        $wht = 0;
        if (!empty($isWht)){
            $as = ApplicationSettings::find(1);
            $whtRate = $as->wht_rate;
            $wht = $gross / 100 * $whtRate;
        }

        $nett = $gross - $wht;

        $maturity = 0;
        $totInterest = 0;
        if ($ipFrequency == 1){
            $maturity = $amount + $nett;
        }
        elseif ($ipFrequency == 2){
            $maturity = $amount;
            $totInterest = $nett * $months;
        }




        $rateLabel = number_format($rate, 2) .'%';

        $out = [
            'status' => 'success',
            'ip_frequency_label' => $ipFrequencyLabel,
            'gross_label' => $grossLabel,
            'nett_label' => $nettLabel,
            'amount' => priceWithCurrency($amount),
            'rate' => $rateLabel,
            'period' => $period,
            'wht' => priceWithCurrency($wht),
            'gross' => priceWithCurrency($gross),
            'nett' => priceWithCurrency($nett),
            'maturity' => priceWithCurrency($maturity),
            'tot_interest' => priceWithCurrency($totInterest),
            'is_tot_interest' => $isTotInterest,
            'is_wht' => $isWht,
        ];
        return response()->json($out);
    }
}
