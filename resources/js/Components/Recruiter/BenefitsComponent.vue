<script setup>
import { ref } from "vue";

const benefits = ref([
    {
        title: "Post Jobs",
        description:
            "Easily post job listings to attract top talent and fill your open positions.",
    },
    {
        title: "Search Resumes",
        description:
            "Access a vast database of resumes to find the perfect candidates for your roles.",
    },
    {
        title: "Manage Applications",
        description:
            "Efficiently manage and track job applications from a single dashboard.",
    },
    {
        title: "Applicant tracking",
        description: "Manage and track all your job applications in one place.",
    },
]);
</script>

<template>
    <div class="p-4 space-y-4 bg-white rounded-lg shadow-md">
        <div>
            <h1 class="font-[Poppins] font-semibold text-2xl">
                Benefits for Recruiters
            </h1>
            <p class="text-secondary">Why join our platform as a recruiter</p>
        </div>
        <div
            v-for="(benefit, index) in benefits"
            :key="index"
            class="flex gap-x-4 items-start"
        >
            <i
                class="pi pi-check text-blue-600 mt-2 border rounded-full bg-blue-100 p-1"
            ></i>
            <div>
                <p class="font-semibold">{{ benefit.title }}</p>
                <p class="text-secondary">{{ benefit.description }}</p>
            </div>
        </div>
    </div>
</template>
