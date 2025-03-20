<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import FilterSidebar from "@/Components/Dashboard/FilterSidebar.vue";
import JobComponent from "@/Components/Dashboard/JobComponent.vue";
import SearchComponent from "@/Components/Dashboard/SearchComponent.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    jobs: Object,
    categories: Object,
    companies: Object,
    experiences: Object,
    results: Object,
});

const isGrid = ref(true);
const isRow = ref(false);

const jobs = ref(props.jobs);
const results = ref(props.results);

// Update the results when a new search is made
const updateResults = (newResults) => {
    results.value = newResults;
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12 bg-base">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col overflow-auto">
                    <!-- Header Section -->
                    <div class="flex flex-col text-center gap-y-4 mb-10">
                        <h1 class="text-4xl font-bold font-[Poppins]">
                            Find Your Dream Job Today
                        </h1>
                        <p class="text-secondary">
                            Search through thousands of job listings to find the
                            perfect match for your skills and career goals
                        </p>
                    </div>

                    <!-- Search Component -->
                    <div
                        class="bg-white rounded-md shadow-lg mx-auto md:mx-20 p-4 mb-10"
                    >
                        <SearchComponent
                            :categories="categories"
                            :companies="companies"
                            @updateResults="updateResults"
                        />
                    </div>

                    <!-- Main Content -->
                    <div class="grid grid-cols-[1fr_4fr] gap-x-6 mt-6">
                        <!-- Sidebar Filter -->
                        <div class="rounded-md shadow-md bg-white h-fit p-4">
                            <FilterSidebar
                                :experiences="experiences"
                                @updateResults="updateResults"
                            />
                        </div>

                        <!-- Job Listings -->
                        <div class="space-y-6">
                            <!-- View Toggle -->
                            <div class="flex justify-between items-center">
                                <p class="text-xl font-semibold font-[Poppins]">
                                    Job Listings
                                </p>
                                <div class="flex gap-x-2">
                                    <i
                                        @click="
                                            isRow = true;
                                            isGrid = false;
                                        "
                                        :class="[
                                            'fa-solid fa-up-down py-2 px-3 border rounded-md',
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
                                            'fa-solid fa-grip p-2 border rounded-md',
                                            isGrid
                                                ? 'bg-primary text-white'
                                                : 'bg-white',
                                        ]"
                                    ></i>
                                </div>
                            </div>

                            <!-- Job Components -->
                            <div
                                :class="[
                                    'grid gap-4 items-stretch',
                                    isGrid ? 'grid-cols-2' : 'grid-cols-1',
                                ]"
                            >
                                <!-- Default Job Listings -->
                                <div
                                    v-if="!results"
                                    v-for="job in jobs.data"
                                    :key="job.id"
                                    class="h-full"
                                >
                                    <Link :href="route('job.index', job.id)">
                                        <JobComponent
                                            :job="job"
                                            class="h-full flex flex-col"
                                        />
                                    </Link>
                                </div>

                                <!-- Filtered Results -->
                                <div
                                    v-else-if="results.data"
                                    v-for="result in results.data"
                                    :key="result.id"
                                    class="h-full"
                                >
                                    <Link :href="route('job.index', result.id)">
                                        <JobComponent
                                            :job="result"
                                            class="h-full flex flex-col"
                                        />
                                    </Link>
                                </div>
                            </div>

                            <!-- No Results Message -->
                            <div
                                v-if="results && results.data.length === 0"
                                class="flex items-center justify-center text-black font-semibold"
                            >
                                No Jobs Found
                            </div>

                            <!-- Pagination -->
                            <Pagination
                                :data="!results ? jobs : results"
                                :links="!results ? jobs.links : results.links"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
