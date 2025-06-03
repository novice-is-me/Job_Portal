<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import SearchApplicant from "@/Components/Recruiter/SearchApplicant.vue";
import { DataTable, Column, Button } from "primevue";
import { ref } from "vue";
import ApplicantsInformation from "@/Components/Recruiter/ApplicantsInformation.vue";
import SideViewInformation from "@/Components/Recruiter/SideViewInformation.vue";

const props = defineProps({
    applicants: Array,
});

const isViewApplicant = ref(false);
const selectedApplicant = ref(null);

console.log(props.applicants);

const viewApplicant = async (data) => {
    isViewApplicant.value = true;
    selectedApplicant.value = data;

    // Add a method that will change the status from pending to reviewed
    try {
        const result = await axios.post(
            route("dashboard.recruiter.update.status"),
            {
                data: data,
            }
        );
    } catch (error) {
        console.error("Error updating applicant status:", error);
    }
};
</script>

<template>
    <Head title="Recruiter" />
    <AdminLayout>
        <div v-if="!isViewApplicant" class="bg-gray-100 p-4">
            <div class="flex items-center justify-between gap-x-4 p-4">
                <p class="font-[Poppins] text-xl font-bold">
                    Manage Applicants
                </p>
            </div>

            <div class="space-y-4 bg-white p-4 rounded-lg shadow-md">
                <div>
                    <p class="font-[Poppins] font-semibold text-lg">
                        All Applicants
                    </p>
                    <p class="text-secondary">
                        Review and manage all job applications
                    </p>
                </div>

                <SearchApplicant />
                <DataTable :value="props.applicants" class="w-full">
                    <Column field="user.name" header="Applicant"></Column>
                    <Column field="job.name" header="Job"></Column>
                    <Column field="job_status.name" header="Status">
                        {{ console.log("data", data) }}
                        <template #body="{ data }">
                            <p
                                :class="[
                                    'rounded-full px-2 py-1 text-sm font-medium w-full lg:w-[50%]',
                                    data.job_status.name === 'Pending'
                                        ? 'text-yellow-500'
                                        : data.job_status.name === 'Reviewed'
                                        ? 'text-blue-600'
                                        : data.job_status.name === 'Rejected'
                                        ? 'text-red-600'
                                        : data.job_status.name === 'Interview'
                                        ? 'text-green-600'
                                        : '',
                                ]"
                            >
                                {{ data.job_status.name }}
                            </p>
                        </template></Column
                    >
                    <Column field="created_at" header="Applied">
                        <template #body="{ data }">
                            <p>
                                {{
                                    new Date(
                                        data.created_at
                                    ).toLocaleDateString()
                                }}
                            </p>
                        </template></Column
                    >
                    <Column field="action" header="Actions">
                        <template #body="{ data }">
                            <div class="">
                                <Button
                                    class="bg-white"
                                    @click="viewApplicant(data)"
                                    ><i class="pi pi-eye"></i
                                ></Button>
                            </div> </template
                    ></Column>
                </DataTable>
            </div>
        </div>

        <!-- Applicants info -->
        <div
            v-if="isViewApplicant"
            class="bg-gray-100 p-4 grid grid-cols-1 md:grid-cols-[2fr,1fr] gap-x-4 gap-y-4"
        >
            <ApplicantsInformation
                :applicant="selectedApplicant"
                @close="isViewApplicant = false"
            />
            <SideViewInformation :applicant="selectedApplicant" />
        </div>
    </AdminLayout>
</template>
