<script setup>
import { Avatar } from "primevue";
import StatusComponent from "./Partials/StatusComponent.vue";
import CategoriesComponent from "./Partials/CategoriesComponent.vue";
import { Link } from "@inertiajs/vue3";
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
                        Senior Front End Developer
                    </p>
                    <p class="text-secondary text-sm">TechCorp Inc.</p>
                </div>
            </div>
            <div class="">
                <StatusComponent :status="'urgent'" />
            </div>
        </div>
        <!-- Categories Component -->
        <div>
            <CategoriesComponent
                :job_type="'Full-time'"
                :location_type="'remote'"
                :salary="'90k'"
            />
        </div>
        <!-- Content -->
        <div class="">
            <p class="text-sm">
                We're looking for an experienced Frontend Developer to join our
                team. You'll be responsible for building responsive web
                applications using
            </p>
        </div>
        <!-- Other Details -->
        <div class="flex justify-between items-center text-sm">
            <div class="flex items-center gap-x-2 text-secondary">
                <i class="pi pi-calendar"></i>
                <p>Posted 2 days ago</p>
            </div>
            <Link
                class="flex items-center gap-x-2 p-2 rounded-md hover:bg-gray-200"
                >View Details <i class="pi pi-angle-right"></i
            ></Link>
        </div>
    </div>
</template>
