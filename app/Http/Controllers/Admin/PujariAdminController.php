<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PujariModel\Pujari;
use App\Models\PujariModel\Pujapackage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PujariAdminController extends Controller
{
    public $limit = 15;

    // \u2500\u2500 Verified pujari list \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function getPujari(Request $req)
    {
        try {
            if (!Auth::guard('web')->check()) return redirect('/admin/login');

            $page            = $req->page ?? 1;
            $paginationStart = ($page - 1) * $this->limit;
            $searchString    = $req->searchString ?? null;
            $from_date       = $req->from_date ?? null;
            $to_date         = $req->to_date ?? null;

            $query = Pujari::where('isDelete', 0)->where('isVerified', 1);

            if ($searchString) {
                $query->where(function ($q) use ($searchString) {
                    $q->where('name', 'LIKE', "%$searchString%")
                      ->orWhere('contactNo', 'LIKE', "%$searchString%");
                });
            }
            if ($from_date && $to_date) {
                $query->whereBetween('created_at', [$from_date . ' 00:00:00', $to_date . ' 23:59:59']);
            }

            $totalRecords = $query->count();
            $pujaris      = $query->skip($paginationStart)->take($this->limit)->get();
            $totalPages   = ceil($totalRecords / $this->limit);
            $start        = $paginationStart + 1;
            $end          = min($paginationStart + $this->limit, $totalRecords);

            return view('pages.pujari', compact(
                'pujaris', 'searchString', 'totalPages', 'totalRecords',
                'start', 'end', 'page', 'from_date', 'to_date'
            ));
        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }

    // \u2500\u2500 Pending approval list \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function getPujariPendingRequest(Request $req)
    {
        try {
            if (!Auth::guard('web')->check()) return redirect('/admin/login');
            $pujaris = Pujari::where('isDelete', 0)->where('isVerified', 0)->orderBy('id', 'DESC')->get();
            return view('pages.pujari-pending', compact('pujaris'));
        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }

    // \u2500\u2500 Detail view \u2014 now includes puja packages \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function pujariDetailApi($id)
    {
        try {
            if (!Auth::guard('web')->check()) return redirect('/admin/login');

            $pujari = Pujari::with('user')->findOrFail($id);

            // Pujas created by this pujari
            $pujariPujas = Pujari::where('id', $id)
                            //   ->where('created_by', 'pujari')
                               ->orderByDesc('id')
                               ->get();

            // All available packages from admin
            $allPackages = Pujapackage::orderBy('puja_title')->get();

            $currency = DB::table('systemflag')->where('name', 'currencySymbol')->select('value')->first();

            return view('pages.pujari-detail', compact('pujari', 'pujariPujas', 'allPackages', 'currency'));

        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }

    // \u2500\u2500 Approve / reject puja (AJAX) \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function approvePuja(Request $request)
    {
        try {
            if (!Auth::guard('web')->check())
                return response()->json(['status' => 401, 'message' => 'Unauthorized']);

            $puja = Puja::where('id', $request->pujaId)
                        ->where('created_by', 'pujari')
                        ->firstOrFail();

            $puja->update(['isAdminApproved' => $request->status]); // 'Approved' or 'Rejected'

            return response()->json(['status' => 200, 'message' => 'Puja status updated']);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500 Add pujari page \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function addPujari()
    {
        return view('pages.add-pujari');
    }

    // \u2500\u2500 Edit pujari page \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function editPujari($id)
    {
        $pujari = Pujari::findOrFail($id);
        return view('pages.edit-pujari', compact('pujari'));
    }

    // \u2500\u2500 Store new pujari (admin adds) \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function addPujariApi(Request $req)
    {
        try {
            if (!Auth::guard('web')->check()) return response()->json(['status' => 401]);

            $data         = $req->except(['_token', 'profileImage', 'aadhar_card', 'pan_card', 'certificate']);
            $data['slug'] = Str::slug($req->name) . '-' . time();

            $dest = 'storage/pujari_files';
            if (!file_exists(public_path($dest))) mkdir(public_path($dest), 0755, true);

            foreach (['profileImage', 'aadhar_card', 'pan_card', 'certificate'] as $field) {
                if ($req->hasFile($field)) {
                    $file         = $req->file($field);
                    $name         = time() . rand() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path($dest), $name);
                    $data[$field] = $dest . '/' . $name;
                }
            }

            Pujari::create($data);
            return response()->json(['status' => 200, 'message' => 'Pujari added successfully']);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500 Update pujari (admin edits) \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function editPujariApi(Request $req)
    {
        try {
            if (!Auth::guard('web')->check()) return response()->json(['status' => 401]);

            $pujari = Pujari::findOrFail($req->id);
            $data   = $req->except(['_token', 'id', 'profileImage', 'aadhar_card', 'pan_card', 'certificate']);

            $dest = 'public/storage/pujari_files';
            foreach (['profileImage', 'aadhar_card', 'pan_card', 'certificate'] as $field) {
                if ($req->hasFile($field)) {
                    $file         = $req->file($field);
                    $name         = time() . rand() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path($dest), $name);
                    $data[$field] = $dest . '/' . $name;
                }
            }

            $pujari->update($data);
            return response()->json(['status' => 200, 'message' => 'Pujari updated']);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500 Verify / Reject pujari \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function verifiedPujariApi(Request $req)
    {
        try {
            Pujari::where('id', $req->id)->update(['isVerified' => $req->isVerified]);
            return response()->json(['status' => 200, 'message' => 'Status updated']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500 Delete pujari \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function deletePujari(Request $req)
    {
        try {
            Pujari::where('id', $req->id)->update(['isDelete' => 1]);
            return response()->json(['status' => 200, 'message' => 'Pujari deleted']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500 Toggle block/unblock \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function toggleBlockPujari(Request $req)
    {
        try {
            $pujari = Pujari::findOrFail($req->pujariId);
            $pujari->update(['isActive' => $pujari->isActive ? 0 : 1]);
            $msg = $pujari->isActive ? 'Pujari unblocked' : 'Pujari blocked';
            return response()->json(['status' => 200, 'message' => $msg]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }
}