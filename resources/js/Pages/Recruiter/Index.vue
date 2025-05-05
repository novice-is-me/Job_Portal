<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BenefitsComponent from "@/Components/Recruiter/BenefitsComponent.vue";
import RecruiterForm from "@/Components/Recruiter/RecruiterForm.vue";

const props = defineProps({
    companies: Object,
    user: Object,
});
</script>

<template>
    <Head title="Recruiter" />
    <AuthenticatedLayout>
        <div class="py-12 bg-base">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col overflow-auto">
                    <!-- Header Section -->
                    <div class="flex flex-col text-center gap-y-4 mb-10">
                        <h1 class="text-4xl font-bold font-[Poppins]">
                            Apply as Recruiter
                        </h1>
                        <p class="text-secondary">
                            Join our platform to post jobs and find the best
                            talent for your company
                        </p>
                    </div>

                    <!-- Main content -->
                    <div
                        class="grid grid-cols-1 md:grid-cols-[2fr_4fr] gap-x-6 mt-6"
                    >
                        <!-- Left section -->
                        <div class="">
                            <BenefitsComponent />
                        </div>
                        <!-- Right section -->
                        <div class="">
                            <RecruiterForm
                                :companies="companies"
                                :user="user"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
