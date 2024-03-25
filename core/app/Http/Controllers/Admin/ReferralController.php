<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index()
    {
 
        $pageTitle = 'Manage Referrals';
        $referrals     = Referral::get();
        $commissionTypes = [
            'deposit_commission' => 'Deposit Commission',
            'buy_commission'     => 'Buy Commission',
            'win_commission'     => 'Win Commission',
        ];
        return view('admin.referral.index', compact('pageTitle', 'referrals', 'commissionTypes'));
    }



    public function update(Request $request)
    {
        $request->validate([
            'percent'         => 'required',
            'percent*'        => 'required|numeric',
            'commission_type' => 'required|in:deposit_commission,buy_commission,win_commission',
        ]);
        
        $type = $request->commission_type;
         Referral::where('commission_type', $type)->delete();
       
        
        for ($i = 0; $i < count($request->percent); $i++) {
            $referral                  = new Referral();
            $referral->level           = $i + 1;
            $referral->percent         = $request->percent[$i];
            $referral->commission_type = $request->commission_type;
            $referral->status          = 1;
            $referral->save();
        }

        $notify[] = ['success', 'Referral commission setting updated successfully'];
        return back()->withNotify($notify);
    }

    public function status($type)
    {
        $general = gs();
        if (@$general->$type == 1) {
            @$general->$type = 0;
        } else {
            @$general->$type = 1;
        }
        $general->save();
        $notify[] = ['success', 'Referral commission status updated successfully'];
        return back()->withNotify($notify);
    }
}
