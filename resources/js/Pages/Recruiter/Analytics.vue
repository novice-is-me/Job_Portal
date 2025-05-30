<script setup>
import { Head } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Chart from "primevue/chart";

import { ref, onMounted } from "vue";

onMounted(() => {
    chartData.value = setChartData();
    chartOptions.value = setChartOptions();
});

const chartData = ref();
const chartOptions = ref();

const setChartData = () => {
    const documentStyle = getComputedStyle(document.documentElement);

    return {
        labels: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
        ],
        datasets: [
            {
                type: "bar",
                label: "Dataset 1",
                backgroundColor: documentStyle.getPropertyValue("--p-cyan-500"),
                data: [50, 25, 12, 48, 90, 76, 42],
            },
            {
                type: "bar",
                label: "Dataset 2",
                backgroundColor: documentStyle.getPropertyValue("--p-gray-500"),
                data: [21, 84, 24, 75, 37, 65, 34],
            },
            {
                type: "bar",
                label: "Dataset 3",
                backgroundColor:
                    documentStyle.getPropertyValue("--p-orange-500"),
                data: [41, 52, 24, 74, 23, 21, 32],
            },
        ],
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
