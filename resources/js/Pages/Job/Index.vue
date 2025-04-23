<script setup>
import JobComponent from "@/Components/Dashboard/JobComponent.vue";
import CategoriesComponent from "@/Components/Dashboard/Partials/CategoriesComponent.vue";
import StatusComponent from "@/Components/Dashboard/Partials/StatusComponent.vue";
import JobDetails from "@/Components/Job/JobDetails.vue";
import JobSummaryDetails from "@/Components/Job/JobSummaryDetails.vue";
import RecruiterDetails from "@/Components/Job/RecruiterDetails.vue";
import SkillDetails from "@/Components/Job/SkillDetails.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Avatar, Button, Toast, useToast } from "primevue";

const props = defineProps({
    job: Object,
    related_jobs: Object,
});

console.log(props.job);
const toast = useToast();

const formatDate = (date) => {
    const today = new Date();
    const datePosted = new Date(date);

    const diffInMs = today - datePosted;
    const diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24));
    const diffInMonths =
        today.getMonth() -
        datePosted.getMonth() +
        12 * (today.getFullYear() - datePosted.getFullYear());
    const diffInYears = today.getFullYear() - datePosted.getFullYear();

    if (diffInDays === 0) {
        return "Today";
    } else if (diffInDays < 30) {
        return `${diffInDays} day${diffInDays > 1 ? "s" : ""} ago`;
    } else if (diffInMonths < 12) {
        return `${diffInMonths} month${diffInMonths > 1 ? "s" : ""} ago`;
    } else {
        return `${diffInYears} year${diffInYears > 1 ? "s" : ""} ago`;
    }
};

const form = useForm({
    job_id: props.job.id,
});

const applyNow = () => {
    console.log(props.job);
    console.log("Apply Now clicked");

    form.post(route("job.apply", props.job.id), {
        onSuccess: (response) => {
            console.log(response);

            toast.add({
                severity: "success",
                summary: "Application Successful",
                detail: "You have successfully applied for the job.",
                life: 3000,
            });
        },
        onError: (error) => {
            console.error(error);
            // Handle error response here
            toast.add({
                severity: "error",
                summary: "Application Failed",
                detail: "There was an error applying for the job.",
                life: 3000,
            });
        },
    });
};
</script>

<template>
    <Head />

    <AuthenticatedLayout>
        <div class="border-t-2 border-gray-300 px-12 py-4 bg-white">
            <Link
                class="mx-auto max-w-7xl sm:px-6 lg:px-8 flex items-center gap-2"
                :href="route('dashboard')"
            >
                <i class="pi pi-angle-left"></i>
                <p>Back</p>
            </Link>
        </div>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col overflow-auto space-y-10">
                    <!-- Upper section (job, job summary) -->
                    <div
                        class="grid grid-cols-1 md:grid-cols-[2fr,1fr] gap-x-6"
                    >
                        <div class="flex flex-col gap-y-6">
                            <!-- Job -->
                            <div
                                class="bg-white p-6 rounded-lg border border-gray-200"
                            >
                                <div class="flex justify-between items-start">
                                    <div class="flex gap-x-4">
                                        <div class="flex">
                                            <Avatar
                                                size="large"
                                                shape="circle"
                                                icon="pi pi-user"
                                            />
                                        </div>
                                        <div class="flex flex-col gap-y-2">
                                            <h1
                                                class="text-2xl font-semibold font-[Poppins]"
                                            >
                                                {{ job.name }}
                                            </h1>
                                            <p class="font-medium text-header">
                                                {{ job.company.name }}
                                            </p>
                                            <CategoriesComponent
                                                location="Lagos, Nigeria"
                                                :job_type="job.type"
                                                :location_type="job.work_setup"
                                                :salary="job.salary"
                                            />
                                            <div
                                                class="mt-3 flex items-center gap-x-4"
                                            >
                                                <Button
                                                    class=""
                                                    @click="applyNow"
                                                >
                                                    <i
                                                        class="pi pi-check-circle"
                                                    ></i
                                                    >Apply Now</Button
                                                >
                                                <a
                                                    class="border border-gray-400 py-1 px-2 rounded-md"
                                                >
                                                    <i
                                                        class="pi pi-bookmark"
                                                    ></i>
                                                </a>
                                                <a
                                                    class="border border-gray-400 py-1 px-2 rounded-md"
                                                >
                                                    <i
                                                        class="pi pi-share-alt"
                                                    ></i>
                                                </a>
                                                <a
                                                    class="border border-gray-400 py-1 px-2 rounded-md"
                                                >
                                                    <i class="pi pi-flag"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center justify-center"
                                    >
                                        <StatusComponent :status="job.status" />
                                    </div>
                                </div>
                                <div
                                    class="flex justify-between text-secondary mt-4 border-t-2 border-gray-200 pt-2"
                                >
                                    <div class="flex items-center gap-x-2">
                                        <i class="pi pi-calendar"></i>
                                        <p>
                                            Posted
                                            {{ formatDate(job.created_at) }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-x-2">
                                        <i class="pi pi-users"></i>
                                        <p>24 Applicants</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Job details -->
                            <div>
                                <JobDetails :job="job" />
                            </div>
                        </div>
                        <div class="space-y-6">
                            <JobSummaryDetails :job="job" />
                            <RecruiterDetails :job="job" />
                            <SkillDetails :job="job" />
                        </div>
                    </div>
                    <!-- More like this -->
                    <div v-if="Object.keys(related_jobs).length > 0">
                        <div class="flex justify-between items-center">
                            <h1 class="font-bold font-[Poppins] text-xl">
                                More Jobs at {{ job.company.name }}
                            </h1>
                            <div
                                class="flex items-center gap-x-2 border border-gray-200 rounded-md p-2"
                            >
                                <a href="#">View all</a>
                                <i class="pi pi-angle-right"></i>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <div
                                v-if="related_jobs"
                                v-for="job in related_jobs"
                                :key="job.id"
                            >
                                <Link :href="route('job.index', job.id)">
                                    <JobComponent :job="job" />
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
