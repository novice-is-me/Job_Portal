<script setup>
const props = defineProps({
    job_type: {
        type: String,
        required: true,
    },
    location_type: {
        type: String,
        required: true,
    },
    salary: {
        type: Number,
        required: true,
    },
});
</script>

<template>
    <div class="flex gap-x-4 text-xs">
        <p
            class="border px-4 py-[0.1rem] font-semibold border-gray-300 rounded-full"
        >
            {{ job_type }}
        </p>
        <p
            class="border px-4 py-[0.1rem] font-semibold border-gray-300 rounded-full"
        >
            {{ location_type }}
        </p>
        <p
            class="border px-4 py-[0.1rem] font-semibold border-gray-300 rounded-full"
        >
            {{ salary }}
        </p>
    </div>
</template>
