<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\Language;
use App\Models\MstControl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SystemFlagController extends Controller
{
    public function getSystemFlag(Request $req)
    {
        try {
            if (Auth::guard('web')->check()) {
                $flagGroup = DB::table('flaggroup')->whereNull('parentFlagGroupId')->get();

                for ($i = 0; $i < count($flagGroup); $i++) {
                    $subGroup = DB::table('flaggroup')
                        ->where('viewenable', 1)
                        ->where('parentFlagGroupId', $flagGroup[$i]->id)
                        ->get();

                    if ($subGroup && count($subGroup) > 0) {
                        for ($j = 0; $j < count($subGroup); $j++) {
                            $systemFlag = DB::table('systemflag')
                                ->where('isActive', 1)
                                ->where('flagGroupId', $subGroup[$j]->id)
                                ->get();
                            $subGroup[$j]->systemFlag = $systemFlag;
                        }

                        $flagGroup[$i]->subGroup = $subGroup;

                        $systemFlag = DB::table('systemflag')
                            ->where('flagGroupId', $flagGroup[$i]->id)
                            ->get();
                        $flagGroup[$i]->systemFlag = $systemFlag;
                    } else {
                        $systemFlag = DB::table('systemflag')
                            ->where('flagGroupId', $flagGroup[$i]->id)
                            ->get();
                        $flagGroup[$i]->systemFlag = $systemFlag;
                        $flagGroup[$i]->subGroup = [];
                    }
                }
                $language = Language::query()->get();
                $mstData = MstControl::query()->get();
                $astroApiCallType = isset($mstData[0]) ? $mstData[0]->astro_api_call_type : null;

                return view('pages.system-flag', compact('flagGroup', 'language', 'astroApiCallType'));
            } else {
                return redirect('/admin/login');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function editSystemFlag(Request $req)
    {
        try {
            if (Auth::guard('web')->check()) {
                // Handle flaggroups (enable/disable subgroups)
                $flaggroups = $req->input('flaggroups');
                if ($flaggroups) {
                    foreach ($flaggroups as $subGroupId => $data) {
                        $isActive = $data['isActive'] ?? 0;
                        DB::table('flaggroup')
                            ->where('id', '=', $data['id'])
                            ->update(['isActive' => $isActive]);
                    }
                }

                // Process main groups and their system flags
                foreach ($req->group as $flag) {
                    // Process main system flags
                    if (array_key_exists('systemFlag', $flag) && count($flag['systemFlag']) > 0) {
                        foreach ($flag['systemFlag'] as $flagvalue) {
                            if (array_key_exists('value', $flagvalue)) {
                                // Handle storage provider selection
                                if ($flagvalue['name'] === 'storege_provider') {
                                    // Reset all providers to isActive = 0
                                    DB::table('flaggroup')
                                        ->whereIn('flagGroupName', ['google_bucket', 'aws_bucket', 'digital_ocean'])
                                        ->update(['isActive' => 0]);

                                    // Set selected provider to isActive = 1
                                    DB::table('flaggroup')
                                        ->where('flagGroupName', $flagvalue['value'])
                                        ->update(['isActive' => 1]);
                                }

                                // Process based on valueType
                                if (array_key_exists('valueType', $flagvalue)) {
                                    // Handle File uploads
                                    if ($flagvalue['valueType'] == 'File') {
                                        if (!empty($flagvalue['value']) && is_file($flagvalue['value'])) {
                                            $sysFile = DB::Table('systemflag')->where('name', $flagvalue['name'])->first();
                                            $time = Carbon::now()->timestamp;

                                            $destinationpath = public_path('storage/images/');

                                            // Create directory if it doesn't exist
                                            if (!File::isDirectory($destinationpath)) {
                                                File::makeDirectory($destinationpath, 0755, true);
                                            }

                                            $imageName = $flagvalue['name'];
                                            $fileName = $imageName . $time . '.png';
                                            $fullPath = $destinationpath . $fileName;

                                            // Delete old file if exists
                                            if ($sysFile && $sysFile->value && File::exists(public_path($sysFile->value))) {
                                                File::delete(public_path($sysFile->value));
                                            }

                                            // Read file content and save
                                            $fileContent = file_get_contents($flagvalue['value']);
                                            file_put_contents($fullPath, $fileContent);

                                            // Store relative path in database
                                            $flagvalue['value'] = 'public/storage/images/' . $fileName;
                                        }
                                    }

                                    // Handle MultiSelect (comma-separated)
                                    if ($flagvalue['valueType'] == 'MultiSelect') {
                                        $flagvalue['value'] = implode(',', $flagvalue['value']);
                                    }

                                    // Handle MultiSelectWebLang (JSON encoded)
                                    if ($flagvalue['valueType'] == 'MultiSelectWebLang') {
                                        $flagvalue['value'] = json_encode($flagvalue['value']);
                                    }

                                    // Handle Video uploads
                                    if ($flagvalue['valueType'] == 'Video') {
                                        // Check if value is a file or empty (disabled case)
                                        if (!empty($flagvalue['value']) && is_file($flagvalue['value'])) {
                                            $sysFile = DB::Table('systemflag')->where('name', $flagvalue['name'])->first();
                                            $time = Carbon::now()->timestamp;

                                            $destinationpath = public_path('storage/images/');

                                            // Create directory if it doesn't exist
                                            if (!File::isDirectory($destinationpath)) {
                                                File::makeDirectory($destinationpath, 0755, true);
                                            }

                                            $imageName = $flagvalue['name'];
                                            $fileName = $imageName . $time . '.mp4';
                                            $fullPath = $destinationpath . $fileName;

                                            // Delete old file if exists
                                            if ($sysFile && $sysFile->value && File::exists(public_path($sysFile->value))) {
                                                File::delete(public_path($sysFile->value));
                                            }

                                            // Read file content and save
                                            $fileContent = file_get_contents($flagvalue['value']);
                                            file_put_contents($fullPath, $fileContent);

                                            // Store relative path in database
                                            $flagvalue['value'] = 'public/storage/images/' . $fileName;
                                        } else {
                                            // Keep existing value if no new file uploaded
                                            $sysFile = DB::Table('systemflag')->where('name', $flagvalue['name'])->first();
                                            $flagvalue['value'] = $sysFile ? $sysFile->value : '';
                                        }
                                    }
                                }

                                // Update database
                                $flagData = array('value' => $flagvalue['value']);
                                DB::Table('systemflag')
                                    ->where('name', '=', $flagvalue['name'])
                                    ->update($flagData);
                            }
                        }
                    }

                    // Process subgroups and their system flags
                    if (array_key_exists('subGroup', $flag) && count($flag['subGroup']) > 0) {
                        foreach ($flag['subGroup'] as $flagvalue) {
                            foreach ($flagvalue['systemFlag'] as $sys) {
                                if (array_key_exists('value', $sys)) {
                                    // Process based on valueType
                                    if (array_key_exists('valueType', $sys)) {
                                        // Handle File uploads
                                        if ($sys['valueType'] == 'File') {
                                            if (!empty($sys['value']) && is_file($sys['value'])) {
                                                $sysFile = DB::Table('systemflag')->where('name', $sys['name'])->first();
                                                $time = Carbon::now()->timestamp;

                                                $destinationpath = public_path('storage/images/');

                                                // Create directory if it doesn't exist
                                                if (!File::isDirectory($destinationpath)) {
                                                    File::makeDirectory($destinationpath, 0755, true);
                                                }

                                                $imageName = $sys['name'];
                                                $fileName = $imageName . $time . '.png';
                                                $fullPath = $destinationpath . $fileName;

                                                // Delete old file if exists
                                                if ($sysFile && $sysFile->value && File::exists(public_path($sysFile->value))) {
                                                    File::delete(public_path($sysFile->value));
                                                }

                                                // Read file content and save
                                                $fileContent = file_get_contents($sys['value']);
                                                file_put_contents($fullPath, $fileContent);

                                                // Store relative path in database
                                                $sys['value'] = 'public/storage/images/' . $fileName;
                                            }
                                        }

                                        // Handle MultiSelect (comma-separated)
                                        if ($sys['valueType'] == 'MultiSelect') {
                                            $sys['value'] = implode(',', $sys['value']);
                                        }

                                        // Handle MultiSelectWebLang (JSON encoded)
                                        if ($sys['valueType'] == 'MultiSelectWebLang') {
                                            $sys['value'] = json_encode($sys['value']);
                                        }

                                        // Handle Video uploads
                                        if ($sys['valueType'] == 'Video') {
                                            // Check if value is a file or empty (disabled case)
                                            if (!empty($sys['value']) && is_file($sys['value'])) {
                                                $sysFile = DB::Table('systemflag')->where('name', $sys['name'])->first();
                                                $time = Carbon::now()->timestamp;

                                                $destinationpath = public_path('storage/images/');

                                                // Create directory if it doesn't exist
                                                if (!File::isDirectory($destinationpath)) {
                                                    File::makeDirectory($destinationpath, 0755, true);
                                                }

                                                $imageName = $sys['name'];
                                                $fileName = $imageName . $time . '.mp4';
                                                $fullPath = $destinationpath . $fileName;

                                                // Delete old file if exists
                                                if ($sysFile && $sysFile->value && File::exists(public_path($sysFile->value))) {
                                                    File::delete(public_path($sysFile->value));
                                                }

                                                // Read file content and save
                                                $fileContent = file_get_contents($sys['value']);
                                                file_put_contents($fullPath, $fileContent);

                                                // Store relative path in database
                                                $sys['value'] = 'public/storage/images/' . $fileName;
                                            } else {
                                                // Keep existing value if no new file uploaded
                                                $sysFile = DB::Table('systemflag')->where('name', $sys['name'])->first();
                                                $sys['value'] = $sysFile ? $sysFile->value : '';
                                            }
                                        }
                                    }

                                    // Update database
                                    $flagData = array('value' => $sys['value']);
                                    DB::Table('systemflag')
                                        ->where('name', '=', $sys['name'])
                                        ->update($flagData);
                                }
                            }
                        }
                    }
                }

                return response()->json([
                    'success' => 'SystemFlag Update',
                ]);
            } else {
                return redirect('/admin/login');
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
