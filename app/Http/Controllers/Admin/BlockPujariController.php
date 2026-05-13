<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PujariModel\BlockPujari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class BlockPujariController extends Controller
{
    public $limit = 15;

    /**
     * List all blocked pujari records (admin view).
     */
    public function getBlockPujari(Request $request)
    {
        try {
            if (!Auth::guard('web')->check()) return redirect('/admin/login');

            $page            = $request->page ?? 1;
            $paginationStart = ($page - 1) * $this->limit;
            $searchString    = $request->searchString ?? null;

            $query = DB::table('block_pujari')
                ->join('users',   'users.id',    '=', 'block_pujari.userId')
                ->join('pujaris', 'pujaris.id',  '=', 'block_pujari.pujariId')
                ->select(
                    'block_pujari.*',
                    'users.name as userName',
                    'users.profile',
                    'users.contactNo as userContactNo',
                    'pujaris.name as pujariName',
                    'pujaris.contactNo as pujariContactNo',
                    'pujaris.profileImage'
                );

            if ($searchString) {
                $query->where(function ($q) use ($searchString) {
                    $q->where('pujaris.name',      'LIKE', "%$searchString%")
                      ->orWhere('pujaris.contactNo', 'LIKE', "%$searchString%")
                      ->orWhere('users.name',        'LIKE', "%$searchString%")
                      ->orWhere('users.contactNo',   'LIKE', "%$searchString%");
                });
            }

            $totalRecords = $query->count();
            $reportBlocks = $query->skip($paginationStart)->take($this->limit)->orderByDesc('block_pujari.id')->get();
            $totalPages   = ceil($totalRecords / $this->limit);
            $start        = $paginationStart + 1;
            $end          = min($paginationStart + $this->limit, $totalRecords);

            return view('pages.blocked-pujaris', compact(
                'reportBlocks', 'searchString', 'totalPages',
                'totalRecords', 'start', 'end', 'page'
            ));

        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }

    /**
     * Toggle block status for a pujari from admin.
     * POST: { pujariId }
     */
    public function toggleBlockPujari(Request $request)
    {
        try {
            $exists = DB::table('block_pujari')
                ->where('pujariId', $request->pujariId)
                ->whereNull('userId') // admin block has no userId
                ->exists();

            if ($exists) {
                DB::table('block_pujari')
                    ->where('pujariId', $request->pujariId)
                    ->whereNull('userId')
                    ->delete();

                // Set isActive = 1
                DB::table('pujaris')->where('id', $request->pujariId)->update(['isActive' => 1]);

                return response()->json(['status' => 200, 'message' => 'Pujari unblocked successfully', 'action' => 'unblocked']);
            } else {
                DB::table('block_pujari')->insert([
                    'pujariId'   => $request->pujariId,
                    'userId'     => null,
                    'reason'     => $request->reason ?? 'Blocked by admin',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Set isActive = 0
                DB::table('pujaris')->where('id', $request->pujariId)->update(['isActive' => 0]);

                return response()->json(['status' => 200, 'message' => 'Pujari blocked successfully', 'action' => 'blocked']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove a specific user-block record.
     * DELETE: { id }
     */
    public function deleteBlockRecord(Request $request)
    {
        try {
            DB::table('block_pujari')->where('id', $request->id)->delete();
            return response()->json(['status' => 200, 'message' => 'Block record removed']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }
}