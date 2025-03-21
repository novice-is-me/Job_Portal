<script setup>
import StatusComponent from "@/Components/Dashboard/Partials/StatusComponent.vue";
import ApplicationStatus from "./ApplicationStatus.vue";
import CategoriesComponent from "@/Components/Dashboard/Partials/CategoriesComponent.vue";
import { ProgressBar } from "primevue";
import { ref } from "vue";

const statusApplication = ref("Interview");

const borderStyle = () => {
    return {
        "border-blue-500": statusApplication.value === "Interview",
        "border-green-500": statusApplication.value === "Reviewed",
        "border-red-500": statusApplication.value === "Rejected",
        "border-yellow-500": statusApplication.value === "Pending",
    };
};
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
                    Senior UX Design
                    <span>
                        <ApplicationStatus :status="statusApplication" />
                    </span>
                </h2>

                <div class="space-y-3">
                    <div class="flex items-center gap-x-2">
                        <i class="pi pi-building"></i>
                        <p>DesignHub Co</p>
                    </div>
                    <CategoriesComponent
                        :job_type="'Full Time'"
                        :location_type="'Remote'"
                        :salary="140000"
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
                <p>3 of 4 steps</p>
            </div>
            <ProgressBar class="text-sm" style="height: 15px" />
            <div class="flex items-center gap-x-2 text-secondary text-[11px]">
                <i class="pi pi-calendar"></i>
                <p>Applied on June 12, 2023</p>
            </div>
        </div>
    </div>
</template>
