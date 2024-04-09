<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Coupon;
use App\Services\UserPointsService;

class WheelOfFortuneController extends Controller
{
    private Campaign $campaign;

    public function __construct()
    {
        $this->campaign = Campaign::findBySlug('yalda-1402');
    }

    public function rotate()
    {
        if ($this->userAlreadyAttendedThisCampaign()) {
            return response()->json([
                'message' => 'شما قبلا در این گردونه شانس شرکت کرده اید'
            ], 403);
        }

        $prize_id = $this->shufflePrize();
        $prize = $this->mainPrizes()->where('id', $prize_id)->first();

        $delivery = $this->applyPrizeForUser($prize);
        $this->storeUserAttendance($prize, $delivery);

        return response()->json([
            'prize' => $prize,
            'delivery' => $delivery,
            'won' => true
        ]);
    }

    public function prizes()
    {
        $prizes = $this->mainPrizes()->map(function($prize) {
            unset($prize['probability']);
            $prize['color'] = $this->colors()[$prize['id'] - 1];

            return $prize;
        });

        $output['prizes'] = $prizes;

        if ($this->userAlreadyAttendedThisCampaign()) {
            $output['already_attended'] = true;
            $attendance = $this->userAttendance();
            $output['prize'] = [
                'title' => $attendance->prize_title,
                'description' => $attendance->prize_description
            ];
        }

        return response()->json($output);
    }

    private function userAlreadyAttendedThisCampaign() {
        if (! auth()->check()) return false;

        return $this->campaign->alreadyFinishedForUser(auth()->user());
    }

    private function userAttendance() {
        return $this->campaign->userAttendance(auth()->user());
    }

    private function applyPrizeForUser($prize) {
        if ($prize['slug'] === 'COURSE-OFF-10%') {
            $coupon = $this->findRelevantCoupon(10);
            return "کدتخفیف: {$coupon->code}";
        }
        if ($prize['slug'] === 'COURSE-OFF-20%') {
            $coupon = $this->findRelevantCoupon(20);
            return "کدتخفیف: {$coupon->code}";
        }
        if ($prize['slug'] === 'LARA-POINTS-50') {
            $this->addXpPoints(50);
            return "امتیاز بصورت خودکار به پنل شما اضافه میشود";
        }
        if ($prize['slug'] === 'LARA-POINTS-100') {
            $this->addXpPoints(100);
            return "امتیاز بصورت خودکار به پنل شما اضافه میشود";
        }

        return "جهت دریافت هدیه خود، از طریق صفحه ایسنتاگرام یا تلگرام با ما در ارتباط باشید";
    }

    private function findRelevantCoupon($percent)
    {
        return Coupon::findByCode("yalda-1402-{$percent}%");
    }

    private function addXpPoints($points)
    {
        UserPointsService::campaignPrize($this->campaign, auth()->user(), $points);
    }

    private function storeUserAttendance($prize, $delivery)
    {
        auth()->user()->campaigns()->attach($this->campaign->id, [
           'prize' => $prize['slug'],
           'prize_title' => $prize['text'],
           'prize_description' => $delivery,
           'prize_model' => null,
           'prize_model_id' => null
        ]);
    }

//
    private function shufflePrize() {
        $weights = $this->cumulativeProbabilities();

        $normalizedRandomNumber = mt_rand() / mt_getrandmax();
        $userScore = auth()->user()?->xp_points ?: 0;

        $adjustedNormalizedRandomNumber = ($normalizedRandomNumber / 1.05) + ($userScore / 8000);

        if ($adjustedNormalizedRandomNumber >= 1) {
            $adjustedNormalizedRandomNumber = 1;
        }

        foreach ($weights as $weight) {
            if ($adjustedNormalizedRandomNumber <= $weight['cumulative']) {
                return $weight['prize_id'];
            }
        }
    }

    private function cumulativeProbabilities()
    {
        $weights = collect([]);
        $cumulativeProbability = 0;

        foreach ($this->mainPrizes() as $prize) {
            $cumulativeProbability += $prize['probability'];
            $weights->add([
                'prize_id' => $prize['id'],
                'cumulative' => $cumulativeProbability
            ]);
        }

        return $weights;
    }

    private function mainPrizes()
    {
        return collect([
            ['id' => 1, 'probability' => 0.25, 'slug' => 'COURSE-OFF-10%',  'text' => "10% تخفیف",      'prize' => 'کد تخفیف 10 درصدی روی تمام دوره های سایت لاراپلاس'],
            ['id' => 2, 'probability' => 0.20, 'slug' => 'LARA-POINTS-50',  'text' => "50 امتیاز",      'prize' => '50 امتیاز لاراپلاس'],
            ['id' => 3, 'probability' => 0.15, 'slug' => 'LARA-POINTS-100', 'text' => "100 امتیاز",     'prize' => '100 امتیاز لاراپلاس'],
            ['id' => 4, 'probability' => 0.16, 'slug' => 'COURSE-OFF-20%',  'text' => "20% تخفیف",      'prize' => 'کد تخفیف 20 درصدی روی تمام دوره های سایت لاراپلاس'],
            ['id' => 5, 'probability' => 0.20, 'slug' => 'FREE_CONSULT',    'text' => "مشاوره رایگان",  'prize' => 'مشاوره رایگان با سیروان منفرد'],
            ['id' => 6, 'probability' => 0.01, 'slug' => 'CASH-150T',       'text' => "150 هزار تومان", 'prize' => '150 هزار تومان پول نقد'],
            ['id' => 7, 'probability' => 0.02, 'slug' => 'GIFT-BOOK',       'text' => "هدیه کتاب",      'prize' => 'هدیه ویژه کتاب به انتخاب سیروان منفرد'],
            ['id' => 8, 'probability' => 0.01, 'slug' => 'CASH-300T',       'text' => "300 هزار تومان", 'prize' => '300 هزار تومان پول نقد'],
        ]);
    }

    private function colors() {
        return ['#db7093',"#20b2aa", "#d63e92", "#daa520", "#ff340f", "#ff7f50", "#3cb371", "#4169e1"];
    }
}
