<script setup>
import ContactInfoComponent from "@/Components/Profile/ContactInfoComponent.vue";
import ProfileComponent from "@/Components/Profile/ProfileComponent.vue";
import SkillDetailComponent from "@/Components/Profile/SkillDetailComponent.vue";
import ApplicationsComponent from "@/Components/Profile/Tabs/ApplicationsComponent.vue";
import DocumentsComponent from "@/Components/Profile/Tabs/DocumentsComponent.vue";
import FullProfileComponent from "@/Components/Profile/Tabs/FullProfileComponent.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link, Head } from "@inertiajs/vue3";
import { ref } from "vue";

// For tracking active tabs
const isDocuments = ref(true);
const isApplications = ref(false);
const isFullProfile = ref(false);

const toggleDocumentsView = () => {
    isDocuments.value = true;
    isApplications.value = false;
    isFullProfile.value = false;
};

const toggleApplicationsView = () => {
    isDocuments.value = false;
    isApplications.value = true;
    isFullProfile.value = false;
};

const toggleFullProfileView = () => {
    isDocuments.value = false;
    isApplications.value = false;
    isFullProfile.value = true;
};
</script>

<template>
    <Head />

    <AuthenticatedLayout>
        <div class="border-t-2 border-gray-300 px-12 py-4 bg-white">
            <Link
                class="mx-auto max-w-7xl sm:px-6 lg:px-8 flex items-center gap-2"
                :href="route('dashboard')"
            >
                <i class="pi pi-angle-left"></i>
                <p>Back</p>
            </Link>
        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-cols-[1fr_2fr] gap-x-4">
                    <!-- Left side -->
                    <div class="border space-y-6">
                        <!-- Profile Section -->
                        <div>
                            <ProfileComponent />
                        </div>
                        <!-- Contact Information -->
                        <div>
                            <ContactInfoComponent />
                        </div>
                        <div>
                            <SkillDetailComponent />
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div
                            class="flex justify-evenly p-1 bg-[#ECEEF0] text-center"
                        >
                            <a
                                @click="toggleDocumentsView"
                                :class="[
                                    'bordern font-medium w-full py-2 rounded-md hover:cursor-pointer',
                                    isDocuments ? 'bg-white' : 'bg-transparent',
                                ]"
                                >Documents</a
                            >
                            <a
                                @click="toggleApplicationsView"
                                :class="[
                                    'border font-medium w-full py-2 rounded-md hover:cursor-pointer',
                                    isApplications
                                        ? 'bg-white'
                                        : 'bg-transparent',
                                ]"
                                >Applications</a
                            >
                            <a
                                @click="toggleFullProfileView"
                                :class="[
                                    'border font-medium w-full py-2 rounded-md hover:cursor-pointer',
                                    isFullProfile
                                        ? 'bg-white'
                                        : 'bg-transparent',
                                ]"
                                >Full Profile</a
                            >
                        </div>
                        <div v-if="isDocuments">
                            <DocumentsComponent />
                        </div>
                        <div v-if="isApplications">
                            <ApplicationsComponent />
                        </div>
                        <div v-if="isFullProfile">
                            <FullProfileComponent />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>
