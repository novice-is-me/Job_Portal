<script setup>
const props = defineProps({
    company: Object,
});
</script>

<template>
    <div class="bg-white p-4 rounded-lg space-y-4 shadow-md">
        <div>
            <p class="font-[Poppins] font-bold text-lg">Company Information</p>
            <p>Basic Details about your company</p>
        </div>
        <div class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <p class="font-semibold">Industry</p>
                    <p class="text-secondary">{{ company.industry.name }}</p>
                </div>
                <div>
                    <p class="font-semibold">Location</p>
                    <p class="text-secondary">{{ company.address }}</p>
                </div>
                <div>
                    <p class="font-semibold">Company Size</p>
                    <p class="text-secondary">{{ company.no_employees }}</p>
                </div>
                <div>
                    <p class="font-semibold">Founded</p>
                    <p class="text-secondary">{{ company.founded_at }}</p>
                </div>
                <div>
                    <p class="font-semibold">Email</p>
                    <p class="text-secondary">{{ company.email }}</p>
                </div>
            </div>
            <div>
                <p class="font-semibold">Description</p>
                <p class="text-secondary">{{ company.description }}</p>
            </div>
        </div>
    </div>
</template>
