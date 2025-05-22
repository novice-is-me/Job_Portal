<script setup>
import { useForm } from "@inertiajs/vue3";
import { Button, DatePicker, Dialog, useToast } from "primevue";
import { ref } from "vue";

const props = defineProps({
    applicant: Object,
});

const toast = useToast();
const isDatePicker = ref(false);

const formatDate = (date) => {
    if (!date) return null;
    return new Date(date).toISOString().split("T")[0]; // Format to YYYY-MM-DD
};

const formatInterviewSchedule = (date) => {
    if (!date) return null;
    return new Date(date).toLocaleString("en-US", {
        year: "numeric",
        month: "short",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        hour12: true,
    });
};

const form = useForm({
    dateTime24h: null,
});

const scheduleInterview = () => {
    console.log("Schedule Interview clicked");
    isDatePicker.value = !isDatePicker.value;
};

const rejectApplicant = () => {
    console.log("Reject Applicant clicked");
};

const saveSchedInterview = () => {
    console.log(props.applicant);
    isDatePicker.value = false;

    form.post(
        route("dashboard.recruiter.submit.interview", {
            applicant_id: props.applicant.user.id,
            job_id: props.applicant.job.id,
        }),
        {
            onSuccess: () => {
                console.log("Interview scheduled successfully");
                toast.add({
                    severity: "success",
                    summary: "Success",
                    detail:
                        "Interview scheduled successfully! at " +
                        formatInterviewSchedule(form.dateTime24h),
                    life: 3000,
                });
                props.applicant.interview_at = form.dateTime24h;
            },

            onError: () => {
                console.log("Error scheduling interview");
            },
        }
    );
};
</script>

<template>
    <div class="rounded-lg space-y-4 md:mt-10">
        <div class="bg-white p-5 rounded-lg space-y-4 flex flex-col">
            <h1 class="text-2xl font-[Poppins] font-semibold">Actions</h1>

            <Button class="!bg-white !text-black" @click="scheduleInterview">
                <i class="pi pi-clock"></i>
                <p>Schedule Interview</p></Button
            >
            <Dialog v-model:visible="isDatePicker" header="Schedule Interview">
                <div class="flex flex-col items-center gap-y-4">
                    <DatePicker
                        id="datepicker-24hr"
                        v-model="form.dateTime24h"
                        showTime
                        hourFormat="24"
                        inline
                        class="custom-datepicker"
                    />
                    <Button @click="saveSchedInterview">Schedule</Button>
                </div>
            </Dialog>
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
                    <p>{{ formatDate(applicant.created_at) }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.invisible-datepicker .p-inputtext {
    opacity: 0;
    height: 0;
    padding: 0;
    margin: 0;
    border: none;
}
</style>
