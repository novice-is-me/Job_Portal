<script setup>
import { Checkbox } from "primevue";
import { defineProps, ref } from "vue";

const props = defineProps({
    experiences: Object,
});

const data = ref({
    job_type: [],
    experience: [],
    location_type: [],
});

const job_types = [
    { name: "Full Time", value: "full_time" },
    { name: "Part Time", value: "part_time" },
    { name: "Contract", value: "contract" },
];

const locations = [
    { name: "Remote", value: "remote" },
    { name: "Hybrid", value: "hybrid" },
    { name: "On-site", value: "on_site" },
];
</script>

<template>
    <div class="p-4">
        <p class="text-lg font-semibold">Filters</p>
        <div class="divide-y divide-gray-200">
            <div class="flex flex-col py-3 gap-y-2">
                <p class="font-medium">Job Type</p>
                <div
                    v-for="job_type in job_types"
                    :key="job_type.name"
                    class="flex items-center gap-x-2"
                >
                    <Checkbox
                        v-model="data.job_type"
                        inputId="full_time"
                        name="job_type"
                        :value="job_type.name"
                    />
                    <label for="full_time">{{ job_type.name }}</label>
                </div>
            </div>
            <!-- Experience Level -->
            <div class="flex flex-col py-2 gap-y-2">
                <p class="font-medium">Experience Level</p>
                <div
                    class="flex items-center gap-x-2"
                    v-for="experience in experiences"
                    :key="experience.id"
                >
                    <Checkbox
                        v-model="data.experience"
                        inputId="full_time"
                        name="job_type"
                        :value="experience.id"
                    />
                    <label for="full_time">{{ experience.name }}</label>
                </div>
            </div>
            <!--Location Type -->
            <div class="flex flex-col py-2 gap-y-2">
                <p class="font-medium">Location Type</p>
                <div
                    v-for="location in locations"
                    :key="location.name"
                    class="flex items-center gap-x-2"
                >
                    <Checkbox
                        v-model="data.location_type"
                        inputId="full_time"
                        name="job_type"
                        :value="locations.name"
                    />
                    <label for="full_time">{{ location.name }}</label>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
:deep(.p-checkbox .p-checkbox-input) {
    border: 1px solid #0d6efd !important;
    opacity: 1 !important;
}
</style>
