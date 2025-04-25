<script setup>
import { Avatar } from "primevue";
import StatusComponent from "./Partials/StatusComponent.vue";
import CategoriesComponent from "./Partials/CategoriesComponent.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    job: Object,
});

console.log(props.job);

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
</script>

<template>
    <div
        class="border border-gray-200 p-4 rounded-lg space-y-4 hover:border-blue-500 cursor-pointer bg-white h-full flex flex-col justify-between"
    >
        <!-- Header: Company and Status -->
        <div class="flex justify-between gap-x-4">
            <div class="flex gap-x-4">
                <Avatar
                    size="large"
                    shape="circle"
                    icon="pi pi-user"
                    class="mx-auto"
                />
                <div>
                    <p class="text-lg font-semibold">
                        {{ job.name }}
                    </p>
                    <p v-if="job.company" class="text-secondary text-sm">
                        {{ job.company?.name || job.company_name }}
                    </p>
                </div>
            </div>
            <StatusComponent :status="job.status" />
        </div>

        <!-- Categories Component -->
        <CategoriesComponent
            :job_type="job.type"
            :location_type="job.work_setup"
            :salary="job.salary"
            :value="'dashboard'"
        />

        <!-- Job Description (Flex-1 to grow) -->
        <div class="flex-1 overflow-hidden">
            <p class="text-sm line-clamp-3">
                {{ job.content }}
            </p>
        </div>

        <!-- Footer: Date and View Details -->
        <div class="flex justify-between items-center text-sm">
            <div class="flex items-center gap-x-2 text-secondary">
                <i class="pi pi-calendar"></i>
                <p>Posted {{ formatDate(job.created_at) }}</p>
            </div>
            <Link
                :href="route('job.index', job.id)"
                class="flex items-center gap-x-2 p-2 rounded-md hover:bg-gray-200"
            >
                View Details <i class="pi pi-angle-right"></i>
            </Link>
        </div>
    </div>
</template>
