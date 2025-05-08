<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {
    Button,
    DataTable,
    Column,
    InputText,
    Dialog,
    Select,
    useToast,
    useConfirm,
} from "primevue";
import SearchCompany from "@/Components/Recruiter/SearchCompany.vue";
import { ref } from "vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({
    company: Object,
    jobs: Object,
    results: Object,
    categories: Object,
});

const isAddJobModal = ref(false);
const toast = useToast();
const confirm = useConfirm();
const isViewJob = ref(false);

const status = [
    {
        name: "All",
    },
    {
        name: "Active",
    },
    {
        name: "Urgent",
    },
];

const workSetup = [
    {
        name: "Remote",
    },
    {
        name: "Onsite",
    },
    {
        name: "Hybrid",
    },
];

const type = [
    {
        name: "Full Time",
    },
    {
        name: "Part Time",
    },
    {
        name: "Contract",
    },
];

const statusOptions = [
    {
        name: "Active",
    },
    {
        name: "Inactive",
    },
];

const deleteJob = (id) => {
    confirm.require({
        message: "Are you sure you want to delete this job?",
        header: "Delete Job",
        icon: "pi pi-exclamation-triangle",
        acceptLabel: "Yes",
        rejectLabel: "No",
        acceptClass: "p-button-danger",
        accept: () => {
            // Route for deleting the job
            form.delete(
                route("dashboard.recruiter.delete.job", {
                    job_id: id,
                }),
                {
                    preserveScroll: true,
                    onSuccess: (res) => {
                        toast.add({
                            severity: "success",
                            summary: "Success",
                            detail: "Job deleted successfully",
                            life: 3000,
                        });
                    },
                    onError: (err) => {
                        toast.add({
                            severity: "error",
                            summary: "Error",
                            detail: "Something went wrong",
                            life: 3000,
                        });
                    },
                }
            );
        },
    });
};

const form = useForm({
    job_title: "",
    address: "",
    description: "",
    category: "",
    status: "",
    work_setup: "",
    type: "",
    salary: "",
});

const save = () => {
    form.post(
        route("dashboard.recruiter.submit.add-jobs", {
            company_id: props.company.id,
        }),
        {
            preserveScroll: true,
            onSuccess: (res) => {
                isAddJobModal.value = false;
                toast.add({
                    severity: "success",
                    summary: "Success",
                    detail: "Job added successfully",
                    life: 3000,
                });
            },
            onError: (err) => {
                toast.add({
                    severity: "error",
                    summary: "Error",
                    detail: "Something went wrong",
                    life: 3000,
                });
            },
        }
    );
};
</script>

<template>
    <Head title="Recruiter" />
    <AdminLayout>
        <div v-if="!isViewJob" class="bg-gray-100 p-4">
            <div class="flex items-center justify-between gap-x-4 p-4">
                <div>
                    <p class="font-[Poppins] text-xl font-bold">
                        Manage Company
                    </p>
                </div>
                <div>
                    <Button @click="isAddJobModal = true">Post New Job</Button>
                </div>
            </div>

            <!-- Table -->
            <div class="space-y-4 bg-white p-4 rounded-lg shadow-md">
                <div>
                    <p class="font-[Poppins] font-semibold text-lg">
                        Job Listings
                    </p>
                    <p class="text-secondary">
                        Manage all your job postings in one place
                    </p>
                </div>
                <SearchCompany :status="status" />
                <DataTable
                    :value="props.results ? props.results : props.jobs"
                    class="w-full text-center"
                    :rows="10"
                >
                    <Column field="name" header="Name"></Column>
                    <Column field="type" header="Type"></Column>
                    <Column field="status" header="Status">
                        <template #body="{ data }">
                            <p
                                :class="[
                                    'rounded-full px-2 py-1 text-sm font-medium w-full lg:w-[50%]',
                                    data.status === 'Active'
                                        ? 'text-blue-600'
                                        : 'text-red-600',
                                ]"
                            >
                                {{ data.status }}
                            </p>
                        </template>
                    </Column>
                    <Column field="created_at" header="Posted">
                        <template #body="{ data }">
                            <p>
                                {{
                                    new Date(
                                        data.created_at
                                    ).toLocaleDateString()
                                }}
                            </p>
                        </template>
                    </Column>
                    <Column field="actions" header="Actions">
                        <template #body="{ data }">
                            <div class="space-x-2">
                                <Button @click="deleteJob(data.id)"
                                    >Delete</Button
                                >
                                <Button @click="isViewJob = true">View</Button>
                            </div>
                        </template>
                    </Column>

                    <template #empty>
                        <div class="w-full py-4 text-center text-gray-500">
                            No jobs available.
                        </div>
                    </template>
                </DataTable>
            </div>
        </div>

        <Dialog v-model:visible="isAddJobModal" modal header="Job Details">
            <span class="text-surface-500 dark:text-surface-400 block mb-8"
                >Provide detailed information about the position to attract the
                right candidates</span
            >
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <InputLabel
                        for="job_title"
                        class="font-semibold w-full"
                        value="Job Title"
                    />

                    <InputText
                        v-model="form.job_title"
                        id="job_title"
                        class="w-full"
                        autocomplete="off"
                    />
                </div>
                <div class="space-y-2">
                    <InputLabel
                        for="address"
                        class="font-semibold w-full"
                        value="Address"
                    />
                    <InputText
                        v-model="form.address"
                        id="address"
                        class="w-full"
                        autocomplete="off"
                    />
                </div>
            </div>
            <div class="space-y-2 mb-4">
                <InputLabel
                    for="description"
                    class="font-semibold w-full"
                    value="Description"
                />

                <InputText
                    v-model="form.description"
                    id="description"
                    class="w-full"
                    autocomplete="off"
                />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <div class="space-y-2">
                    <InputLabel
                        for="category"
                        class="font-semibold w-full"
                        value="Category"
                    />
                    <Select
                        v-model="form.category"
                        class="w-full"
                        :options="categories"
                        optionLabel="name"
                    />
                </div>

                <div class="space-y-2">
                    <InputLabel
                        for="status"
                        class="font-semibold w-full"
                        value="Status"
                    />
                    <Select
                        v-model="form.status"
                        class="w-full"
                        :options="statusOptions"
                        optionLabel="name"
                    />
                </div>
                <div class="space-y-2">
                    <InputLabel
                        for="work_setup"
                        class="font-semibold w-full"
                        value="Work Setup"
                    />
                    <Select
                        v-model="form.work_setup"
                        class="w-full"
                        :options="workSetup"
                        optionLabel="name"
                    />
                </div>
                <div class="space-y-2">
                    <InputLabel
                        for="type"
                        class="font-semibold w-full"
                        value="Type"
                    />
                    <Select
                        v-model="form.type"
                        class="w-full"
                        :options="type"
                        optionLabel="name"
                    />
                </div>
            </div>
            <div class="space-y-2 mb-4">
                <InputLabel
                    for="salary"
                    class="font-semibold w-full"
                    value="Salary"
                />
                <InputText
                    v-model="form.salary"
                    id="salary"
                    class="w-full"
                    autocomplete="off"
                />
            </div>

            <div class="flex justify-end gap-2">
                <Button
                    type="button"
                    label="Cancel"
                    severity="secondary"
                    @click="visible = false"
                ></Button>
                <Button type="button" label="Save" @click="save"></Button>
            </div>
        </Dialog>

        <!-- When view is true -->
        <div v-if="isViewJob"></div>
    </AdminLayout>
</template>
