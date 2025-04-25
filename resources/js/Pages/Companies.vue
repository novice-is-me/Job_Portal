<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref } from "vue";
import SearchComponent from "@/Components/Dashboard/SearchComponent.vue";
import CompanyComponent from "@/Components/Company/CompanyComponent.vue";
import Banner from "@/Components/Company/Banner.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    categoryCompany: Object,
    companies: Object,
    results: Object,
    featuredCompanies: Object,
});

const isGrid = ref(true);
const isRow = ref(false);

const companies = ref(props.companies);
const results = ref(props.results);
const featuredCompanies = ref(props.featuredCompanies);

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
                            Companies
                        </h1>
                        <p class="text-secondary">
                            Explore top companies hiring now. Find your dream
                            workplace and connect with industry leaders.
                        </p>
                    </div>

                    <!-- Search Component -->
                    <div
                        class="bg-white rounded-md shadow-lg mx-auto md:mx-20 p-4 mb-10"
                    >
                        <SearchComponent
                            :value="'companies'"
                            :categoryCompany="categoryCompany"
                            @updateResults="updateResults"
                        />
                    </div>

                    <!-- Main content -->
                    <div class="space-y-10">
                        <!-- Featured -->
                        <div v-if="!results" class="space-y-4">
                            <h1 class="text-xl font-semibold font-[Poppins]">
                                Featured Companies
                            </h1>
                            <div class="grid gap-4 items-stretch grid-cols-3">
                                <div
                                    v-for="company in featuredCompanies"
                                    :key="company.id"
                                >
                                    <CompanyComponent :company="company" />
                                </div>
                            </div>
                        </div>

                        <!-- All Companies -->
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <h1
                                    class="text-xl font-semibold font-[Poppins]"
                                >
                                    All Companies
                                </h1>
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

                            <!-- Companies Component Default -->
                            <div
                                v-if="!results"
                                :class="[
                                    'grid gap-4 items-stretch',
                                    isGrid ? 'grid-cols-3' : 'grid-cols-1',
                                ]"
                            >
                                <div
                                    v-for="company in companies.data"
                                    :key="company.id"
                                >
                                    <CompanyComponent :company="company" />
                                </div>
                            </div>

                            <!-- Filtered Companies -->
                            <div
                                v-else-if="results.data"
                                :class="[
                                    'grid gap-4 items-stretch',
                                    isGrid ? 'grid-cols-3' : 'grid-cols-1',
                                ]"
                            >
                                <div
                                    v-for="result in results.data"
                                    :key="result.id"
                                >
                                    <CompanyComponent :company="result" />
                                </div>
                            </div>

                            <!-- No Results Message -->
                            <div
                                v-if="results && results.data.length === 0"
                                class="flex items-center justify-center text-black font-semibold"
                            >
                                No Companies Found
                            </div>
                        </div>
                        <!-- Pagination -->
                        <Pagination
                            :data="!results ? companies : results"
                            :links="!results ? companies.links : results.links"
                        />

                        <!-- Banner subscription -->
                        <Banner />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
