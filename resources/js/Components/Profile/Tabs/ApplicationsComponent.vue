<script setup>
import { useForm } from "@inertiajs/vue3";
import { Select, Button } from "primevue";
import { ref } from "vue";
import ApplicationSection from "./Partials/ApplicationSection.vue";

const props = defineProps({
    job_applications: Object,
});

const form = useForm({
    application: "",
});

const filterForm = useForm({
    date: "",
    jobType: "",
    jobStatus: "",
});

const optionsApplication = ref([
    { name: "New York" },
    { name: "Rome" },
    { name: "London" },
    { name: "Istanbul" },
    { name: "Paris" },
]);

const optionsDate = ref([
    { name: "Anytime" },
    { name: "Today" },
    { name: "Past Week" },
    { name: "Past Month" },
]);

const job_type = ref([
    { name: "Full-time", value: "full-time" },
    { name: "Part-time", value: "part-time" },
    { name: "Contract", value: "contract" },
]);

const job_status = ref([
    { name: "Active", value: "active" },
    { name: "Urgent", value: "urgent" },
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
};
</script>

<template>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-[Poppins] font-semibold">
                Job Applications
            </h1>
            <div class="flex items-center gap-x-4">
                <!-- Select dropdown -->
                <Select
                    v-model="form.application"
                    :options="optionsApplication"
                    optionLabel="name"
                    placeholder="All Applications"
                    checkmark
                    :highlightOnSelect="false"
                />

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

        <!-- Application Section -->
        <div
            v-for="application in props.job_applications"
            :key="application.isFiltered"
            class="space-y-4"
        >
            <ApplicationSection :application="application" />
        </div>
    </div>
</template>
