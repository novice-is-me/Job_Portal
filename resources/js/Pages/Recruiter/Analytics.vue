<script setup>
import { Head } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Chart from "primevue/chart";

import { ref, onMounted } from "vue";
import { random } from "lodash";

const props = defineProps({
    user: Object,
    jobs: Object,
    applicantsPerJobMonthly: Object,
});

// console.log(props.user);
console.log(props.jobs);
console.log(props.applicantsPerJobMonthly);

onMounted(() => {
    chartData.value = setChartData();
    chartOptions.value = setChartOptions();
});

const chartData = ref();
const chartOptions = ref();

const setChartData = () => {
    const documentStyle = getComputedStyle(document.documentElement);

    const allMonths = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];

    const randomBackgroundColor = () => {
        const colors = [
            documentStyle.getPropertyValue("--p-cyan-500"),
            documentStyle.getPropertyValue("--p-gray-500"),
            documentStyle.getPropertyValue("--p-orange-500"),
            documentStyle.getPropertyValue("--p-green-500"),
            documentStyle.getPropertyValue("--p-red-500"),
            documentStyle.getPropertyValue("--p-purple-500"),
            documentStyle.getPropertyValue("--p-yellow-500"),
        ];
        return colors[Math.floor(Math.random() * colors.length)];
    };

    // Step 1: Map job IDs to job names
    const jobIdToName = Object.fromEntries(
        props.jobs.map((job) => [job.id, job.name])
    );

    // Step 2: Group applicant counts by job and month
    const grouped = {};
    props.applicantsPerJobMonthly.forEach((entry) => {
        const jobId = entry.job_id;
        const month = entry.month;
        const total = entry.total;

        if (!grouped[jobId]) {
            grouped[jobId] = {};
        }
        grouped[jobId][month] = total;
    });

    // Step 3: Convert to chart.js datasets format
    const datasets = Object.entries(grouped).map(([jobId, monthData]) => ({
        type: "bar",
        label: jobIdToName[jobId] || `Job ${jobId}`,
        backgroundColor: randomBackgroundColor(),
        data: allMonths.map((month) => monthData[month] || 0), // Fill 0 if no data
    }));

    return {
        labels: allMonths,
        datasets: datasets,
    };
};

const setChartOptions = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue("--p-text-color");
    const textColorSecondary = documentStyle.getPropertyValue(
        "--p-text-muted-color"
    );
    const surfaceBorder = documentStyle.getPropertyValue(
        "--p-content-border-color"
    );

    return {
        maintainAspectRatio: false,
        aspectRatio: 0.8,
        plugins: {
            tooltips: {
                mode: "index",
                intersect: false,
            },
            legend: {
                labels: {
                    color: textColor,
                },
            },
        },
        scales: {
            x: {
                stacked: true,
                ticks: {
                    color: textColorSecondary,
                },
                grid: {
                    color: surfaceBorder,
                },
            },
            y: {
                stacked: true,
                ticks: {
                    color: textColorSecondary,
                },
                grid: {
                    color: surfaceBorder,
                },
            },
        },
    };
};
</script>

<template>
    <Head title="Recruiter" />
    <AdminLayout>
        <div class="bg-gray-100 p-4">
            <div class="flex items-center justify-between gap-x-4 p-4">
                <p class="font-[Poppins] text-xl font-bold">
                    Analytics Dashboard
                </p>
            </div>

            <!-- Content -->
            <div class="space-y-4 bg-white p-4 rounded-lg shadow-md">
                <div>
                    <p class="font-[Poppins] text-lg font-bold">
                        Monthly Applications
                    </p>
                    <p class="text-secondary">
                        Stacked view of applications received per month for each
                        job position
                    </p>
                </div>
                <div class="card">
                    <Chart
                        type="bar"
                        :data="chartData"
                        :options="chartOptions"
                        class="h-[30rem]"
                    />
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
