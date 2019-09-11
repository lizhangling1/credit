<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Selection;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//20190909 test passing of url to php
use Session;

class LoanController extends Controller
{
    private $tools;

    public function __construct()
    {
        $this->tools = new ToolsController();
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'reason' => 'required|string',
            'amount' => 'required|numeric'
        ]);

        $user_id = Auth::id();

        if (!$user_id) {
            return response()->json([
                'code' => 201,
                'msg' => 'You are not logged in.'
            ]);
        }

        if (Auth::user()->is_loan) {
            return response()->json([
                'code' => 201,
                'msg' => "You can't apply for a loan again right now."
            ]);
        }

        $supportingPath = '';
        if ($request->exists('support')) { //用户上传了支持文档
            $fileData = $this->tools->fileUpdate($request->file('support'));

            if ($fileData[0]) {
                $supportingPath = $fileData[1];
            }
        }

        $attachmentsPath = '';
        if ($request->exists('attachments')) { //用户上传了支持文档
            $fileData = $this->tools->fileUpdate($request->file('attachments'));

            if ($fileData[0]) {
                $attachmentsPath = $fileData[1];
            }
        }

        DB::beginTransaction();
        try {
            $loanModel = new Loan();

            $loanModel->user_id = Auth::id();
            $loanModel->loanNo = $this->tools->getNo();
            $loanModel->reason = $request->input('reason');
            $loanModel->amount = $request->input('amount');
            $loanModel->step = 1;
            $loanModel->document = $supportingPath;
            $loanModel->attachment = $attachmentsPath;
            $loanModel->save();

            $userData = User::select('id', 'is_loan')->find($user_id);
            $userData->is_loan = 1;
            $userData->save();

            DB::commit();

            return response()->json([
                'code' => 200
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'code' => 201,
                'msg' => "Network anomaly."
            ]);
        }
    }

    function introduction()
    {
        $user = $this->getUser();
        return view('introduction', ['user' => $user]);
    }

    function process()
    {
        $user = $this->getUser();

        if (empty($user)) {
            return redirect('/login?q=/loan/introduce');
        }

        $selectionData = Selection::select('sort', 'value')->where('status', '=', 0)->get();

        foreach ($selectionData as $item) {
            $selectionDataOp[$item['sort']][] = $item->value;
        }

        $curStep = 0;
        if ($user) {
            $curStep = Loan::select('id', 'step')->where('user_id', $user->id)->first();
            if ($curStep) {
                $curStep = $curStep->step;
            }
        }

        return view('process', [
            'user' => $user,
            'selections' => $selectionDataOp,
            'step' => $curStep,
            'key' => Session::get('variableName')
        ]);
    }

    public function affirm()
    {
        $user = $this->getUser();

        if (empty($user)) {
            return redirect('/login?q=/loan/introduce');
        }

        return view('affirm', ['user' => $user]);
    }

    //进入下一步
    public function intoStep()
    {
        $user_id = Auth::id();

        if (!$user_id) {
            return response()->json([
                'code' => 201,
                'msg' => 'You are not logged in.'
            ]);
        }

        $loanData = Loan::select('id', 'step')->where('user_id', $user_id)->first();

        if (empty($loanData)) {
            return response()->json([
                'code' => 201,
                'msg' => "A system problem."
            ]);
        }

        $loanData->step += 1;
        if ($loanData->save()) {
            return response()->json([
                'code' => 200
            ]);
        }
    }

    //进入上一步
    public function intoPreStep()
    {
        $user_id = Auth::id();
        if (!$user_id) {
            return response()->json([
                'code' => 201,
                'msg' => 'You are not logged in.'
            ]);
        }

        $loanData = Loan::select('id', 'step')->where('user_id', $user_id)->first();

        if (empty($loanData)) {
            return response()->json([
                'code' => 201,
                'msg' => "A system problem."
            ]);
        }

        $loanData->step -= 1;
        if ($loanData->save()) {
            return response()->json([
                'code' => 200
            ]);
        }
    }

    //信用报告
    public function creditReport(Request $request)
    {
        if ($request->isMethod('POST')) {
            if ($this->tools->fileUpdate($request, 'report')) {
                return response()->json([
                    'code' => 200
                ]);
            }
        }
    }

    //20190909 test passing of url to php
    public function sessionAction(Request $request)
    {
        if ($request->isMethod('GET')) {
            //$request->session()->put('variableName', 'somethingishere');
            //$request->session()->put('key2', 'value2');
            //$request->session()->put('key3', 'value3');


            //$value = $request->session()->get('key');
            //$value = $request->session()->get('key2');
            //$value = $request->session()->get('key3');

            Session::put('variableName', 'myvalue');

            //error_log('Message: ' + Session::get('variableName'));


            return response()->json([
                'code' => 200,
                'name' => 'Abigail',
                'state' => 'CA'
            ]);

        }
        /*
     return response()->json([
     'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
     */
    }
}
