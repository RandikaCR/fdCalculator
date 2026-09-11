<?php

namespace App\Http\Controllers;

use App\Models\ApplicationSettings;
use App\Models\Rates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    public function calculate($req){

        $rateId = $req['rate_id'];
        $ipFrequency = $req['ip_frequency'];
        $ageGroup = $req['age_group'];
        $isTax = $req['is_tax'];
        $amount = $req['amount'];
        $rate = !empty($req['rate']) ? $req['rate'] : 0;


        $ipFrequencyLabel = $ipFrequency == '1' ? 'Maturity' : 'Monthly';
        $grossLabel = 'Monthly Gross Interest';
        $nettLabel = 'Monthly Nett Interest';

        $isTotInterest = 0;
        $isWht = $isTax == 1 ? 1 : 0;

        $r = Rates::find($rateId);
        $period = $r->period;
        $months = $r->months;

        if (empty($rate)){
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

        return $out;
    }

    public function userAccessDeniedMessage($req = []){
        return [
            'errors' => [
                'Access Denied' => [
                    'You do not have enough permissions to do this action. Please contact Admin.'
                ]
            ]
        ];
    }
}
