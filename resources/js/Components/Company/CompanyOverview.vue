<script setup>
const props = defineProps({
    company: Object,
});

const formatYear = (date) => {
    const year = new Date(date).getFullYear();
    return year;
};
</script>

<template>
    <div class="bg-white p-4 rounded-lg space-y-2">
        <p class="font-[Poppins] text-xl font-semibold text-black">
            Company Overview
        </p>
        <div class="p-4 space-y-4 rounded-md">
            <div class="flex items-center gap-2 justify-between">
                <div class="flex items-center gap-2">
                    <i class="pi pi-building"></i>
                    <p>Industry</p>
                </div>
                <p>{{ company.industry.name }}</p>
            </div>
            <div class="flex items-center gap-2 justify-between">
                <div class="flex items-center gap-2">
                    <i class="pi pi-users"></i>
                    <p>Company Size</p>
                </div>
                <p>{{ company.no_employees }}</p>
            </div>
            <div class="flex items-center gap-2 justify-between">
                <div class="flex items-center gap-2">
                    <i class="pi pi-calendar"></i>
                    <p>Founded</p>
                </div>
                <p>{{ formatYear(company.founded_at) }}</p>
            </div>
        </div>
        <div
            class="border-2 border-gray-200 rounded-md px-4 py-2 text-center gap-2"
        >
            <a href="#">Visit Website</a>
        </div>
    </div>
</template>
