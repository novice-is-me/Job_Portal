<script setup>
import ContactInfoComponent from "@/Components/Profile/ContactInfoComponent.vue";
import ProfileComponent from "@/Components/Profile/ProfileComponent.vue";
import SkillDetailComponent from "@/Components/Profile/SkillDetailComponent.vue";
import ApplicationsComponent from "@/Components/Profile/Tabs/ApplicationsComponent.vue";
import DocumentsComponent from "@/Components/Profile/Tabs/DocumentsComponent.vue";
import FullProfileComponent from "@/Components/Profile/Tabs/FullProfileComponent.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link, Head } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import { Button } from "primevue";

const props = defineProps({
    user: Object,
    job_applications: Object,
    skills: Object,
    results: Object,
});

console.log(props.user);
// For tracking active tabs
const isDocuments = ref(true);
const isApplications = ref(false);
const isFullProfile = ref(false);
const userPercentage = ref(0);

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

const calculatePercentage = computed(() => {
    let percentage = 0;

    const basicInfo = props.user.name && props.user.email; // 15
    const contactInfo =
        props.user.email && props.user.phone && props.user.address; // 20
    const documentsInfo = props.user.resume || props.user.cover_letter; // 15
    const linkedInfo =
        props.user.github && props.user.linkedin && props.user.portfolio; // 10
    const workExperience = props.user.experience?.length > 0; // 15
    const educationInfo = props.user.education?.length > 0; // 15
    const skillsInfo = props.user.skills?.length > 0; // 10

    if (basicInfo) percentage += 15;
    if (contactInfo) percentage += 20;
    if (documentsInfo) percentage += 15;
    if (linkedInfo) percentage += 10;
    if (workExperience) percentage += 15;
    if (educationInfo) percentage += 15;
    if (skillsInfo) percentage += 10;

    return percentage;
});
</script>

<template>
    <Head />

    <AuthenticatedLayout>
        <div class="border-t-2 border-gray-300 px-12 py-4 bg-white">
            <div class="flex justify-between">
                <Link
                    class="max-w-7xl sm:px-6 lg:px-8 flex items-center gap-2"
                    :href="route('dashboard')"
                >
                    <i class="pi pi-angle-left"></i>
                    <p>Back</p>
                </Link>
                <Button :as="Link" :href="route('profile.edit')"
                    >Edit Profile</Button
                >
            </div>
        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-cols-[1fr_2fr] gap-x-4">
                    <!-- Left side -->
                    <div class="border space-y-6">
                        <!-- Profile Section -->
                        <div>
                            <ProfileComponent
                                :user="user"
                                :user_percentage="calculatePercentage"
                            />
                        </div>
                        <!-- Contact Information -->
                        <div>
                            <ContactInfoComponent :user="user" />
                        </div>
                        <div v-if="user.skills.length > 0">
                            <SkillDetailComponent
                                :user="user"
                                :skills="skills"
                            />
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
                            <DocumentsComponent :user="user" />
                        </div>
                        <div v-if="isApplications">
                            <ApplicationsComponent
                                :job_applications="job_applications"
                                :results="results"
                            />
                        </div>
                        <div v-if="isFullProfile">
                            <FullProfileComponent :user="user" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>
