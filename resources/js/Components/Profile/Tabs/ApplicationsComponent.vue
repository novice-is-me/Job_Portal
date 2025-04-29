<script setup>
import { useForm } from "@inertiajs/vue3";
import { Select, Button } from "primevue";
import { ref, watch } from "vue";
import ApplicationSection from "./Partials/ApplicationSection.vue";

const props = defineProps({
    job_applications: Object,
    results: Object,
});

const filterForm = useForm({
    date: "",
    jobType: "",
    jobStatus: "",
});

const optionsDate = ref([
    { name: "Anytime" },
    { name: "Today" },
    { name: "Past Week" },
    { name: "Past Month" },
]);

const job_type = ref([
    { name: "Full-time", value: "Full time" },
    { name: "Part-time", value: "Part time" },
    { name: "Contract", value: "Contract" },
]);

const job_status = ref([
    { name: "Active", value: "Active" },
    { name: "Urgent", value: "Urgent" },
]);

const isFiltered = ref(false);

const triggerFilter = () => {
    isFiltered.value = !isFiltered.value;
};

const removeFilter = () => {
    filterForm.reset();
};

const applyFilter = () => {
    isFiltered.value = false;

    filterForm.get(route("profile.application.filter"), {
        preserveState: true,
        replace: true,
        onSuccess: () => {
            filterForm.reset();
        },
        onError: () => {
            console.log("Error applying filters");
        },
    });
};

console.log(props.results);
</script>

<template>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-[Poppins] font-semibold">
                Job Applications
            </h1>
            <div class="flex items-center gap-x-4">
                <div
                    @click="triggerFilter"
                    class="flex items-center gap-x-2 border bg-white p-2 rounded-lg hover:cursor-pointer"
                >
                    <i class="pi pi-filter"></i>
                    <p>Filters</p>
                    <i
                        :class="[
                            isFiltered ? 'pi pi-angle-up' : 'pi pi-angle-down',
                        ]"
                    ></i>
                </div>
            </div>
        </div>
        <div v-if="isFiltered" class="border p-4">
            <div class="flex justify-between w-full gap-x-4">
                <div class="space-y-2 w-full">
                    <p>Date Applied</p>
                    <Select
                        v-model="filterForm.date"
                        :options="optionsDate"
                        optionLabel="name"
                        optionValue="name"
                        placeholder="Select Date"
                        checkmark
                        :highlightOnSelect="false"
                        class="w-full"
                    />
                </div>
                <div class="space-y-2 w-full">
                    <p>Job Type</p>
                    <Select
                        v-model="filterForm.jobType"
                        :options="job_type"
                        optionLabel="name"
                        optionValue="value"
                        placeholder="Select Job Type"
                        checkmark
                        :highlightOnSelect="false"
                        class="w-full"
                    />
                </div>
                <div class="space-y-2 w-full">
                    <p>Status</p>
                    <Select
                        v-model="filterForm.jobStatus"
                        :options="job_status"
                        optionLabel="name"
                        optionValue="value"
                        placeholder="Select Status"
                        checkmark
                        :highlightOnSelect="false"
                        class="w-full"
                    />
                </div>
            </div>
            <div class="flex justify-end gap-x-4 mt-4">
                <a
                    @click="removeFilter"
                    href="#"
                    class="bg-white rounded-lg px-3 py-2"
                    >Clear Filters</a
                >
                <Button @click="applyFilter" class="">Apply Filters</Button>
            </div>
        </div>

        <!-- Default Application Section -->
        <div
            v-if="props.results === undefined"
            v-for="application in props.job_applications"
            :key="application.isFiltered"
            class="space-y-4"
        >
            <ApplicationSection :application="application" />
        </div>
        <div
            v-if="props.job_applications.length === 0"
            class="flex justify-center items-center h-full"
        >
            <p class="text-gray-500 text-lg font-[Poppins]">
                No job applications found.
            </p>
        </div>

        <!-- Result Section -->
        <div v-if="props.results !== undefined" class="space-y-4">
            <div v-for="application in props.results" class="space-y-4">
                <ApplicationSection :application="application" />
            </div>
            <div
                v-if="props.results.length === 0"
                class="flex justify-center items-center h-full"
            >
                <p class="text-gray-500 text-lg font-[Poppins]">
                    No job applications found.
                </p>
            </div>
        </div>
    </div>
</template>
