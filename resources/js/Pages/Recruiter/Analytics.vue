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
    applicantsPerStatus: Object,
});

const activeView = ref("application");

const viewApplications = () => {
    activeView.value = "application";
};

const viewPipeline = () => {
    activeView.value = "pipeline";
};

// Chart refs
const chartData = ref();
const chartOptions = ref();
const chartDataPipeline = ref();
const chartOptionsPipeline = ref();

// Unique color generator
const documentStyle = getComputedStyle(document.documentElement);
const baseColors = [
    documentStyle.getPropertyValue("--p-cyan-500"),
    documentStyle.getPropertyValue("--p-gray-500"),
    documentStyle.getPropertyValue("--p-orange-500"),
    documentStyle.getPropertyValue("--p-green-500"),
    documentStyle.getPropertyValue("--p-red-500"),
    documentStyle.getPropertyValue("--p-purple-500"),
    documentStyle.getPropertyValue("--p-yellow-500"),
    documentStyle.getPropertyValue("--p-blue-500"),
    documentStyle.getPropertyValue("--p-teal-500"),
    documentStyle.getPropertyValue("--p-pink-500"),
    documentStyle.getPropertyValue("--p-indigo-500"),
].sort(() => Math.random() - 0.5);

let colorIndex = 0;
const getUniqueColor = () => {
    if (colorIndex >= baseColors.length) {
        console.warn("All unique colors used. Repeating colors.");
        return "#000000";
    }
    return baseColors[colorIndex++];
};

// Setup chart data
onMounted(() => {
    chartData.value = setChartData();
    chartOptions.value = setChartOptions();
    chartDataPipeline.value = setChartDataPipeline();
    chartOptionsPipeline.value = setChartOptionsPipeline();
});

const setChartData = () => {
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

    const jobIdToName = Object.fromEntries(
        props.jobs.map((job) => [job.id, job.name])
    );

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

    const datasets = Object.entries(grouped).map(([jobId, monthData]) => ({
        type: "bar",
        label: jobIdToName[jobId] || `Job ${jobId}`,
        backgroundColor: getUniqueColor(),
        data: allMonths.map((month) => monthData[month] || 0),
    }));

    return {
        labels: allMonths,
        datasets,
    };
};

// Chart options
const setChartOptions = () => {
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
                ticks: { color: textColorSecondary },
                grid: { color: surfaceBorder },
            },
            y: {
                stacked: true,
                ticks: { color: textColorSecondary },
                grid: { color: surfaceBorder },
            },
        },
    };
};

const setChartDataPipeline = () => {
    const bodyStyle = getComputedStyle(document.body);

    const statusLabels = {
        1: "Pending",
        2: "Reviewed",
        3: "Rejected",
        4: "Interview",
    };
    const allLabels = ["Pending", "Reviewed", "Rejected", "Interview"];

    const datasetColors = [
        bodyStyle.getPropertyValue("--p-cyan-500"),
        bodyStyle.getPropertyValue("--p-orange-500"),
        bodyStyle.getPropertyValue("--p-gray-500"),
        bodyStyle.getPropertyValue("--p-green-500"),
    ];

    const hoverColors = [
        bodyStyle.getPropertyValue("--p-cyan-400"),
        bodyStyle.getPropertyValue("--p-orange-400"),
        bodyStyle.getPropertyValue("--p-gray-400"),
        bodyStyle.getPropertyValue("--p-green-400"),
    ];

    const statusTotals = {};
    props.applicantsPerStatus.forEach(({ status, total }) => {
        statusTotals[status] = (statusTotals[status] || 0) + total;
    });

    // Prepare data aligned with allLabels order
    const data = allLabels.map((label, index) => {
        // Find the status key from the statusLabels object
        const statusKey = Object.keys(statusLabels).find(
            (key) => statusLabels[key] === label
        );
        return statusTotals[statusKey] || 0;
    });

    return {
        labels: allLabels,
        datasets: [
            {
                data,
                backgroundColor: datasetColors,
                hoverBackgroundColor: hoverColors,
            },
        ],
    };
};

const setChartOptionsPipeline = () => {
    const textColor = documentStyle.getPropertyValue("--p-text-color");

    return {
        plugins: {
            legend: {
                labels: {
                    usePointStyle: true,
                    color: textColor,
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

            <div class="bg-gray-200 p-1 mb-4 inline-flex items-center gap-x-2">
                <p
                    class="bg-white px-3 rounded-md hover:cursor-pointer"
                    @click="viewApplications"
                >
                    Applications
                </p>
                <p
                    class="bg-white px-3 rounded-md hover:cursor-pointer"
                    @click="viewPipeline"
                >
                    Pipeline
                </p>
            </div>

            <!-- Content -->
            <div
                v-if="activeView === 'application'"
                class="space-y-4 bg-white p-4 rounded-lg shadow-md"
            >
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

            <div
                v-if="activeView === 'pipeline'"
                class="space-y-10 bg-white p-4 rounded-lg shadow-md"
            >
                <div>
                    <p class="font-[Poppins] text-lg font-bold">
                        Recruitment Funnel
                    </p>
                    <p class="text-secondary">
                        Conversion rates through each stage of the hiring
                        process
                    </p>
                </div>

                <div class="card flex justify-center items-center md:mt-10">
                    <Chart
                        type="pie"
                        :data="chartDataPipeline"
                        :options="chartOptionsPipeline"
                        class="w-full md:w-[30rem]"
                    />
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
