<?php

namespace App\Http\Controllers;

use App\Exports\ExpertSessions;
use App\Exports\SessionReport;
use App\Exports\SessionExport;
use App\Exports\UserSessions;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function sessions()
    {
        return Excel::download(new SessionExport, 'sessions.xlsx');
    }
    public function sessions_export($url, $id)
    {
        $month = $_GET['month'] ?? null;
        return Excel::download(new ExpertSessions($url, $id, $month), date('Y-m-d H:i:s') . 'expert_sessions.xlsx');
    }
    public function sessions_report_exports(Request $request){
        $fdate = $request->fdate ?? '2020-01-01';
        $tdate = $request->tdate ?? date('Y-m-d');
        return Excel::download(new SessionReport($fdate, $tdate), 'sessions_report.xlsx');
    }
    public function user_sessions_exports(Request $request){
        $fdate = $request->fdate ?? '2020-01-01';
        $tdate = $request->tdate ?? date('Y-m-d');
        return Excel::download(new UserSessions($fdate, $tdate), 'user_sessions_report.xlsx');
    }
}
