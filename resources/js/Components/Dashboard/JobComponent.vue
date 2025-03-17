<script setup>
import { Avatar } from "primevue";
import StatusComponent from "./Partials/StatusComponent.vue";
import CategoriesComponent from "./Partials/CategoriesComponent.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    job: Object,
});

console.log("jobs in job component", props.job);
</script>

<template>
    <div
        class="border border-gray-200 p-4 rounded-lg space-y-4 hover:border-blue-500 cursor-pointer bg-white"
    >
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
                    <p class="text-secondary text-sm">{{ job.company.name }}</p>
                </div>
            </div>
            <div class="">
                <StatusComponent :status="job.status" />
            </div>
        </div>
        <!-- Categories Component -->
        <div>
            <CategoriesComponent
                :job_type="job.type"
                :location_type="job.work_setup"
                :salary="job.salary"
            />
        </div>
        <!-- Content -->
        <div class="">
            <p class="text-sm">
                {{ job.content }}
            </p>
        </div>
        <!-- Other Details -->
        <div class="flex justify-between items-center text-sm">
            <div class="flex items-center gap-x-2 text-secondary">
                <i class="pi pi-calendar"></i>
                <p>Posted 2 days ago</p>
            </div>
            <Link
                href="#"
                class="flex items-center gap-x-2 p-2 rounded-md hover:bg-gray-200"
                >View Details <i class="pi pi-angle-right"></i
            ></Link>
        </div>
    </div>
</template>
