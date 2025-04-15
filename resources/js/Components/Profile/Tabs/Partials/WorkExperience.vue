<script setup>
import { ref } from "vue";

const props = defineProps({
    workExp: Object,
});

const work = ref(props.workExp);

const dateFormat = (date) => {
    const options = { year: "numeric", month: "long" };
    return new Date(date).toLocaleDateString("en-US", options);
};
</script>
<template>
    <div class="border-b-2 border-gray-300 pb-4">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold">{{ work.name }}</h2>
                <p class="text-blue-700 font-medium">{{ work.company }}.</p>
            </div>
            <p
                v-if="work.is_current_job"
                class="border rounded-full bg-blue-200 text-sm px-3"
            >
                Present
            </p>
        </div>
        <p class="text-secondary text-sm">
            {{ dateFormat(work.start_date) }} - {{ dateFormat(work.end_date) }}
        </p>
        <!-- <ul class="list-disc list-inside space-y-2 mt-4 ms-2">
            <li>Designed user interfaces for web and mobile applications</li>
            <li>
                Conducted user interviews and created personas to guide design
                decisions
            </li>
            <li>Developed wireframes, prototypes, and high-fidelity mockups</li>
            <li>
                Participated in agile development processes, including sprint
                planning and reviews
            </li>
        </ul> -->
    </div>
</template>
