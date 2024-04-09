<?php

namespace App\Http\Livewire;

use App\Services\ChartService;
use App\Services\OrderService;
use App\Services\UserService;
use Carbon\Carbon;
use Livewire\Component;

class UserRegisterChart extends Component
{
    public string $from;
    public string $from_jalali;
    public string $to;
    public string $to_jalali;
    public array $chartData;
    public int $total;

    public function mount()
    {
        $this->from = now()->subDays(6);
        $this->to = now();
        $this->chartData = ['yAxis' => [], 'xAxis' => []];
        $this->total = 0;

        $this->applyFilters();
    }

    public function updatedFrom()
    {
        $this->from_jalali = Carbon::parse($this->from)->toJalali()->format('Y/m/d');
    }

    public function updatedTo()
    {
        $this->to_jalali = Carbon::parse($this->to)->toJalali()->format('Y/m/d');
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.user-register-chart', [
            'chartData' => $this->chartData
        ]);
    }

    public function applyFilters()
    {
        $this->updateDates();
        $this->chartData = ChartService::usersRegisterChart(from: $this->from, to: $this->to, format_date: 'm/d');
        $this->total = UserService::totalRegisterCount(from: $this->from, to: $this->to);
        $this->emit('chart-updated', ['chartData' => $this->chartData]);
    }

    public function updateDates()
    {
        $this->from_jalali = Carbon::parse($this->from)->toJalali()->format('Y/m/d');
        $this->to_jalali = Carbon::parse($this->to)->toJalali()->format('Y/m/d');
    }
}
