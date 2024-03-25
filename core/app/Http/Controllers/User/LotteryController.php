<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Phase;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\Winner;
use Illuminate\Http\Request;

class LotteryController extends Controller
{

    public function lottery()
    {
        $pageTitle = "All Lotteries";
        $phases = Phase::available()->latest('draw_date')->with(['lottery'])->paginate(getPaginate());
        return view($this->activeTemplate . 'user.lottery.index', compact('pageTitle', 'phases'));
    }

    public function lotteryDetails($id)
    {
        $phase     = Phase::available()->findOrFail($id);
        $pageTitle = " Details of" . ' ' . $phase->lottery->name;
        $tickets   = Ticket::where('user_id', auth()->user()->id)->where('lottery_id', $phase->lottery_id)->with('phase')->orderByDesc('id')->paginate(getPaginate());
        $layout    = 'master';
        return view($this->activeTemplate . 'user.lottery.details', compact('pageTitle', 'phase', 'tickets', 'layout'));
    }
    public function buyTicket(Request $request)
    {
        $request->validate([
            'lottery_id' => 'required',
            'number'     => 'required|array',
            'number.*'   => 'required|numeric|gt:0',
        ], [
            'number.*.required' => 'All Ticket number Field is required',
        ]);
        $ticketQuantity = collect($request->number)->count();
        $phase          = Phase::available()->findOrFail($request->phase_id);
        $totalPrice     = $phase->lottery->price * $ticketQuantity;
        $user           = auth()->user();
        if ($phase->available < $ticketQuantity) {
            $notify[] = ['error', 'Oops! Ticket quantity is not available.'];
            return back()->withNotify($notify);
        }
        if ($user->balance < $totalPrice) {
            $notify[] = ['error', 'Oops! Insufficient balance.'];
            return back()->withNotify($notify);
        }
        $tickets = [];
        foreach ($request->number as $ticketNo) {
            $ticketAvailability = Ticket::where('ticket_number', $ticketNo)->first();
            if ($ticketAvailability) {
                $notify[] = ['error', $ticketAvailability->ticket_number . ' - ' . 'Ticket already sold please try another.'];
                return back()->withNotify($notify);
            }
            $ticket          = [];
            $ticket['lottery_id']    = $request->lottery_id;
            $ticket['phase_id']      = $request->phase_id;
            $ticket['user_id']       = $user->id;
            $ticket['ticket_number'] = $ticketNo;
            $ticket['total_price']   = $phase->lottery->price;
            $ticket['status']        = Status::UNPUBLISHED;
            $ticket['created_at']    = now();
            $ticket['updated_at']    = now();
            $tickets[]                = $ticket;
        }
        Ticket::insert($tickets);
        $user->balance -= $totalPrice;
        $user->save();
        $phase->available -= $ticketQuantity;
        $phase->sold      += $ticketQuantity;
        $phase->save();
        $transaction               = new Transaction();
        $transaction->user_id      = auth()->user()->id;
        $transaction->amount       = getAmount($totalPrice);
        $transaction->charge       = 0;
        $transaction->trx_type     = '-';
        $transaction->details      = 'Payment from user balance for ' . $ticketQuantity . ' ticket of lottery ' . $phase->lottery->name;
        $transaction->trx          = getTrx();
        $transaction->remark       = 'buy_ticket';
        $transaction->post_balance = auth()->user()->balance;
        $transaction->save();


        $general = gs();
        if ($general->buy_commission == 1) {
            levelCommission($user->id,  $totalPrice, 'buy_commission');
        }
        notify($user, 'BUY_LOTTERY', [
            'lottery_name'  => $phase->lottery->name,
            'quantity'      => $ticketQuantity,
            'price'         => getAmount($phase->lottery->price),
            'total_price'    => getAmount($totalPrice),
            'draw_date'     => $phase->draw_date,
            'site_currency' => $general->cur_text
        ]);
        $notify[] = ['success', 'Ticket purchased successfully'];
        return back()->withNotify($notify);
    }

    public function tickets()
    {
        $pageTitle = 'Purchased Tickets';
        $tickets   = Ticket::where('user_id', auth()->user()->id)->with('lottery', 'phase')->orderByDesc('id')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.lottery.tickets', compact('pageTitle', 'tickets'));
    }

    public function wins()
    {
        $pageTitle = 'Total Wins';
        $wins      = Winner::where('user_id', auth()->user()->id)->with('tickets', 'tickets.phase', 'tickets.lottery')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.lottery.wins', compact('pageTitle', 'wins'));
    }
}
