<script setup>
import {
    InputGroup,
    InputGroupAddon,
    InputText,
    Button,
    Select,
} from "primevue";
import { ref } from "vue";

const isAdvanced = ref(false);
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
                    <Select />
                </div>
                <div class="flex gap-y-1 flex-col">
                    <p>Date Status</p>
                    <Select />
                </div>
                <div class="flex gap-y-1 flex-col">
                    <p>Job Type</p>
                    <Select />
                </div>
                <div class="flex gap-y-1 flex-col">
                    <p>Categories</p>
                    <Select />
                </div>
                <div class="flex gap-y-1 flex-col">
                    <p>Company</p>
                    <Select />
                </div>
                <div class="flex gap-y-1 flex-col">
                    <p>Salary Range</p>
                    <Select />
                </div>
            </div>
        </div>
    </div>
</template>
