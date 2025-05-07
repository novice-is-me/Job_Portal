<script setup>
import { router, useForm } from "@inertiajs/vue3";
import {
    InputText,
    Select,
    InputGroup,
    InputGroupAddon,
    Button,
} from "primevue";
import { watch } from "vue";
import { debounce } from "lodash";

const props = defineProps({
    status: Array,
});

// For search
const data = useForm({
    jobs: "",
    status: "",
});

const searchJobs = () => {
    console.log("Searching jobs...");

    let url = new URL(route("dashboard.recruiter.jobs.search"));
    if (data.jobs !== "") {
        url.searchParams.set("jobs", data.jobs);
    }
    if (data.status !== "") {
        url.searchParams.set("status", data.status.name);
    }

    router.visit(url.toString(), {
        preserveState: true,
        replace: true,
        onSuccess: (res) => {
            console.log("Search results:", res.props.jobs);
        },
    });
};

const debouncedSearch = debounce(searchJobs, 1000);

watch(
    () => data.jobs,
    (newVal) => {
        if (newVal && newVal.length > 0) {
            debouncedSearch();
        }
    }
);

watch(
    () => data.status,
    (newVal) => {
        if (newVal && newVal.name) {
            debouncedSearch();
        }
    }
);

const clearInput = () => {
    data.jobs = "";
    data.status = "";
    searchJobs();
};
</script>

<template>
    <div class="grid grid-cols-[3fr,2fr,1fr] gap-x-4 w-full">
        <div>
            <InputGroup>
                <InputGroupAddon>
                    <i class="pi pi-search"></i>
                </InputGroupAddon>
                <InputText
                    v-model="data.jobs"
                    placeholder="Job Name"
                    class="w-full mb-4"
                />
            </InputGroup>
        </div>
        <div>
            <Select
                v-model="data.status"
                :options="status"
                optionLabel="name"
                placeholder="Status"
                class="w-full"
            />
        </div>
        <div>
            <Button @click="clearInput">Clear Input</Button>
        </div>
    </div>
</template>
