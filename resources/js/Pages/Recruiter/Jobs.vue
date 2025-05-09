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
import { ref, watch } from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import StatusCard from "@/Components/Recruiter/StatusCard.vue";

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
const selectedJob = ref(null);
const isEditJobModal = ref(false);

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

const formEdit = useForm({
    job_title: selectedJob.value?.name,
    address: selectedJob.value?.address,
    description: selectedJob.value?.description,
    category: selectedJob.value?.category.name,
    status: selectedJob.value?.status,
    work_setup: selectedJob.value?.work_setup,
    type: selectedJob.value?.type,
    salary: selectedJob.value?.salary,
});

const isDisabled = ref(
    form.job_title === "" ||
        form.address === "" ||
        form.description === "" ||
        form.category === "" ||
        form.status === "" ||
        form.work_setup === "" ||
        form.type === "" ||
        form.salary === ""
);

const isDisabledEdit = ref(
    formEdit.job_title === "" ||
        formEdit.address === "" ||
        formEdit.description === "" ||
        formEdit.category === "" ||
        formEdit.status === "" ||
        formEdit.work_setup === "" ||
        formEdit.type === "" ||
        formEdit.salary === ""
);

const viewJob = (data) => {
    isViewJob.value = true;
    selectedJob.value = data;
    console.log(selectedJob.value);
};

const editJob = () => {
    isEditJobModal.value = true;

    console.log(formEdit);
    formEdit.job_title = selectedJob.value.name;
    formEdit.address = selectedJob.value.address;
    formEdit.description = selectedJob.value.content;
    formEdit.category = selectedJob.value.category;
    formEdit.status = statusOptions.find(
        (opt) => opt.name === selectedJob.value.status
    );
    formEdit.work_setup = workSetup.find(
        (opt) => opt.name === selectedJob.value.work_setup
    );
    formEdit.type = type.find((opt) => opt.name === selectedJob.value.type);

    formEdit.salary = selectedJob.value.salary;
};

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

const saveEditJob = () => {
    formEdit.post(
        route("dashboard.recruiter.update.job", {
            job_id: selectedJob.value.id,
        }),
        {
            preserveScroll: true,
            onSuccess: (res) => {
                isEditJobModal.value = false;

                // Update the selected job with the edited values
                Object.assign(selectedJob.value, {
                    name: formEdit.job_title,
                    address: formEdit.address,
                    content: formEdit.description,
                    category: formEdit.category,
                    status: formEdit.status.name,
                    work_setup: formEdit.work_setup.name,
                    type: formEdit.type.name,
                    salary: formEdit.salary,
                });

                // Optionally update the jobs list if needed
                const jobIndex = props.jobs.findIndex(
                    (job) => job.id === selectedJob.value.id
                );
                if (jobIndex !== -1) {
                    props.jobs[jobIndex] = { ...selectedJob.value };
                }

                toast.add({
                    severity: "success",
                    summary: "Success",
                    detail: "Job updated successfully",
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
                                <Button @click="viewJob(data)">View</Button>
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
                    @click="isAddJobModal = false"
                ></Button>
                <Button
                    type="button"
                    label="Save"
                    @click="save"
                    :disabled="isDisabled"
                ></Button>
            </div>
        </Dialog>

        <!-- When view is true -->
        <div v-if="isViewJob" class="bg-gray-100 p-4">
            <div
                class="flex items-center gap-x-4 hover:cursor-pointer"
                @click="isViewJob = false"
            >
                <i class="pi pi-angle-left tex-2xl font-semibold"></i>
                <p>Back</p>
            </div>
            <div class="flex items-center justify-between gap-x-4 p-4">
                <div>
                    <p class="font-[Poppins] text-xl font-bold">
                        {{ selectedJob.name }}
                    </p>
                    <p class="text-secondary text-sm">
                        {{ selectedJob.address }}
                    </p>
                </div>

                <Button @click="editJob">Edit Job</Button>
            </div>

            <div class="w-full md:w-[25%]">
                <StatusCard
                    :title="'Total Applicants'"
                    :count="selectedJob.applications.length"
                    :icon="'pi pi-users'"
                    :color="'bg-green-100'"
                    :text="'text-green-500'"
                />
            </div>

            <!-- Content -->
            <div class="p-4 bg-white rounded-lg shadow-md space-y-4">
                <div>
                    <p class="font-semibold text-xl">About the Job</p>
                    <p>{{ selectedJob.content }}</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div class="space-y-2">
                        <p class="font-semibold">Category</p>
                        <p>{{ selectedJob.category.name }}</p>
                    </div>
                    <div class="space-y-2">
                        <p class="font-semibold">Status</p>
                        <p>{{ selectedJob.status }}</p>
                    </div>
                    <div class="space-y-2">
                        <p class="font-semibold">Work Setup</p>
                        <p>{{ selectedJob.work_setup }}</p>
                    </div>
                    <div class="space-y-2">
                        <p class="font-semibold">Type</p>
                        <p>{{ selectedJob.type }}</p>
                    </div>
                    <div class="space-y-2">
                        <p class="font-semibold">Salary</p>
                        <p>${{ selectedJob.salary }}</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <p class="font-semibold">Managed by:</p>
                    <p>{{ selectedJob.recruiter.name }}</p>
                </div>
            </div>
        </div>

        <Dialog v-model:visible="isEditJobModal" modal header="Job Details">
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
                        v-model="formEdit.job_title"
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
                        v-model="formEdit.address"
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
                    v-model="formEdit.description"
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
                        v-model="formEdit.category"
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
                        v-model="formEdit.status"
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
                        v-model="formEdit.work_setup"
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
                        v-model="formEdit.type"
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
                    v-model="formEdit.salary"
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
                    @click="isEditJobModal = false"
                ></Button>
                <Button
                    type="button"
                    label="Save"
                    @click="saveEditJob"
                    :disabled="isDisabledEdit"
                ></Button>
            </div>
        </Dialog>
    </AdminLayout>
</template>
