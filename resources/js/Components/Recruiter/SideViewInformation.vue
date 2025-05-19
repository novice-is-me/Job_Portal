<script setup>
import { Button } from "primevue";

const props = defineProps({
    applicant: Object,
});

console.log(props.applicant);

const formatDate = (date) => {
    if (!date) return null;
    return new Date(date).toISOString().split("T")[0]; // Format to YYYY-MM-DD
};

const scheduleInterview = () => {
    console.log("Schedule Interview clicked");
};

const rejectApplicant = () => {
    console.log("Reject Applicant clicked");
};
</script>

<template>
    <div class="rounded-lg space-y-4 md:mt-10">
        <div class="bg-white p-5 rounded-lg space-y-4 flex flex-col">
            <h1 class="text-2xl font-[Poppins] font-semibold">Actions</h1>
            <Button class="!bg-white !text-black" @click="scheduleInterview">
                ><i class="pi pi-clock"></i>
                <p>Schedule Interview</p></Button
            >
            <Button @click="rejectApplicant">
                <i class="pi pi-times"></i>
                <p>Reject Applicant</p>
            </Button>
        </div>

        <div class="bg-white p-5 rounded-lg space-y-4">
            <h1 class="text-2xl font-[Poppins] font-semibold">
                Application Status
            </h1>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <p>Current Status</p>
                    <p
                        :class="[
                            'px-2 py-1 rounded-full',
                            applicant.is_applied
                                ? ' bg-blue-100'
                                : 'bg-red-200',
                        ]"
                    >
                        {{ applicant.is_applied ? "Applied" : "" }}
                    </p>
                </div>
                <div class="flex justify-between">
                    <p>Applied Date</p>
                    <p>{{ formatDate(applicant.job.created_at) }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
