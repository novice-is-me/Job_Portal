<script setup>
import SearchComponent from "@/Components/Dashboard/SearchComponent.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12 bg-base">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col overflow-auto">
                    <!-- Upper Section -->
                    <div class="flex flex-col w-full gap-y-20">
                        <div class="flex flex-col w-full gap-y-10">
                            <div class="flex flex-col text-center gap-y-2">
                                <h1 class="text-4xl font-bold font-[Poppins]">
                                    Find Your Dream Job Today
                                </h1>
                                <p class="text-secondary">
                                    Search through thousands of job listings to
                                    find the perfect match for your skills and
                                    career goals
                                </p>
                            </div>
                            <!-- Search Component -->
                            <div
                                class="bg-white rounded-md shadow-lg mx-auto md:mx-20 p-4"
                            >
                                <SearchComponent />
                            </div>
                        </div>
                        <!-- Result Section -->
                        <div class="mt-4">
                            <p>Result</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
