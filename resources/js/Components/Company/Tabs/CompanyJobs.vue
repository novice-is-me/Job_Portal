<script setup>
import JobComponent from "@/Components/Dashboard/JobComponent.vue";

const props = defineProps({
    jobs: Object,
});

console.log(props.jobs);
</script>

<template>
    <div v-if="jobs.length > 0" class="space-y-4 p-4">
        <p class="font-[Poppins] text-xl font-semibold text-black">
            Open Positions at TechCorp Inc
        </p>
        <div v-for="job in jobs" :key="job.id" class="mb-4">
            <JobComponent :job="job" />
        </div>
    </div>
    <div v-else class="space-y-4 p-4">
        <p class="font-[Poppins] text-xl font-semibold text-black">
            No open positions available at the moment.
        </p>
    </div>
</template>
