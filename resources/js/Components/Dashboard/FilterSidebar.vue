<script setup>
import { router, useForm } from "@inertiajs/vue3";
import { Checkbox } from "primevue";
import { defineProps, ref, watch } from "vue";

const props = defineProps({
    experiences: Object,
});

const data = useForm({
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
    { name: "Onsite", value: "on_site" },
];

const emit = defineEmits(["updateResults"]);

const filterData = () => {
    const url = new URL(route("dashboard.filter"));

    if (data.job_type.length > 0) {
        // This makes the job_type an array
        data.job_type.forEach((job) => {
            url.searchParams.append("job_type[]", job);
        });
    }

    if (data.experience.length > 0) {
        data.experience.forEach((exp) => {
            url.searchParams.append("experience[]", exp);
        });
    }

    if (data.location_type.length > 0) {
        data.location_type.forEach((location) => {
            url.searchParams.append("location_type[]", location);
        });
    }

    router.visit(url.toString(), {
        preserveState: true,
        replace: true,
        preserveScroll: true,
        onSuccess: (data) => {
            // Pass the data to the updateResults event to update the results in the parent component
            emit("updateResults", data.props.results);
        },
    });
};

// Watch the changes from data, then run the filterData function and deep is for deep watching all the values inside the data
watch(data, filterData, { deep: true });
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
                        :inputId="job_type.value"
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
                        :inputId="experience.name"
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
                        :inputId="location.value"
                        name="job_type"
                        :value="location.name"
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
