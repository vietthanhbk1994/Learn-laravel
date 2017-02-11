<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NiceAction;
use App\NiceActionLog;
use DB;

class NiceActionController extends Controller
{
    public function getHome() {
        //$actions = NiceAction::all();
        //$actions = NiceAction::all()->count();
        //$actions = NiceAction::all()->max('id);
//        $actions = DB::table('nice_actions')->get();
        $actions = NiceAction::orderBy('niceness','desc')->get();
        
        //$logged_actions = NiceActionLog::all();
        $logged_actions = NiceActionLog::paginate(2);
        
//        $logged_actions = NiceActionLog::whereHas('nice_action', function($query) {
//            $query->where('name', '=', 'kiss');
//        })->get();
        //dd($logged_actions);
//        $logged_actions = DB::table('nice_action_logs')
//                ->join('nice_actions',
//                        'nice_action_logs.nice_action_id',
//                        '=',
//                        'nice_actions.id')
//                ->where('nice_actions.name', '=', 'kiss')
//                ->get();
//        dd($logged_actions);
        //Insert
//        $query = DB::table('nice_action_logs')
//                    ->insertGetId([
//                        'nice_action_id' => DB::table('nice_actions')->select('id')->where('name', 'hug')->first()->id,
//                    ]);
//        dd($query);
        //Update
//        $hug = NiceAction::where('name', 'hug')->first();
//        $hug->name = "smile";
//        $hug->update();
//        dd($hug);
//        $hug->delete();
        
        return view('home', [
            'actions' => $actions,
            'logged_actions' => $logged_actions,
        ]);
    }
    
    public function getNiceAction($action, $name = null) {
        if ($name == null) {
            $name = 'you';
        }
        $nice_action = NiceAction::where('name', $action)->first();
        $nice_action_log = new NiceActionLog();
        $nice_action->logged_actions()->save($nice_action_log);

        return view('action.nice', [
            'nice_action'    => $nice_action,
            'name'      => $name
        ]);
    }
    
    public function postInsertNiceAction(Request $request) {
        $this->validate($request, [
            'name' => 'required|alpha|unique:nice_actions',
            'niceness' => 'required|numeric'
        ]);
        
        $action = new NiceAction();
        $action->name = $request['name'];
        $action->niceness = $request['niceness'];
        $action->save();
        
        if ($request->ajax()) {
           return response()->json(); 
        }
        
        return redirect(route('home'));
    }
    
    private function transformName($name) {
        $prefix = "KING ";
        return $prefix . strtoupper($name);
    }
}
