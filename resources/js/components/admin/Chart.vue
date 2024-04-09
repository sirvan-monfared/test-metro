<template>
    <apex-chart :type="type" :options="options" :series="series"></apex-chart>
</template>
<script>
import { toRefs } from "vue";
import VueApexCharts from "vue3-apexcharts";

export default {
    components: {
        'apex-chart': VueApexCharts
    },
    props: {
        type: {
            type: String,
            default: 'line'
        },
        options: {
            type: Object,
            required: false
        },
        xaxis: {
            type: Array,
            required: false,
            default: []
        },
        yaxis: {
            type: Array,
            required: true
        },
        format: {
            type: Boolean,
            default: true
        }
    },
    setup(props) {
        const { xaxis, yaxis, format } = toRefs(props);

        const formatter = (value) => {
            return format.value ? value.toLocaleString('en-us') : value;
        }

        return {
            options: {
                chart: {
                    id: 'vuechart-example'
                },
                xaxis: {
                    categories: xaxis.value,
                    labels: {
                        show: true,
                        rotate: 90,
                        rotateAlways: false,
                        hideOverlappingLabels: true,
                        showDuplicates: false,
                        trim: false,
                        minHeight: undefined,
                        maxHeight: 120,
                        style: {
                            colors: [],
                            fontSize: '12px',
                            fontFamily: 'Helvetica, Arial, sans-serif',
                            fontWeight: 400,
                            cssClass: 'apexcharts-xaxis-label',
                        },
                        offsetX: 0,
                        offsetY: 0,
                        format: undefined,
                        formatter: undefined,
                        datetimeUTC: true,
                        datetimeFormatter: {
                            year: 'yyyy',
                            month: "MMM 'yy",
                            day: 'dd MMM',
                            hour: 'HH:mm',
                        },
                    },
                },
                yaxis: {
                    show: true,
                    labels: {
                        show: true,
                        align: 'right',
                        minWidth: 0,
                        maxWidth: 160,
                        offsetX: -50,
                        offsetY: 0,
                        rotate: 0,
                        formatter: (value) => { return formatter(value) }
                    }
                },
                
                dataLabels: {
                    enabled: false,
                }
            },
            series: [{
                data: yaxis.value
            }]
        }
    }

}
</script>