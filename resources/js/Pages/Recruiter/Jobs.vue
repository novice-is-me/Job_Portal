<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Button, DataTable, Column } from "primevue";
import SearchCompany from "@/Components/Recruiter/SearchCompany.vue";

const props = defineProps({
    company: Object,
    jobs: Object,
    results: Object,
});

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
</script>

<template>
    <Head title="Recruiter" />
    <AdminLayout>
        <div class="bg-gray-100 p-4">
            <div class="flex items-center justify-between gap-x-4 p-4">
                <div>
                    <p class="font-[Poppins] text-xl font-bold">
                        Manage Company
                    </p>
                </div>
                <div>
                    <Button>Post New Job</Button>
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
                                    'rounded-full border px-2 py-1 text-sm font-medium w-full lg:w-[50%]',
                                    data.status === 'Active'
                                        ? 'text-blue-600 bg-blue-100 border-blue-300'
                                        : 'text-red-600 bg-red-100 border-red-300',
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
                            <Button>Delete</Button>
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
    </AdminLayout>
</template>
