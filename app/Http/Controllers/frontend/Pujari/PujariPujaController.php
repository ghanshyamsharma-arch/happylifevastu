<?php

namespace App\Http\Controllers\Frontend\Pujari;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\SystemFlag;
use App\Models\Puja;
use App\Models\Pujapackage;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PujariPujaController extends Controller
{
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // GET /pujari-portal/puja/list   \u2192  front.puja-list
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function index()
    {
        $pujari = PujariAuthController::pujariAuthCheck();
        if (!$pujari) return redirect()->route('front.pujariLogin');

        $currency = SystemFlag::where('name', 'CurrencySymbol')->select('value')->first();

        $pujas = Puja::where('pujariId', $pujari->pujariId)
                     ->where('created_by', 'pujari')
                     ->orderBy('id', 'DESC')
                     ->get();

        return view('frontend.pujari.puja-list', compact('pujari', 'pujas', 'currency'));
    }

    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // GET /pujari-portal/puja/create  \u2192  front.puja-create
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function create()
    {
        $pujari = PujariAuthController::pujariAuthCheck();
        if (!$pujari) return redirect()->route('front.pujariLogin');

        $currency = SystemFlag::where('name', 'CurrencySymbol')->select('value')->first();
        $packages = Pujapackage::orderBy('title')->get();

        return view('frontend.pujari.puja-form', compact('pujari', 'currency', 'packages'));
    }

    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // GET /pujari-portal/puja/edit/{id}  \u2192  front.puja-edit
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function edit($id)
    {
        $pujari = PujariAuthController::pujariAuthCheck();
        if (!$pujari) return redirect()->route('front.pujariLogin');

        $puja = Puja::where('id', $id)
                    ->where('pujariId', $pujari->pujariId)
                    ->where('created_by', 'pujari')
                    ->firstOrFail();

        $currency = SystemFlag::where('name', 'CurrencySymbol')->select('value')->first();
        $packages = Pujapackage::orderBy('title')->get();

        return view('frontend.pujari.puja-form', compact('pujari', 'puja', 'currency', 'packages'));
    }

    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // POST /pujari-portal/puja/store  \u2192  front.store-puja
    // Handles both CREATE and UPDATE (if puja_id present in request)
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function store(Request $request)
    {
        $pujari = PujariAuthController::pujariAuthCheck();
        if (!$pujari) {
            return response()->json(['status' => 401, 'message' => 'Session expired. Please login again.'], 401);
        }

        $validator = Validator::make($request->all(), [
            'puja_title'          => 'required|string|max:200',
            'long_description'    => 'required|string',
            'puja_start_datetime' => 'required|date',
            'puja_duration'       => 'required|numeric|min:1',
            'puja_price'          => 'required|numeric|min:0',
            'puja_images.*'       => 'image|mimes:jpeg,png,jpg,gif,avif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error'  => $validator->errors(),
            ], 422);
        }

        try {
            DB::beginTransaction();

            // \u2500\u2500 Unique Slug \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
            $slug         = Str::slug($request->puja_title, '-');
            $originalSlug = $slug;
            $counter      = 1;

            $slugQuery = Puja::where('slug', $slug);
            if ($request->filled('puja_id')) {
                $slugQuery->where('id', '!=', $request->puja_id);
            }
            while ($slugQuery->exists()) {
                $slug      = $originalSlug . '-' . $counter++;
                $slugQuery = Puja::where('slug', $slug);
                if ($request->filled('puja_id')) {
                    $slugQuery->where('id', '!=', $request->puja_id);
                }
            }

            // \u2500\u2500 Date Calculation \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
            $startDt = Carbon::parse($request->puja_start_datetime);
            $endDt   = $startDt->copy()->addMinutes((int) $request->puja_duration);

            // \u2500\u2500 Image Handling \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
            $imagePaths = [];

            if ($request->filled('puja_id')) {
                // UPDATE \u2014 keep existing images first
                $existing   = Puja::where('id', $request->puja_id)
                                  ->where('pujariId', $pujari->pujariId)
                                  ->where('created_by', 'pujari')
                                  ->firstOrFail();

                // getRawOriginal bypasses accessor so we get raw stored paths
                $rawImages  = $existing->getRawOriginal('puja_images');
                $imagePaths = $rawImages ? json_decode($rawImages, true) : [];

                // Remove images marked for deletion
                if ($request->has('images_to_delete')) {
                    foreach ((array) $request->images_to_delete as $toDelete) {
                        if (file_exists(public_path($toDelete))) {
                            unlink(public_path($toDelete));
                        }
                        $imagePaths = array_values(
                            array_filter($imagePaths, fn($p) => $p !== $toDelete)
                        );
                    }
                }
            }

            // Add newly uploaded images
            if ($request->hasFile('puja_images')) {
                $dest = public_path('public/storage/images/puja_images');
                if (!file_exists($dest)) {
                    mkdir($dest, 0755, true);
                }
                foreach ($request->file('puja_images') as $file) {
                    $name         = time() . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                    $file->move($dest, $name);
                    $imagePaths[] = 'public/storage/images/puja_images/' . $name;
                }
            }

            // \u2500\u2500 Package IDs \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
            $packageIds = [];
            if ($request->has('package_ids')) {
                $packageIds = array_values(array_filter((array) $request->package_ids));
            }

            // \u2500\u2500 Puja Data \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
            $pujaData = [
                'pujariId'            => $pujari->pujariId,
                'created_by'          => 'pujari',
                'puja_title'          => $request->puja_title,
                'slug'                => $slug,
                'long_description'    => $request->long_description,
                'puja_start_datetime' => $request->puja_start_datetime,
                'puja_end_datetime'   => $endDt,
                'puja_duration'       => $request->puja_duration,
                'puja_place'          => $request->puja_place ?? 'Online',
                'puja_price'          => $request->puja_price,
                'package_id'          => $packageIds,
                'puja_images'         => $imagePaths,
                'isAdminApproved'     => 'Pending',   // always reset to Pending on edit
            ];

            if ($request->filled('puja_id')) {
                $existing->update($pujaData);
                $message = 'Puja updated successfully. Waiting for admin approval.';
            } else {
                Puja::create($pujaData);
                $message = 'Puja created successfully. Waiting for admin approval.';
            }

            DB::commit();

            return response()->json(['status' => 200, 'message' => $message]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // DELETE /pujari-portal/puja/delete/{id}  \u2192  front.puja-delete
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function destroy($id)
    {
        $pujari = PujariAuthController::pujariAuthCheck();
        if (!$pujari) return redirect()->route('front.pujariLogin');

        $puja = Puja::where('id', $id)
                    ->where('pujariId', $pujari->pujariId)
                    ->where('created_by', 'pujari')
                    ->firstOrFail();

        // Delete associated images from disk
        $rawImages = $puja->getRawOriginal('puja_images');
        $images    = $rawImages ? json_decode($rawImages, true) : [];
        foreach ($images as $img) {
            if (file_exists(public_path($img))) {
                unlink(public_path($img));
            }
        }

        $puja->delete();

        return redirect()->route('front.puja-list')->with('success', 'Puja deleted successfully.');
    }
}
"