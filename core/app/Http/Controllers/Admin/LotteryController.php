<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Models\Lottery;
use App\Http\Controllers\Controller;
use App\Models\Phase;
use App\Models\WinBonus;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use HTMLPurifier;

class LotteryController extends Controller
{
    public function index()
    {
        $pageTitle = "All Lotteries";
        $lotteries = Lottery::searchable(['name'])->orderBy('name')->with('phase')->paginate(getPaginate());
        return view('admin.lottery.index', compact('pageTitle', 'lotteries'));
    }

    public function form()
    {
        $pageTitle = "Add Lottery";
        return view('admin.lottery.form', compact('pageTitle'));
    }

    public function store(Request $request, $id = 0)
    {

        $this->validation($request, $id);

        if ($id) {
            $lottery = Lottery::findOrFail($id);
            $notification = 'Lottery updated successfully';
            $route = 'admin.lottery.edit';
        } else {
            $lottery = new Lottery();
            $notification = 'Lottery added successfully';
            $route = 'admin.lottery.win.bonus';
        }
        $this->saveLottery($lottery, $request);
        $notify[] = ['success', $notification];
        return to_route($route, $lottery->id)->withNotify($notify);
    }
    protected function validation($request, $id = 0)
    {
        $imgValidation = 'required';
        if ($id) $imgValidation = 'nullable';
        $request->validate([
            'name'        => 'required',
            'price'       => 'required|numeric|gt:0',
            'instruction' => 'required',
            'image'       => [$imgValidation, new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
    }

    protected function saveLottery($lottery, $request)
    {
        $purifier = new HTMLPurifier();
        $instruction = $purifier->purify($request->instruction);

        if ($request->hasFile('image')) {
            try {
                $oldImage = $lottery->image;
                $filename = fileUploader($request->image, getFilePath('lottery'), getFileSize('lottery'), $oldImage);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload lottery image'];
                return back()->withNotify($notify);
            }
        } else {
            $filename = $lottery->image;
        }
        $lottery->image  = $filename;

        $lottery->name       = $request->name;
        $lottery->price       = $request->price;
        $lottery->instruction = $instruction;
        $lottery->save();
    }

    public function status($id)
    {
        return Lottery::changeStatus($id);
    }

    public function edit($id)
    {
        $lottery = Lottery::findOrFail($id);
        $pageTitle = "Edit Lottery" . ' ' . $lottery->name;
        return view('admin.lottery.form', compact('lottery', 'pageTitle'));
    }

    public function winBonus($id)
    {
        $lottery = Lottery::find($id);
        $pageTitle = "Set Win Bonus For " . $lottery->name;
        return view('admin.lottery.win_bonus', compact('lottery', 'pageTitle'));
    }

    public function bonus(Request $request)
    {
        $this->validate($request, [
            'level.*'    => 'required|integer|min:1',
            'amount'     => 'array',
            'amount.*'   => 'required|numeric',
            'lottery_id' => 'required|exists:lotteries,id',
        ]);
        WinBonus::where('lottery_id', $request->lottery_id)->delete();

        $winBonuses = [];
        foreach ($request->amount as $key => $amount) {
            $winBonus     = [];
            $winBonus['level']      = $key + 1;
            $winBonus['amount']     = $amount;
            $winBonus['lottery_id'] = $request->lottery_id;
            $winBonus['status']     = Status::ENABLE;
            $winBonus['created_at'] = now();
            $winBonus['updated_at'] = now();
            $winBonuses[]             = $winBonus;
        }
        WinBonus::insert($winBonuses);
        $notify[] = ['success', 'Win bonus set Successfully'];
        return back()->withNotify($notify);
    }

    public function phases()
    {
        $pageTitle = "Lottery Phases";
        $lotteries = Lottery::withCount(['phase as isRunning' => function ($q) {
            return $q->where('draw_status', Status::RUNNING);
        }])->get();
        $phases = Phase::with('lottery')->searchable(['lottery:name'])->dateFilter('start_date')->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.lottery.phases', compact('pageTitle', 'lotteries', 'phases'));
    }

    public function phaseStore(Request $request, $id = 0)
    {
        $request->validate([
            'lottery_id' => 'required',
            'start_date' => 'required',
            'draw_date'  => 'required|after:today|after:start_date',
            'quantity'   => 'required|integer|min:1',
            'draw_type'  => 'required',
        ]);
        if ($id) {
            $phase      = Phase::findOrFail($id);
            $notification = 'Lottery phase updated successfully';
            if ($request->quantity < $phase->sold) {
                $notify[] = ['error', 'Quantity must be greater than sold ticket'];
                return back()->withNotify($notify);
            }
        } else {
            $phase = new Phase();
            $notification = 'Lottery phase added successfully';
            $exist = Phase::where('lottery_id', $request->lottery_id)->where('draw_status', 0)->exists();
            if ($exist) {
                $notify[] = ['error', 'Another phase is running for this lottery'];
                return back()->withNotify($notify);
            }
        }
        $lottery = Lottery::withCount('bonuses')->withCount('phase')->findOrFail($request->lottery_id);
        if ($lottery->bonuses_count < 1) {
            $notify[] = ['error', 'Create lottery bonus first'];
            return back()->withNotify($notify);
        }
        $startDate           = Carbon::parse($request->start_date)->toDateTimeString();
        $drawDate            = Carbon::parse($request->draw_date)->toDateTimeString();
        $phase->lottery_id   = $request->lottery_id;
        $phase->phase_number = $lottery->phase_count + 1;
        $phase->start_date   = $startDate;
        $phase->draw_date    = $drawDate;
        $phase->quantity     = $request->quantity;
        $phase->available    = $request->quantity - $phase->sold;
        $phase->draw_type    = $request->draw_type;
        $phase->save();
        $notify[]           = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function phaseStatus($id)
    {
        return Phase::changeStatus($id);
    }

    public function lotteryPhase($lottery_id)
    {
        $lottery       = Lottery::withCount(['phase as isRunning' => function ($q) {
            return $q->where('draw_status', Status::RUNNING);
        }])->findOrFail($lottery_id);
        $phases        = Phase::where('lottery_id', $lottery_id)->dateFilter('start_date')->with('lottery')->latest('id')->paginate(getPaginate());
        $pageTitle     = "Lottery Phase: " . $lottery->name;
        $lotteries     = Lottery::orderBy('name')->get();
        $isRunning  = $lottery->isRunning;
        return view('admin.lottery.phases', compact('pageTitle', 'lottery', 'phases', 'lotteries', 'isRunning'));
    }
}
