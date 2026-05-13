<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Exception;
// use Illuminate\Support\Facades\File;

class StorageHelper
{
    /**
     * Upload file to active external storage or fallback to local.
     *
     * @param string $fileContent Binary content of the file
     * @param string $fileName Name of the file (e.g., user_123.png)
     * @param string $type Optional folder type: 'profile', 'blog', 'document', etc.
     * @return string Full public URL (for external storage) or relative path (for local)
     * @throws Exception
     */
  public function addBannerApi(Request $req)
{
    try {
        if (Auth::guard('web')->check()) {

            // Step 1: Validate inputs
            $req->validate([
                'fromDate' => 'required|date',
                'toDate' => 'required|date',
                'bannerTypeId' => 'required|integer',
                'bannerImage' => 'nullable|file|max:5120',
            ]);

            // Step 2: Create banner record first (to get ID)
            $banner = Banner::create([
                'bannerImage' => '',
                'fromDate' => $req->fromDate,
                'toDate' => $req->toDate,
                'bannerTypeId' => $req->bannerTypeId,
                'createdBy' => Auth()->user()->id,
                'modifiedBy' => Auth()->user()->id,
            ]);

            $path = null;

            // Step 3: Handle image upload - DIRECT SAVE
            if ($req->hasFile('bannerImage')) {
                $file = $req->file('bannerImage');
                $fileName = 'banner_' . $banner->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                
                // Create directory if it doesn't exist
                $destinationPath = public_path('storage/banners');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                
                // Move the file directly - NO StorageHelper
                $file->move($destinationPath, $fileName);
                $path = 'storage/banners/' . $fileName;
            }

            // Step 4: Update banner record with image path
            $banner->bannerImage = $path;
            $banner->save();

            return redirect()->route('banners')->with('success', 'Banner added successfully!');
        } else {
            return redirect(LOGINPATH);
        }

    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }
}
}
