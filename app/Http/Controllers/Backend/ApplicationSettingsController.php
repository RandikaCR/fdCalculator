<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ApplicationSettings;
use Illuminate\Http\Request;

class ApplicationSettingsController extends Controller
{
    public function index(Request $request){
        $userAccess = isSuperAdmin();
        $app = ApplicationSettings::find(1);
        return view('backend.application-settings.index', [
            'app' => $app,
            'user_access' => $userAccess,
        ]);
    }

    public function whtRate(Request $request){

        $fmTitle = 'info';
        $fmMsg = 'Nothing to update';

        $userAccess = isSuperAdmin();
        if (empty($userAccess)){
            $fmTitle = 'error';
            $fmMsg = $this->accessDeniedMessage;
            session()->flash($fmTitle, $fmMsg);
            return redirect( route('backend.applicationSettings.index') );
        }

        $request->validate([
            'wht_rate' => ['required', 'numeric'],
        ]);

        $app = ApplicationSettings::find(1);
        $app->wht_rate = $request->wht_rate;
        $app->save();

        $fmTitle = 'success';
        $fmMsg = 'With Holding Tax Rate has been updated successfully';

        session()->flash($fmTitle, $fmMsg);
        return redirect( route('backend.applicationSettings.index') );
    }
}
