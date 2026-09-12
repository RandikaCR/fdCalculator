<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Rates;
use App\Models\RatesImport;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

class RatesController extends Controller
{
    public function index(Request $request){
        $userAccess = isSuperAdmin();

        $rates = Rates::all();
        return view('backend.rates.index', [
            'rates' => $rates,
            'user_access' => $userAccess,
        ]);
    }

    public function store(Request $request){
        $fmTitle = 'info';
        $fmMsg = 'Nothing to update';

        $userAccess = isSuperAdmin();
        if (empty($userAccess)){
            $fmTitle = 'error';
            $fmMsg = $this->accessDeniedMessage;
            session()->flash($fmTitle, $fmMsg);
            return redirect( route('backend.rates.index') );
        }

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

    public function import(Request $request){
        $userAccess = isSuperAdmin();

        $rates = RatesImport::all();

        return view('backend.rates.import', [
            'rates' => $rates,
            'user_access' => $userAccess,
        ]);
    }

    public function importStore(Request $request){

        $fmTitle = 'info';
        $fmMsg = 'Nothing to update';

        $userAccess = isSuperAdmin();
        if (empty($userAccess)){
            $fmTitle = 'error';
            $fmMsg = $this->accessDeniedMessage;
            session()->flash($fmTitle, $fmMsg);
            return redirect( route('backend.rates.import') );
        }


        $request->validate([
            'file' => 'required|file|mimes:csv,txt|',
        ]);

        $file = $request->file('file');



        $rows = LazyCollection::make(function () use ($file) {
            $handle = fopen($file->getRealPath(), 'r');
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                yield $row;
            }
            fclose($handle);
        });


        // $header = $rows->first();
        $rows->skip(1)->each(function ($row) {
            if (!empty(trim($row[0]))) {
                $period = !empty(trim($row[0])) ? trim($row[0]) : null;
                $months = !empty(trim($row[1])) ? trim($row[1]) : null;
                $nsMaturityIp = !empty(trim($row[2])) ? trim($row[2]) : null;
                $nsMaturityAer = !empty(trim($row[3])) ? trim($row[3]) : null;
                $nsMaturityCeiling = !empty(trim($row[4])) ? trim($row[4]) : null;
                $nsMonthlyIp = !empty(trim($row[5])) ? trim($row[5]) : null;
                $nsMonthlyAer = !empty(trim($row[6])) ? trim($row[6]) : null;
                $nsMonthlyCeiling = !empty(trim($row[7])) ? trim($row[7]) : null;
                $sMaturityIp = !empty(trim($row[8])) ? trim($row[8]) : null;
                $sMaturityAer = !empty(trim($row[9])) ? trim($row[9]) : null;
                $sMaturityCeiling = !empty(trim($row[10])) ? trim($row[10]) : null;
                $sMonthlyIp = !empty(trim($row[11])) ? trim($row[11]) : null;
                $sMonthlyAer = !empty(trim($row[12])) ? trim($row[12]) : null;
                $sMonthlyCeiling = !empty(trim($row[13])) ? trim($row[13]) : null;


                $r = new RatesImport();
                $r->period = $period;
                $r->months = $months;
                $r->senior_maturity_ip = $sMaturityIp;
                $r->senior_maturity_aer = $sMaturityAer;
                $r->senior_maturity_cbsl_ceiling_rate = $sMaturityCeiling;
                $r->senior_monthly_ip = $sMonthlyIp;
                $r->senior_monthly_aer = $sMonthlyAer;
                $r->senior_monthly_cbsl_ceiling_rate = $sMonthlyCeiling;
                $r->non_senior_maturity_ip = $nsMaturityIp;
                $r->non_senior_maturity_aer = $nsMaturityAer;
                $r->non_senior_maturity_cbsl_ceiling_rate = $nsMaturityCeiling;
                $r->non_senior_monthly_ip = $nsMonthlyIp;
                $r->non_senior_monthly_aer = $nsMonthlyAer;
                $r->non_senior_monthly_cbsl_ceiling_rate = $nsMonthlyCeiling;
                $r->status = 1;
                $r->save();

            }
        });

        $fmTitle = 'success';
        $fmMsg = 'Rates has been imported successfully';

        session()->flash($fmTitle, $fmMsg);
        return redirect( route('backend.rates.import') );
    }

    public function ClearImportedRates(Request $request) {

        $req = $request->all();

        $userAccess = isSuperAdmin();
        if (empty($userAccess)){
            return response()->json($this->userAccessDeniedMessage(), 422);
        }

        RatesImport::truncate();

        $status = 'success';
        $messageTitle = 'Success';
        $messageText = 'Imported Rates has been cleared successfully';


        $out = [
            'status' => $status,
            'message_title' => $messageTitle,
            'message_text' => $messageText,
        ];
        return response()->json($out);

    }

    public function importProcess(Request $request){
        $req = $request->all();

        $userAccess = isSuperAdmin();
        if (empty($userAccess)){
            return response()->json($this->userAccessDeniedMessage(), 422);
        }


        Rates::truncate();

        $rates = RatesImport::all();
        foreach ($rates as $rate){

            $period = !empty($rate->period) ? $rate->period : null;
            $months = !empty($rate->months) ? $rate->months : null;
            $sMaturityIp = !empty($rate->senior_maturity_ip) ? $rate->senior_maturity_ip : null;
            $sMaturityAer = !empty($rate->senior_maturity_aer) ? $rate->senior_maturity_aer : null;
            $sMaturityCeiling = !empty($rate->senior_maturity_cbsl_ceiling_rate) ? $rate->senior_maturity_cbsl_ceiling_rate : null;
            $sMonthlyIp = !empty($rate->senior_monthly_ip) ? $rate->senior_monthly_ip : null;
            $sMonthlyAer = !empty($rate->senior_monthly_aer) ? $rate->senior_monthly_aer : null;
            $sMonthlyCeiling = !empty($rate->senior_monthly_cbsl_ceiling_rate) ? $rate->senior_monthly_cbsl_ceiling_rate : null;
            $nsMaturityIp = !empty($rate->non_senior_maturity_ip) ? $rate->non_senior_maturity_ip : null;
            $nsMaturityAer = !empty($rate->non_senior_maturity_aer) ? $rate->non_senior_maturity_aer : null;
            $nsMaturityCeiling = !empty($rate->non_senior_maturity_cbsl_ceiling_rate) ? $rate->non_senior_maturity_cbsl_ceiling_rate : null;
            $nsMonthlyIp = !empty($rate->non_senior_monthly_ip) ? $rate->non_senior_monthly_ip : null;
            $nsMonthlyAer = !empty($rate->non_senior_monthly_aer) ? $rate->non_senior_monthly_aer : null;
            $nsMonthlyCeiling = !empty($rate->non_senior_monthly_cbsl_ceiling_rate) ? $rate->non_senior_monthly_cbsl_ceiling_rate : null;


            $r = new Rates();
            $r->period = $period;
            $r->months = $months;
            $r->senior_maturity_ip = $sMaturityIp;
            $r->senior_maturity_aer = $sMaturityAer;
            $r->senior_maturity_cbsl_ceiling_rate = $sMaturityCeiling;
            $r->senior_monthly_ip = $sMonthlyIp;
            $r->senior_monthly_aer = $sMonthlyAer;
            $r->senior_monthly_cbsl_ceiling_rate = $sMonthlyCeiling;
            $r->non_senior_maturity_ip = $nsMaturityIp;
            $r->non_senior_maturity_aer = $nsMaturityAer;
            $r->non_senior_maturity_cbsl_ceiling_rate = $nsMaturityCeiling;
            $r->non_senior_monthly_ip = $nsMonthlyIp;
            $r->non_senior_monthly_aer = $nsMonthlyAer;
            $r->non_senior_monthly_cbsl_ceiling_rate = $nsMonthlyCeiling;
            $r->status = 1;
            $r->save();
        }

        RatesImport::truncate();

        $status = 'success';
        $messageTitle = 'Success';
        $messageText = 'Rates has been updated successfully';


        $out = [
            'status' => $status,
            'message_title' => $messageTitle,
            'message_text' => $messageText,
        ];
        return response()->json($out);
    }
}
