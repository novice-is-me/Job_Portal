<script setup>
import CompanyDetails from "@/Components/Company/CompanyDetails.vue";
import CompanyOverview from "@/Components/Company/CompanyOverview.vue";
import SimilarCompanies from "@/Components/Company/SimilarCompanies.vue";
import CategoriesComponent from "@/Components/Dashboard/Partials/CategoriesComponent.vue";
import ContactInfoComponent from "@/Components/Profile/ContactInfoComponent.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { Avatar } from "primevue";
import { ref } from "vue";

const props = defineProps({
    company: Object,
    similarCompanies: Object,
});

const company = ref(props.company);
const similarCompanies = ref(props.similarCompanies);
</script>

<template>
    <Head />
    <AuthenticatedLayout>
        <div class="border-t-2 border-gray-300 px-12 py-4 bg-white">
            <Link
                class="mx-auto max-w-7xl sm:px-6 lg:px-8 flex items-center gap-2"
                :href="route('companies')"
            >
                <i class="pi pi-angle-left"></i>
                <p>Back</p>
            </Link>
        </div>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col overflow-auto">
                    <!-- Company Information Header -->
                    <div
                        class="bg-white p-6 rounded-lg border border-gray-200 flex justify-between items-center mb-10"
                    >
                        <div class="flex gap-x-4 items-center">
                            <div class="flex">
                                <Avatar
                                    size="large"
                                    shape="circle"
                                    icon="pi pi-user"
                                />
                            </div>
                            <div class="space-y-2">
                                <p
                                    class="text-2xl font-semibold font-[Poppins]"
                                >
                                    {{ company.name }}
                                </p>
                                <CategoriesComponent
                                    :category="company.industry.name"
                                    :value="'companies'"
                                />
                                <div class="flex items-center gap-x-4">
                                    <div class="flex items-center gap-x-2">
                                        <i class="pi pi-map-marker"></i>
                                        <p>{{ company.address }}</p>
                                    </div>
                                    <div class="flex items-center gap-x-2">
                                        <i class="pi pi-users"></i>
                                        <p>
                                            {{ company.no_employees }} employees
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-x-2">
                                        <i class="pi pi-globe"></i>
                                        <p class="text-blue-700 underline">
                                            techcorp.example.com
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-x-4">
                            <div
                                class="border border-gray-300 px-3 py-1 rounded-md hover:cursor-pointer"
                            >
                                <p>Follow Company</p>
                            </div>
                            <div
                                class="flex gap-x-4 items-center border border-gray-300 px-3 py-1 rounded-md hover:cursor-pointer"
                            >
                                <i class="pi pi-share-alt"></i>
                                <p>Share</p>
                            </div>
                        </div>
                    </div>

                    <!-- Second Section -->
                    <div
                        class="grid grid-cols-1 md:grid-cols-[2fr,1fr] gap-x-6"
                    >
                        <!-- Left Section -->
                        <div class="">
                            <CompanyDetails :company="company" />
                        </div>
                        <!-- Right Section -->
                        <div class="space-y-6">
                            <!-- Company Overview -->
                            <CompanyOverview :company="company" />
                            <ContactInfoComponent :user="company" />
                            <SimilarCompanies
                                v-if="similarCompanies.length > 0"
                                :companies="similarCompanies"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
