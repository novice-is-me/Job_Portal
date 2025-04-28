<script setup>
import { Avatar } from "primevue";

const props = defineProps({
    job: Object,
});

const formatYear = (year) => {
    const date = new Date(year);
    return date.getFullYear();
};
</script>

<template>
    <div class="flex flex-col p-3 gap-y-4">
        <div class="flex gap-x-4 border-b-2 border-gray-200 pb-4">
            <Avatar size="large" shape="circle" icon="pi pi-user" />
            <div>
                <h1 class="font-[Poppins] text-lg font-semibold text-black">
                    {{ job.company.name }}
                </h1>
                <p class="text-secondary">
                    {{ job.company.industry }} ·
                    {{ job.company.no_employees }} employees · Founded
                    {{ job.company.founded_at }}
                </p>
                <div class="flex items-center gap-x-2 mt-2">
                    <i class="pi pi-globe"></i>
                    <a href="#" class="text-header">{{ job.company.email }}</a>
                </div>
            </div>
        </div>
        <div class="space-y-8">
            <div class="space-y-2">
                <h1 class="font-[Poppins] font-semibold text-black">
                    About the company
                </h1>
                <p class="whitespace-normal">
                    {{ job.company.description }}
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-4 mt-4">
                <div class="p-4 border border-gray-200 rounded-lg space-y-2">
                    <p class="font-semibold font-[Poppins] text-black">
                        Industry
                    </p>
                    <p class="text-sm">
                        {{ job.company.industry }}
                    </p>
                </div>
                <div class="p-4 border border-gray-200 rounded-lg space-y-2">
                    <p class="font-semibold font-[Poppins] text-black">
                        Company size
                    </p>
                    <p class="text-sm">
                        {{ job.company.no_employees }} employees
                    </p>
                </div>
                <div class="p-4 border border-gray-200 rounded-lg space-y-2">
                    <p class="font-semibold font-[Poppins] text-black">
                        Founded
                    </p>
                    <p class="text-sm">
                        {{ formatYear(job.company.founded_at) }}
                    </p>
                </div>
                <div class="p-4 border border-gray-200 rounded-lg space-y-2">
                    <p class="font-semibold font-[Poppins] text-black">
                        Headquarters
                    </p>
                    <p class="text-sm">{{ job.company.address }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
