<?php

namespace App\Http\Controllers;

use App\Record;
use App\Share;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    //
    public function getRecord ()
    {
        $records = DB::table('uploadRecords')
            ->join('users', 'uploadRecords.userId', '=', 'users.id')
            ->paginate(3);
        $reqs = DB::table('reqShares')
            ->where('status', 0)
            ->get();
        return view('record', compact('records', 'reqs'));
    }

    // acceptShare
    public function acceptShare($id){
        DB::table('reqShares')
            ->where('recordId','=',$id)
            ->where('status','=',0)
            ->update(['status'=>1]);

        $record = Record::find($id);
        $record->status = 1;
        $record->save();
        return redirect()->route('users.profile', Auth::user()->id);
    }
}
