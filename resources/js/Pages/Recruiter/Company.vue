<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Avatar, Button } from "primevue";
import StatusCard from "@/Components/Recruiter/StatusCard.vue";
import CompanyInformation from "@/Components/Recruiter/CompanyInformation.vue";
import CompanyValues from "@/Components/Recruiter/CompanyValues.vue";
import CompanyBenefits from "@/Components/Recruiter/CompanyBenefits.vue";
import { ref } from "vue";

const props = defineProps({
    company: Object,
    active_jobs: Number,
    total_applicants: Number,
});

const company = ref(props.company);

console.log(company.value);
const statusData = [
    {
        title: "Active Jobs",
        count: props.active_jobs,
        icon: "pi pi-briefcase",
        color: "bg-blue-100",
        text: "text-blue-500",
    },
    {
        title: "Total Applicants",
        count: props.total_applicants,
        icon: "pi pi-users",
        color: "bg-green-100",
        text: "text-green-500",
    },
    {
        title: "Interview Scheduled",
        count: 5,
        icon: "pi pi-check",
        color: "bg-yellow-100",
        text: "text-yellow-500",
    },
];
</script>

<template>
    <Head title="Recruiter" />
    <AdminLayout>
        <div class="bg-gray-100 p-4">
            <!-- Header -->
            <div class="border flex items-center gap-x-4 p-4">
                <Avatar :src="w" :alt="w" class="w-20 h-20 rounded-full" />
                <div>
                    <p class="font-[Poppins] text-xl font-bold">
                        {{ company.name }}
                    </p>
                    <p>Company Dashboard</p>
                </div>
            </div>
            <!-- Status -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                <div v-for="status in statusData" class="w-full">
                    <StatusCard
                        :title="status.title"
                        :count="status.count"
                        :icon="status.icon"
                        :color="status.color"
                        :text="status.text"
                    />
                </div>
            </div>
            <!-- Company Overview -->
            <div class="space-y-4">
                <CompanyInformation :company="company" />
                <CompanyValues :company="company" />
                <CompanyBenefits :company="company" />
            </div>
        </div>
    </AdminLayout>
</template>
