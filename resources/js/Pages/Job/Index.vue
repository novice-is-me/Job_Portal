<script setup>
import CategoriesComponent from "@/Components/Dashboard/Partials/CategoriesComponent.vue";
import StatusComponent from "@/Components/Dashboard/Partials/StatusComponent.vue";
import JobDetails from "@/Components/Job/JobDetails.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { Avatar, Button } from "primevue";
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
                <div class="flex flex-col overflow-auto">
                    <!-- Upper section (job, job summary) -->
                    <div
                        class="grid grid-cols-1 md:grid-cols-[2fr,1fr] gap-x-6"
                    >
                        <div class="flex flex-col gap-y-6">
                            <!-- Job -->
                            <div
                                class="bg-white p-5 rounded-lg border border-gray-200"
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
                                                Senior Front End Developer
                                            </h1>
                                            <p class="font-medium text-header">
                                                Tech Corp Inc
                                            </p>
                                            <CategoriesComponent
                                                location="Lagos, Nigeria"
                                                job_type="Full Time"
                                                location_type="Remote"
                                                :salary="100000"
                                            />
                                            <div
                                                class="border border-red-300 mt-3 flex items-center gap-x-4"
                                            >
                                                <Button class="">
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
                                        <StatusComponent status="Active" />
                                    </div>
                                </div>
                                <div
                                    class="flex justify-between text-secondary mt-4 border-t-2 border-gray-200 pt-2"
                                >
                                    <div class="flex items-center gap-x-2">
                                        <i class="pi pi-calendar"></i>
                                        <p>Posted 2 days ago</p>
                                    </div>
                                    <div class="flex items-center gap-x-2">
                                        <i class="pi pi-users"></i>
                                        <p>24 Applicants</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Job details -->
                            <div>
                                <JobDetails />
                            </div>
                        </div>
                        <div class="border border-blue-500"></div>
                    </div>
                    <!-- More like this -->
                    <div></div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
