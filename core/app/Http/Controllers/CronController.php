<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\GeneralSetting;
use App\Models\Ticket;
use App\Models\Winner;
use App\Models\Phase;
use App\Models\Transaction;
use Carbon\Carbon;

class CronController extends Controller
{

    //Cron
    public function cron()
    {
        $phases = Phase::where('status', Status::ENABLE)->with('tickets', 'tickets.user', 'tickets.lottery', 'lottery.bonuses', 'tickets.phase', 'lottery')->where('draw_status', Status::RUNNING)->where('draw_type', Status::AUTO)->where('draw_date', '<=', Carbon::now())->get();

        $general = gs();
        $general->last_cron = Carbon::now();
        $general->save();

        foreach ($phases as $phase) {
            $lotteryBonus = $phase->lottery->bonuses;
            if ($phase->tickets->count() <= 0 && (clone $lotteryBonus)->count() <= 0) {
                continue;
            }
            $ticketNumber    = $phase->tickets->pluck('ticket_number');
            $winBonus        = clone $lotteryBonus;
            $getTicketNumber = $ticketNumber->shuffle()->take($winBonus->count());

            $allTickets = $phase->tickets;

            foreach ($getTicketNumber as $key => $numbers) {
                $ticket = (clone $allTickets)->where('ticket_number', $numbers)->first();
                $user   = $ticket->user;
                $bonus  = $winBonus[$key]->amount;

                $winner = new Winner();
                $winner->ticket_id     = $ticket->id;
                $winner->user_id       = $user->id;
                $winner->phase_id      = $phase->id;
                $winner->ticket_number = $numbers;
                $winner->level         = @$winBonus[$key]->level;
                $winner->win_bonus     = $bonus;
                $winner->save();

                $user->balance += $bonus;
                $user->save();

                $transaction =  new Transaction();
                $transaction->user_id      = $user->id;
                $transaction->amount       = getAmount($bonus);
                $transaction->charge       = 0;
                $transaction->trx_type     = '-';
                $transaction->details      = 'You are winner ' . $winBonus[$key]->level . ' of ' . @$ticket->lottery->name . ' of phase ' . @$ticket->phase->phase_number . ' ' . $phase->lottery->name;
                $transaction->trx          = getTrx();
                $transaction->remark       = 'win_bonus';
                $transaction->post_balance = $user->balance;
                $transaction->save();

                $ticket->status = Status::PUBLISHED;
                $ticket->save();

                if ($general->win_commission == Status::ENABLE) {
                    levelCommission($user->id, $bonus, 'win_commission');
                }

                notify($user, 'WIN_EMAIL', [
                    'lottery'  => $ticket->lottery->name,
                    'number'   => $numbers,
                    'amount'   => getAmount($bonus),
                    'level'    => @$winBonus[$key]->level,
                    'currency' => $general->cur_text
                ]);
            }

            $phase->draw_status = Status::COMPLETE;
            $phase->updated_at  = Carbon::now();
            $phase->save();
        }
        return 'Executed';
    }
}
