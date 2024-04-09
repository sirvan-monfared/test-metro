<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <div class="row g-5 g-xl-6">
            <div class="col-6">
                <x-admin.card-minimal title="فیلترها">
                    <form wire:submit.prevent='applyFilters'>
                        <div class="form-div">
                            <label for="from_date">از: </label>
                            <input type="date" id="from_date" class="form-control ltr" wire:model.defer="from">
                            <p class="help-block">{{ $from_jalali }}</p>
                        </div>
                       <div class="form-div">
                            <label for="to_date">تا: </label>
                            <input type="date" id="to_date" class="form-control ltr" wire:model.defer="to">
                            <p class="help-block">{{ $to_jalali }}</p>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">اعمال</button>
                        </div>
                    </form>
                </x-admin.card-minimal>
            </div>
            <div class="col-6">
                <x-admin.card-minimal title="گزارشات">
                    <p class="fw-bolder fs-2 text-success">مجموع ثبت نام ها
                        <small class="px-3 fs-3 fw-bolder text-primary">(از {{ $from_jalali }} تا {{ $to_jalali }})</small>
                    </p>
                    <p class="fw-bolder text-dark fs-3hx">{!! number_format($total) !!} نفر </p>
                </x-admin.card-minimal>
            </div>
        </div>

        <div class="row g-5 g-xl-6">
            <div class="col-12" id="my-new-chart">
                <x-admin.card-minimal title="نمودار ثبت نام ها">
                    <div id="user-register-chart"></div>
                </x-admin.card-minimal>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        const options = {
            chart: {
                type: 'line',
                height: 300
            },
            series: [{
                name: 'تعداد',
                data: @json($chartData['yAxis'])
            }],
            xaxis: {
                categories: @json($chartData['xAxis'])
            }
        }

        const chart = new ApexCharts(document.querySelector("#user-register-chart"), options);

        chart.render();

        document.addEventListener('livewire:load', () => {
            @this.on('chart-updated', ({chartData}) => {
                chart.updateOptions({
                    series: [{
                        data: chartData.yAxis
                    }],
                    xaxis: {
                        categories: chartData.xAxis
                    }
                })
            })
        })
    </script>
@endpush
