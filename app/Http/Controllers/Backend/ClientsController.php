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
            'users.name as user_name',
            'rates.period',
        )
            ->join('users', 'clients.user_id', 'users.id')
            ->join('rates', 'clients.rate_id', 'rates.id')
            ->when(!empty($keyword), function ($query) use ($keyword) {
                if (!empty(isSuperAdmin())){
                    return $query->where('clients.name', 'like', '%' . $keyword . '%')
                        ->orWhere('clients.amount', 'like', '%' . $keyword . '%')
                        ->orWhere('users.name', 'like', '%' . $keyword . '%');
                }else{
                    return $query->where('clients.name', 'like', '%' . $keyword . '%')
                        ->orWhere('clients.amount', 'like', '%' . $keyword . '%');
                }
            })
            ->when(empty(isSuperAdmin()), function ($query) {
                return $query->where('clients.user_id', $this->userId);
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
        $ceilingRate = 0;
        $aer = 0;
        $ipRate = 0;

        return view('backend.clients.create',[
            'rates' => $rates,
            'ceiling_rate' => $ceilingRate,
            'aer' => $aer,
            'ip_rate' => $ipRate,
        ]);
    }

    public function edit(Request $request, $clientId){
        $client = Clients::find($clientId);
        $rates = Rates::all();
        $ceilingRate = 0;
        $aer = 0;
        $ipRate = 0;

        if (empty(isSuperAdmin())){
            if ( $this->userId != $client->user_id){
                $fmTitle = 'error';
                $fmMsg = $this->accessDeniedMessage;
                session()->flash($fmTitle, $fmMsg);
                return redirect( route('backend.clients.index') );
            }
        }


        if (!empty($client)) {
            $ipFrequency = $client->ip_frequency;
            $ageGroup = $client->age_group;
            $r = Rates::find($client->rate_id);

            if ($ageGroup == 1){
                if ($ipFrequency == 1){
                    $ipRate = $r->senior_maturity_ip;
                    $aer = $r->senior_maturity_aer;
                    $ceilingRate = $r->senior_maturity_cbsl_ceiling_rate;
                }elseif ($ipFrequency == 2){
                    $ipRate = $r->senior_monthly_ip;
                    $aer = $r->senior_monthly_aer;
                    $ceilingRate = $r->senior_monthly_cbsl_ceiling_rate;
                }
            }elseif ($ageGroup == 2){
                if ($ipFrequency == 1){
                    $ipRate = $r->non_senior_maturity_ip;
                    $aer = $r->non_senior_maturity_aer;
                    $ceilingRate = $r->non_senior_maturity_cbsl_ceiling_rate;
                }elseif ($ipFrequency == 2){
                    $ipRate = $r->non_senior_monthly_ip;
                    $aer = $r->non_senior_monthly_aer;
                    $ceilingRate = $r->non_senior_monthly_cbsl_ceiling_rate;
                }
            }

            $ceilingRate = !empty($ceilingRate) ? $ceilingRate : 0;
        }


        return view('backend.clients.create',[
            'client' => $client,
            'rates' => $rates,
            'ceiling_rate' => $ceilingRate,
            'aer' => $aer,
            'ip_rate' => $ipRate,
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'name' => ['required'],
            'rate_id' => ['required'],
            'rate' => ['required'],
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
            $save->user_id = $this->userId;
            $save->status = 1;
            $fmMsg = 'New Client has been created successfully';
        }


        $save->name = $request->name;
        $save->amount = $request->amount;
        $save->rate_id = $request->rate_id;
        $save->rate = $request->rate;
        $save->ip_frequency = $request->ip_frequency;
        $save->age_group = $request->age_group;
        $save->is_tax = $request->is_tax;
        $save->save();

        $fmTitle = 'success';

        session()->flash($fmTitle, $fmMsg);
        return redirect( route('backend.clients.index') );
    }

    public function rateCalculator(Request $request){

        $rateId = $request->rate_id;
        $ipFrequency = $request->ip_frequency;
        $ageGroup = $request->age_group;
        $isTax = $request->is_tax;
        $amount = $request->amount;
        $rate = $request->rate;

        $req = [
            'rate_id' => $rateId,
            'ip_frequency' => $ipFrequency,
            'age_group' => $ageGroup,
            'is_tax' => $isTax,
            'amount' => $amount,
            'rate' => $rate,
        ];

        $out = $this->calculate($req);

        return response()->json($out);
    }

    public function getCeilingRate(Request $request){

        $rateId = $request->rate_id;
        $ipFrequency = $request->ip_frequency;
        $ageGroup = $request->age_group;

        $r = Rates::find($rateId);

        $ipRate = 0;
        $aer = 0;
        $ceilingRate = 0;
        if ($ageGroup == 1){
            if ($ipFrequency == 1){
                $ipRate = $r->senior_maturity_ip;
                $aer = $r->senior_maturity_aer;
                $ceilingRate = $r->senior_maturity_cbsl_ceiling_rate;
            }elseif ($ipFrequency == 2){
                $ipRate = $r->senior_monthly_ip;
                $aer = $r->senior_monthly_aer;
                $ceilingRate = $r->senior_monthly_cbsl_ceiling_rate;
            }
        }elseif ($ageGroup == 2){
            if ($ipFrequency == 1){
                $ipRate = $r->non_senior_maturity_ip;
                $aer = $r->non_senior_maturity_aer;
                $ceilingRate = $r->non_senior_maturity_cbsl_ceiling_rate;
            }elseif ($ipFrequency == 2){
                $ipRate = $r->non_senior_monthly_ip;
                $aer = $r->non_senior_monthly_aer;
                $ceilingRate = $r->non_senior_monthly_cbsl_ceiling_rate;
            }
        }

        $rate = !empty($rate) ? $rate : 0;

        $out = [
            'status' => 'success',
            'ip_rate' => $ipRate,
            'ip_rate_label' => number_format($ipRate, 2) . '%',
            'aer' => $aer,
            'aer_label' => number_format($aer, 2) . '%',
            'ceiling_rate' => $ceilingRate,
            'ceiling_rate_label' => number_format($ceilingRate, 2) . '%',
        ];
        return response()->json($out);
    }

    public function status(Request $request){
        $req = $request->all();
        $id = !empty($req['id']) ? $req['id'] : 0;

        $text = '';
        $class = '';

        if (!empty($id)){
            $get = Clients::find($id);

            if ($get->status == 1){
                $get->status = 0;
            }else {
                $get->status = 1;
            }
            $get->save();
            $status = 'success';
            $get = Clients::find($id);
            $getStatus = commonStatus($get->status);
            $text = $getStatus['text'];
            $class = $getStatus['class'];

        }else{
            $status = 'error';
        }


        $out = [
            'status' => $status,
            'text' => $text,
            'class' => $class,
        ];
        return response()->json($out);

    }
}
