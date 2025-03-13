<script setup>
import { Checkbox } from "primevue";
</script>

<template>
    <div class="p-4">
        <p class="text-lg font-semibold">Filters</p>
        <div class="divide-y divide-gray-200">
            <div class="flex flex-col py-3 gap-y-2">
                <p class="font-medium">Job Type</p>
                <div class="flex items-center gap-x-2">
                    <Checkbox
                        v-model="job_type"
                        inputId="full_time"
                        name="job_type"
                        value="full_time"
                    />
                    <label for="full_time">Full Time</label>
                </div>
                <div class="flex items-center gap-x-2">
                    <Checkbox
                        v-model="job_type"
                        inputId="part_time"
                        name="job_type"
                        value="part_time"
                    />
                    <label for="part_time">Part Time</label>
                </div>
            </div>
            <!-- Experience Level -->
            <div class="flex flex-col py-2 gap-y-2">
                <p class="font-medium">Experience Level</p>
                <div class="flex items-center gap-x-2">
                    <Checkbox
                        v-model="job_type"
                        inputId="full_time"
                        name="job_type"
                        value="full_time"
                    />
                    <label for="full_time">Entry Level</label>
                </div>
                <div class="flex items-center gap-x-2">
                    <Checkbox
                        v-model="job_type"
                        inputId="part_time"
                        name="job_type"
                        value="part_time"
                    />
                    <label for="part_time">Mid Level</label>
                </div>
                <div class="flex items-center gap-x-2">
                    <Checkbox
                        v-model="job_type"
                        inputId="part_time"
                        name="job_type"
                        value="part_time"
                    />
                    <label for="part_time">Senior Level</label>
                </div>
                <div class="flex items-center gap-x-2">
                    <Checkbox
                        v-model="job_type"
                        inputId="part_time"
                        name="job_type"
                        value="part_time"
                    />
                    <label for="part_time">Executive</label>
                </div>
            </div>
            <!--Location Type -->
            <div class="flex flex-col py-2 gap-y-2">
                <p class="font-medium">Location Type</p>
                <div class="flex items-center gap-x-2">
                    <Checkbox
                        v-model="job_type"
                        inputId="full_time"
                        name="job_type"
                        value="full_time"
                    />
                    <label for="full_time">Remote</label>
                </div>
                <div class="flex items-center gap-x-2">
                    <Checkbox
                        v-model="job_type"
                        inputId="part_time"
                        name="job_type"
                        value="part_time"
                    />
                    <label for="part_time">Hybrid</label>
                </div>
                <div class="flex items-center gap-x-2">
                    <Checkbox
                        v-model="job_type"
                        inputId="part_time"
                        name="job_type"
                        value="part_time"
                    />
                    <label for="part_time">On-site</label>
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
