<script setup>
import StatusComponent from "@/Components/Dashboard/Partials/StatusComponent.vue";
import ApplicationStatus from "./ApplicationStatus.vue";
import CategoriesComponent from "@/Components/Dashboard/Partials/CategoriesComponent.vue";
import { ProgressBar } from "primevue";
import { ref } from "vue";

const props = defineProps({
    application: Object,
});

const job = ref(props.application.job);
const statusApplication = ref(props.application.job_status.name);
const progressStep = ref("0");
const progressValue = ref(0);

const borderStyle = () => {
    return {
        "border-blue-500": statusApplication.value === "Interview",
        "border-green-500": statusApplication.value === "Reviewed",
        "border-red-500": statusApplication.value === "Rejected",
        "border-yellow-500": statusApplication.value === "Pending",
    };
};

const formatDate = (date) => {
    if (!date) return null;
    return new Date(date).toISOString().split("T")[0]; // Format to YYYY-MM-DD
};

if (statusApplication.value === "Interview") {
    progressStep.value = 3;
    progressValue.value = 100;
} else if (statusApplication.value === "Reviewed") {
    progressStep.value = 2;
    progressValue.value = 50;
} else if (statusApplication.value === "Pending") {
    progressStep.value = 1;
    progressValue.value = 25;
} else if (statusApplication.value === "Rejected") {
    progressValue.value = 100;
}
</script>

<template>
    <div
        :class="['bg-white border-l-4 rounded-lg p-6 space-y-4', borderStyle()]"
    >
        <div class="flex justify-between items-start gap-x-4">
            <div class="space-y-1">
                <h2
                    class="font-[Poppins] font-semibold text-lg flex items-center gap-x-3"
                >
                    {{ job.name }}
                    <span>
                        <ApplicationStatus :status="statusApplication" />
                    </span>
                </h2>

                <div class="space-y-3">
                    <div class="flex items-center gap-x-2">
                        <i class="pi pi-building"></i>
                        <p>{{ job.company.name }}</p>
                    </div>
                    <CategoriesComponent
                        :job_type="job.type"
                        :location_type="job.work_setup"
                        :salary="job.salary"
                    />
                </div>
            </div>
            <i class="pi pi-angle-down"></i>
        </div>
        <div class="space-y-3">
            <div
                class="flex justify-between items-center gap-x-4 text-sm font-medium"
            >
                <p>Application Progress</p>
                <p>{{ progressStep }} of 4 steps</p>
            </div>
            <ProgressBar
                class="text-sm"
                style="height: 15px"
                :value="progressValue"
            />
            <div class="flex items-center gap-x-2 text-secondary text-[11px]">
                <i class="pi pi-calendar"></i>
                <p>Applied on: {{ formatDate(job.created_at) }}</p>
            </div>
        </div>
    </div>
</template>
