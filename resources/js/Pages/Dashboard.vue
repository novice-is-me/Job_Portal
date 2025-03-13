<script setup>
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import FilterSidebar from "@/Components/Dashboard/FilterSidebar.vue";
import JobComponent from "@/Components/Dashboard/JobComponent.vue";
import SearchComponent from "@/Components/Dashboard/SearchComponent.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const isGrid = ref(true);
const isRow = ref(false);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12 bg-base">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col overflow-auto">
                    <!-- Upper Section -->
                    <div class="flex flex-col w-full gap-y-16">
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
                        <div class="grid grid-cols-[1fr_4fr] mt-4 gap-x-6">
                            <!-- Drawer Side / Filters -->
                            <div
                                class="rounded-md shadow-md bg-white h-[fit-content]"
                            >
                                <FilterSidebar />
                            </div>
                            <!-- Results -->
                            <div class="space-y-6">
                                <div
                                    class="border flex justify-between items-center"
                                >
                                    <p
                                        class="text-xl font-semibold font-[Poppins]"
                                    >
                                        Job Listings
                                    </p>
                                    <div class="flex gap-x-2">
                                        <i
                                            @click="
                                                isRow = true;
                                                isGrid = false;
                                            "
                                            :class="[
                                                'fa-solid fa-up-down py-2 px-3 border rounded-md border-gray-200 hover:cursor-pointer',
                                                isRow
                                                    ? 'bg-primary text-white'
                                                    : 'bg-white',
                                            ]"
                                        ></i>
                                        <i
                                            @click="
                                                isGrid = true;
                                                isRow = false;
                                            "
                                            :class="[
                                                'fa-solid fa-grip p-2 border rounded-md border-x-gray-200 hover:cursor-pointer',
                                                isGrid
                                                    ? 'bg-primary text-white'
                                                    : 'bg-white',
                                            ]"
                                        ></i>
                                    </div>
                                </div>
                                <!-- Each Job -->
                                <div
                                    :class="[
                                        'grid grid-cols-1 gap-4',
                                        isGrid ? 'grid-cols-2' : 'grid-cols-1',
                                    ]"
                                >
                                    <JobComponent />
                                    <JobComponent />
                                    <JobComponent />
                                    <JobComponent />
                                    <JobComponent />
                                    <JobComponent />
                                </div>
                                <!-- Pagination -->
                                <div class="flex justify-between items-center">
                                    <div class="text-secondary text-sm">
                                        <p>Showing 1 to 6 of 24 results</p>
                                    </div>
                                    <div>
                                        <button
                                            class="px-4 py-2 bg-primary text-white rounded-md"
                                        >
                                            Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
