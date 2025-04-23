<script setup>
import { Button } from "primevue";

const props = defineProps({
    job: Object,
    job_application: Object,
});

const formatSalary = (salary) => {
    if (salary >= 1000) {
        return `$${salary / 1000}k`;
    }
};
</script>

<template>
    <div class="bg-white p-4 rounded-lg space-y-6 flex flex-col">
        <h1 class="font-[Poppins] text-lg font-semibold">Job Summary</h1>
        <div class="space-y-6 border-b border-gray-200 pb-4">
            <div class="flex justify-between items-center gap-x-4">
                <div class="flex items-center gap-x-2">
                    <i class="pi pi-dollar"></i>
                    <p>Salary</p>
                </div>
                <p class="font-semibold">{{ formatSalary(job.salary) }}</p>
            </div>
            <div class="flex justify-between items-center gap-x-4">
                <div class="flex items-center gap-x-2">
                    <i class="pi pi-briefcase"></i>
                    <p>Job Type</p>
                </div>
                <p class="font-semibold">{{ job.type }}</p>
            </div>
            <div class="flex justify-between items-center gap-x-4">
                <div class="flex items-center gap-x-2">
                    <i class="pi pi-map-marker"></i>
                    <p>Location</p>
                </div>
                <p class="font-semibold">{{ job.work_setup }}</p>
            </div>
            <div class="flex justify-between items-center gap-x-4">
                <div class="flex items-center gap-x-2">
                    <i class="pi pi-graduation-cap"></i>
                    <p>Experience</p>
                </div>
                <p class="font-semibold">{{ job.experience.name }}</p>
            </div>
        </div>
        <Button :disabled="job_application">Apply Now</Button>
    </div>
</template>
