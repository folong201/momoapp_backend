<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use App\Http\Requests\StoretransactionRequest;
use App\Http\Requests\UpdatetransactionRequest;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function transfert(Request $request){
        $trans = new transaction();
        $trans->sender = $request->sender;
        $trans->ammount = $request->ammount;

    }


}
