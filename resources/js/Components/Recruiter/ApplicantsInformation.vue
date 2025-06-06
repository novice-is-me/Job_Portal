<script setup>
import { ref } from "vue";
import ApplicantsBasicInformation from "./ApplicantsBasicInformation.vue";
import WorkExperience from "../Profile/Tabs/Partials/WorkExperience.vue";
import EducationComponent from "../Profile/Tabs/Partials/EducationComponent.vue";
import SkillsComponent from "../Job/SkillsComponent.vue";
import ApplicantsDocument from "./ApplicantsDocument.vue";
import { Avatar } from "primevue";

const props = defineProps({
    applicant: Object,
    isViewApplicant: Boolean,
});

const applicantExperience = ref(props.applicant.user.work_experiences);
const applicantEducation = ref(props.applicant.user.educations);
const applicantSkill = ref(props.applicant.user.skills);
const isActiveTab = ref("profile");

const emit = defineEmits(["close"]);

const formatDate = (date) => {
    return new Date(date).toLocaleDateString();
};

const changeActiveTab = (tab) => {
    isActiveTab.value = tab;
    console.log("Active tab changed to:", tab);
};

const formatInterviewSchedule = (date) => {
    if (!date) return null;
    return new Date(date).toLocaleString("en-US", {
        year: "numeric",
        month: "short",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        hour12: true,
    });
};

const back = () => {
    emit("close");
    // Make a refresh
    window.location.reload();
};
</script>

<template>
    <div>
        <!-- Header -->
        <div
            class="flex items-center gap-x-4 hover:cursor-pointer"
            @click="back"
        >
            <i class="pi pi-angle-left tex-2xl font-semibold"></i>
            <p>Back</p>
        </div>

        <div
            class="bg-white p-4 rounded-lg shadow-md mt-4 flex justify-between items-center"
        >
            <div class="space-y-4">
                <div class="flex items-center gap-x-4">
                    <div
                        v-if="applicant.user.profile_picture"
                        class="bg-gray-400 rounded-full overflow-hidden w-20 h-20"
                    >
                        <img
                            :src="`/storage/${applicant.user.profile_picture}`"
                            alt=""
                        />
                    </div>
                    <Avatar
                        v-if="!applicant.user.profile_picture"
                        size="large"
                        shape="circle"
                        icon="pi pi-user"
                    />
                    <div>
                        <p class="font-[Poppins] text-xl font-bold">
                            {{ applicant.user.name }}
                        </p>
                        <p class="text-secondary">
                            {{ applicant.user.headline }}
                        </p>
                    </div>
                </div>
                <div
                    v-if="applicant.interview_at"
                    class="flex items-center gap-x-2 text-red-500"
                >
                    <i class="pi pi-calendar"></i>
                    <p>{{ formatInterviewSchedule(applicant.interview_at) }}</p>
                </div>
                <div
                    v-if="applicant.status === 3"
                    class="flex items-center gap-x-2 text-red-500"
                >
                    <i class="pi pi-calendar"></i>
                    <p>Rejected</p>
                </div>
            </div>
            <div>
                <i></i>
                <p>
                    Applied on:
                    {{ formatDate(applicant.created_at) }}
                </p>
            </div>
        </div>

        <!-- Tab -->
        <div class="bg-gray-200 rounded-lg p-2 mt-4 inline-flex gap-x-2">
            <div
                :class="[
                    'flex items-center gap-x-4 p-2 rounded-md',
                    isActiveTab === 'profile' ? 'bg-white' : '',
                ]"
                @click="changeActiveTab('profile')"
            >
                <p class="font-[Poppins] text-xl font-bold">Profile</p>
            </div>
            <div
                :class="[
                    'flex items-center gap-x-4 p-2 rounded-md',
                    isActiveTab === 'documents' ? 'bg-white' : '',
                ]"
                @click="changeActiveTab('documents')"
            >
                <p class="font-[Poppins] text-xl font-bold">Documents</p>
            </div>
        </div>

        <!-- For profile tab -->
        <div v-if="isActiveTab === 'profile'">
            <ApplicantsBasicInformation :applicant="applicant" />
            <div class="bg-white p-4 rounded-lg shadow-md mt-4 space-y-4">
                <p class="font-[Poppins] text-xl font-bold">Work Experience</p>
                <div
                    v-for="(experience, index) in applicantExperience"
                    :key="index"
                    class="pb-4"
                >
                    <WorkExperience :workExp="experience" />
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md mt-4">
                <div
                    v-for="(education, index) in applicantEducation"
                    :key="index"
                    class="pb-4"
                >
                    {{ console.log(education) }}
                    <EducationComponent :education="education" />
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md mt-4">
                <p class="font-[Poppins] text-xl font-bold">Skills</p>
                <div
                    v-if="applicantSkill.length > 0"
                    class="flex flex-wrap gap-4 mt-4"
                >
                    <div v-for="(skill, index) in applicantSkill" :key="index">
                        {{ console.log(skill) }}
                        <SkillsComponent :skill="skill.skill" />
                    </div>
                </div>
                <div v-else class="text-center">
                    <p class="text-secondary text-sm">No skills added yet.</p>
                </div>
            </div>
        </div>

        <!-- For document Tab -->
        <div v-if="isActiveTab === 'documents'">
            <div class="bg-white p-4 rounded-lg shadow-md mt-4 space-y-4">
                <p class="font-[Poppins] text-xl font-bold">Documents</p>
                <!-- Resume -->
                <ApplicantsDocument :applicant="applicant.user" />
            </div>
        </div>
    </div>
</template>
