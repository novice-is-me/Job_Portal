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
    value: String,
    categoryCompany: Object,
    no_of_jobs: Number,
});

const isAdvanced = ref(false);

// For search
const data = useForm({
    job: "",
    city: "",
    selectedCategories: "",
    selectedCompanies: "",
    selectedJobStatus: "",
    selectedDate: "",
    selectedJobType: "",
    selectedSalary: "",
});

const form = useForm({
    company: "",
    selectedIndustry: "",
});

// Define the emit function to emit the event named updateResults
// This event will be used to update the results in the parent component
const emit = defineEmits(["updateResults"]);

const submitSearch = () => {
    let url;

    if (props.value === "dashboard") {
        url = new URL(route("dashboard.search"));
        if (data.job.length > 0) {
            url.searchParams.set("job", data.job);
        }

        if (data.city.length > 0) {
            url.searchParams.set("city", data.city);
        }
    } else if (props.value === "companies") {
        url = new URL(route("dashboard.search.company"));

        if (form.company.length > 0) {
            url.searchParams.set("company", form.company);
        }

        if (form.selectedIndustry && form.selectedIndustry !== "") {
            url.searchParams.set("industry", form.selectedIndustry.id);
        }
    }

    console.log("Final URL:", url.toString()); // Debugging output

    router.visit(url.toString(), {
        preserveState: true,
        replace: true,
        onSuccess: (data) => {
            console.log("Data from the search", form);
            // Pass the data to the updateResults event to update the results in the parent component
            emit("updateResults", data.props.results);
        },
    });
};

// For advanced filters
const applyFilters = () => {
    let url;

    if (props.value === "dashboard") {
        url = new URL(route("dashboard.advanced-search"));

        if (data.selectedCategories && data.selectedCategories !== "") {
            url.searchParams.set("category", data.selectedCategories.id);
        }

        if (data.selectedCompanies && data.selectedCompanies !== "") {
            url.searchParams.set("company", data.selectedCompanies.id);
        }

        if (data.selectedJobStatus && data.selectedJobStatus !== "") {
            url.searchParams.set("status", data.selectedJobStatus.value);
        }

        if (data.selectedDate && data.selectedDate !== "") {
            url.searchParams.set("date", data.selectedDate.value);
        }

        if (data.selectedJobType && data.selectedJobType !== "") {
            url.searchParams.set("type", data.selectedJobType.value);
        }

        if (data.selectedSalary && data.selectedSalary !== "") {
            url.searchParams.set("salary", data.selectedSalary.value);
        }
    }

    console.log("Final URL:", url.toString()); // Debugging output

    router.visit(url.toString(), {
        preserveState: true,
        replace: true,
        onSuccess: (data) => {
            console.log("Data from the advanced", data);
            isAdvanced.value = false; // Close the advanced filters after applying
            // Pass the data to the updateResults event to update the results in the parent component
            emit("updateResults", data.props.results);
        },
    });
};

const clearFilters = () => {
    data.reset();
    form.reset();
};

const job_status = ref([
    { name: "Active", value: "active" },
    { name: "Urgent", value: "urgent" },
]);

const date = ref([
    { name: "Anytime", value: "all" },
    { name: "Today", value: "today" },
    { name: "Past Week", value: "week" },
    { name: "Past Month", value: "month" },
]);

const job_type = ref([
    { name: "Full-time", value: "full-time" },
    { name: "Part-time", value: "part-time" },
    { name: "Contract", value: "contract" },
]);

const salary_range = ref([
    { name: "$1k - $3k", value: "1000-3000" },
    { name: "$3k - $6k", value: "3000-6000" },
    { name: "$6k - $8k", value: "6000-8000" },
    { name: "$8k - $10k", value: "8000-10000" },
]);
</script>

<template>
    <div class="flex flex-col gap-y-4">
        <div class="flex gap-x-4">
            <InputGroup class="flex-1">
                <InputGroupAddon> <i class="pi pi-search"></i></InputGroupAddon>
                <InputText
                    v-if="props.value === 'dashboard'"
                    v-model="data.job"
                    placeholder="Job title, keywords, or company
                    "
                    class="w-full"
                />

                <InputText
                    v-model="form.company"
                    v-if="props.value === 'companies'"
                    placeholder=" Search companies by name"
                    class="w-full"
                />
            </InputGroup>
            <InputGroup v-if="props.value === 'dashboard'" class="flex-1">
                <InputGroupAddon>
                    <i class="pi pi-map-marker"></i
                ></InputGroupAddon>
                <InputText
                    v-model="data.city"
                    placeholder="City, state or remote"
                    class="w-full"
                />
            </InputGroup>

            <InputGroup v-if="props.value === 'companies'" class="flex-[0.5]">
                <Select
                    v-model="form.selectedIndustry"
                    :options="categoryCompany"
                    optionLabel="name"
                    placeholder="All industries"
                />
            </InputGroup>
            <div class="hidden md:flex items-center gap-x-4">
                <Button
                    @click="submitSearch"
                    :label="
                        props.value === 'dashboard'
                            ? 'Search Jobs'
                            : 'Search Companies'
                    "
                    class="whitespace-nowrap px-6 py-2"
                />
            </div>

            <Button
                v-if="props.value === 'companies'"
                @click="clearFilters"
                label="Clear"
                class="whitespace-nowrap px-6 py-2"
            />
        </div>
        <div class="md:hidden flex items-center gap-x-4">
            <Button
                v-if="props.value === 'dashboard'"
                @click="submitSearch"
                :label="
                    props.value === 'dashboard'
                        ? 'Search Jobs'
                        : 'Search Companies'
                "
                class="whitespace-nowrap px-6 py-2 w-full"
            />
        </div>
        <div
            class="flex justify-between items-center hover:cursor-pointer"
            @click="isAdvanced = !isAdvanced"
            v-if="props.value === 'dashboard'"
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
            <p>
                <span class="font-semibold">{{ no_of_jobs }}</span> jobs found
            </p>
        </div>
        <!-- Advanced Filters -->
        <div v-if="isAdvanced" class="border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-4 p-4">
                <div class="flex gap-y-1 flex-col">
                    <p>Job Status</p>
                    <Select
                        v-model="data.selectedJobStatus"
                        :options="job_status"
                        optionLabel="name"
                        placeholder="Select a job status"
                    />
                </div>
                <div class="flex gap-y-1 flex-col">
                    <p>Date Status</p>
                    <Select
                        v-model="data.selectedDate"
                        :options="date"
                        optionLabel="name"
                        placeholder="Select timeframe"
                    />
                </div>
                <div class="flex gap-y-1 flex-col">
                    <p>Job Type</p>
                    <Select
                        v-model="data.selectedJobType"
                        :options="job_type"
                        optionLabel="name"
                        placeholder="Select Job Type"
                    />
                </div>
                <div class="flex gap-y-1 flex-col">
                    <p>Categories</p>
                    <Select
                        v-model="data.selectedCategories"
                        :options="categories"
                        optionLabel="name"
                        placeholder="Select category"
                    />
                </div>
                <div class="flex gap-y-1 flex-col">
                    <p>Company</p>
                    <Select
                        v-model="data.selectedCompanies"
                        :options="companies"
                        optionLabel="name"
                        placeholder="Select company"
                    />
                </div>
                <div class="flex gap-y-1 flex-col">
                    <p>Salary Range</p>
                    <Select
                        v-model="data.selectedSalary"
                        :options="salary_range"
                        optionLabel="name"
                        placeholder="Select salary range"
                    />
                </div>
            </div>
            <div class="flex justify-end gap-x-4 mt-2">
                <div>
                    <Button
                        @click="clearFilters"
                        label="Clear Filters"
                        class="w-full"
                    />
                </div>
                <div>
                    <Button
                        @click="applyFilters"
                        label="Apply Filters"
                        class="w-full"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
