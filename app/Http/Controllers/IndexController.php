<?php

namespace App\Http\Controllers;

use App\Loan;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class IndexController extends Controller
{
    function index()
    {
        $user = $this->getUser();
        $loan = null;
        if ($user) {
            $loan = Loan::where('user_id', $user->id)->first();
        }

        return view('index', [
            'user' => $user,
            'loan' => $loan
        ]);
    }
}
