<script setup>
import {
    InputGroup,
    InputGroupAddon,
    InputText,
    Button,
    Select,
} from "primevue";
import { ref } from "vue";

const props = defineProps({
    categories: Object,
    companies: Object,
});

const isAdvanced = ref(false);

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
                    placeholder="Job title, keywords, or company"
                    class="w-full"
                />
            </InputGroup>
            <InputGroup class="flex-1">
                <InputGroupAddon>
                    <i class="pi pi-map-marker"></i
                ></InputGroupAddon>
                <InputText placeholder="City, state or remote" class="w-full" />
            </InputGroup>
            <Button label="Search Jobs" class="whitespace-nowrap px-6 py-2" />
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
        </div>
    </div>
</template>
