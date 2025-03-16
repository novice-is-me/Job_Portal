<script setup>
import {
    InputGroup,
    InputGroupAddon,
    InputText,
    Button,
    Select,
} from "primevue";
import { ref, watchEffect } from "vue";
import { router, useForm } from "@inertiajs/vue3";

const props = defineProps({
    categories: Object,
    companies: Object,
});

const isAdvanced = ref(false);

// For search
const data = useForm({
    job: "",
    city: "",
});

// Define the emit function to emit the event named updateResults
// This event will be used to update the results in the parent component
const emit = defineEmits(["updateResults"]);

const submitSearch = () => {
    let url = new URL(route("dashboard.search"));

    if (data.job.length > 0) {
        url.searchParams.set("job", data.job);
    }

    if (data.city.length > 0) {
        url.searchParams.set("city", data.city);
    }

    console.log("Final URL:", url.toString()); // Debugging output

    router.visit(url.toString(), {
        preserveState: true,
        replace: true,
        onSuccess: (data) => {
            // Pass the data to the updateResults event to update the results in the parent component
            emit("updateResults", data);
        },
    });
};

const job_status = ref([
    { label: "Active", value: "active" },
    { label: "Urgent", value: "urgent" },
]);

const date = ref([
    { label: "Anytime", value: "all" },
    { label: "Today", value: "today" },
    { label: "Past Week", value: "week" },
    { label: "Past Month", value: "month" },
]);

const job_type = ref([
    { label: "Full-time", value: "full-time" },
    { label: "Part-time", value: "part-time" },
    { label: "Contract", value: "contract" },
]);

const salary_range = ref([
    { label: "$20k - $40k", value: "20000-40000" },
    { label: "$40k - $60k", value: "40000-60000" },
    { label: "$60k - $80k", value: "60000-80000" },
    { label: "$80k - $100k", value: "80000-100000" },
]);
</script>

<template>
    <div class="flex flex-col gap-y-4">
        <div class="flex gap-x-4">
            <InputGroup class="flex-1">
                <InputGroupAddon> <i class="pi pi-search"></i></InputGroupAddon>
                <InputText
                    v-model="data.job"
                    placeholder="Job title, keywords, or company"
                    class="w-full"
                />
            </InputGroup>
            <InputGroup class="flex-1">
                <InputGroupAddon>
                    <i class="pi pi-map-marker"></i
                ></InputGroupAddon>
                <InputText
                    v-model="data.city"
                    placeholder="City, state or remote"
                    class="w-full"
                />
            </InputGroup>
            <Button
                @click="submitSearch"
                label="Search Jobs"
                class="whitespace-nowrap px-6 py-2"
                :disabled="data.job.length === 0 && data.city.length === 0"
            />
        </div>
        <div
            class="flex justify-between items-center hover:cursor-pointer"
            @click="isAdvanced = !isAdvanced"
        >
            <div
                class="flex items-center gap-x-2 text-header hover:bg-gray-200 p-2 rounded-md hover:text-black"
            >
                <i class="pi pi-filter"></i>
                <p class="">Advanced Filters</p>
                <i
                    :class="[
                        isAdvanced ? 'pi pi-angle-up' : ' pi pi-angle-down',
                    ]"
                ></i>
            </div>
            <p><span class="font-semibold">2,345</span> jobs found</p>
        </div>
        <!-- Advanced Filters -->
        <div v-if="isAdvanced" class="border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-4 p-4">
                <div class="flex gap-y-1 flex-col">
                    <p>Job Status</p>
                    <Select
                        v-model="selectedJobStatus"
                        :options="job_status"
                        optionLabel="label"
                        placeholder="Select a job status"
                    />
                </div>
                <div class="flex gap-y-1 flex-col">
                    <p>Date Status</p>
                    <Select
                        v-model="selectedDate"
                        :options="date"
                        optionLabel="label"
                        placeholder="Select timeframe"
                    />
                </div>
                <div class="flex gap-y-1 flex-col">
                    <p>Job Type</p>
                    <Select
                        v-model="selectedJobType"
                        :options="job_type"
                        optionLabel="label"
                        placeholder="Select Job Type"
                    />
                </div>
                <div class="flex gap-y-1 flex-col">
                    <p>Categories</p>
                    <Select
                        v-model="selectedCategories"
                        :options="categories"
                        optionLabel="name"
                        placeholder="Select category"
                    />
                </div>
                <div class="flex gap-y-1 flex-col">
                    <p>Company</p>
                    <Select
                        v-model="selectedCompanies"
                        :options="companies"
                        optionLabel="name"
                        placeholder="Select company"
                    />
                </div>
                <div class="flex gap-y-1 flex-col">
                    <p>Salary Range</p>
                    <Select
                        v-model="selectedSalary"
                        :options="salary_range"
                        optionLabel="label"
                        placeholder="Select salary range"
                    />
                </div>
            </div>
            <div class="flex justify-end gap-x-4 mt-2">
                <div>
                    <Button label="Clear Filters" class="w-full" />
                </div>
                <div>
                    <Button label="Apply Filters" class="w-full" />
                </div>
            </div>
        </div>
    </div>
</template>
