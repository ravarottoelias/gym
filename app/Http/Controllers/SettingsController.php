<?php

namespace App\Http\Controllers;

use Exception;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $settings = \Utilities::getSettings();

        return view('settings.show', compact('settings'));
    }

    public function edit()
    {
        $settings = \Utilities::getSettings();

        return view('settings.edit', compact('settings'));
    }

    public function save(Request $request)
    {
        // Get All Inputs Except '_Token' to loop through and save
        $settings = $request->except('_token');

        // Update All Settings
        foreach ($settings as $key => $value) {
            if ($key == 'gym_logo') {
                try{
                    $value = \Utilities::uploadFile($request, $key, 'public');
                } catch(Exception $ex){
                    Log::error("Error al subir imagen.", $ex);
                }
            }

            Setting::where('key', '=', $key)->update(['value' => $value]);
        }

        flash()->success('Setting was successfully updated');

        return redirect('settings/edit');
    }
}
