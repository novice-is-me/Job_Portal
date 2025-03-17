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
    location: {
        type: String,
    },
});

const formatSalary = (salary) => {
    if (salary >= 1000) {
        return `$${salary / 1000}k`;
    }
};
</script>

<template>
    <div class="flex gap-x-4 text-xs">
        <p
            v-if="location"
            class="border px-4 py-[0.1rem] font-semibold border-gray-300 rounded-full"
        >
            {{ location }}
        </p>
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
            {{ formatSalary(salary) }}
        </p>
    </div>
</template>
