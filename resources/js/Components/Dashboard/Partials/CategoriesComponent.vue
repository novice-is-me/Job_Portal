<script setup>
const props = defineProps({
    job_type: {
        type: String,
    },
    location_type: {
        type: String,
    },
    salary: {
        type: Number,
    },
    location: {
        type: String,
    },
    people: {
        type: Number,
    },
    category: {
        type: String,
    },
    value: {
        type: String,
    },
});

const formatSalary = (salary) => {
    if (salary >= 1000) {
        return `$${salary / 1000}k`;
    }
};

console.log(props.value);
</script>

<template>
    <div class="flex gap-x-4 text-xs">
        <div v-if="props.value === 'dashboard'" class="flex gap-x-4">
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

        <div v-if="props.value === 'companies'" class="flex gap-x-4">
            <p
                v-if="category"
                class="border px-4 py-[0.1rem] font-semibold border-gray-300 rounded-full"
            >
                {{ category }}
            </p>
            <p
                v-if="location"
                class="border px-4 py-[0.1rem] font-semibold border-gray-300 rounded-full"
            >
                {{ location }}
            </p>
            <p
                v-if="people"
                class="border px-4 py-[0.1rem] font-semibold border-gray-300 rounded-full"
            >
                {{ people }}
            </p>
        </div>
    </div>
</template>
