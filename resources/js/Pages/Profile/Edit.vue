<script setup>
import BasicInformation from "@/Components/Profile/Edit/BasicInformation.vue";
import Documents from "@/Components/Profile/Edit/Documents.vue";
import Education from "@/Components/Profile/Edit/Education.vue";
import Skills from "@/Components/Profile/Edit/Skills.vue";
import SocialLinks from "@/Components/Profile/Edit/SocialLinks.vue";
import WorkExperience from "@/Components/Profile/Edit/WorkExperience.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";

const prop = defineProps({
    user: Object,
    skills: Object,
});

console.log(prop.user);
const tabs = [
    { title: "Basic Information", icon: "pi-user", value: "basic_information" },
    { title: "Work Experience", icon: "pi-building", value: "work_experience" },
    { title: "Education", icon: "pi-graduation-cap", value: "education" },
    { title: "Skills", icon: "pi-lightbulb", value: "skills" },
    { title: "Documents", icon: "pi-file", value: "documents" },
    { title: "Social Links", icon: "pi-globe", value: "social_links" },
];

const defaultTab = ref("basic_information");
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <div class="border-t-2 border-gray-300 px-12 py-4 bg-white">
            <Link
                class="mx-auto max-w-7xl sm:px-6 lg:px-8 flex items-center gap-2"
                :href="route('profile.index')"
            >
                <i class="pi pi-angle-left"></i>
                <p>Back</p>
            </Link>
        </div>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-cols-[1fr_3fr] gap-x-4">
                    <!-- Left side -->
                    <div class="bg-white p-4 space-y-3 rounded-lg h-fit">
                        <div
                            v-for="(tab, index) in tabs"
                            :key="index"
                            :class="[
                                'flex items-center gap-4 px-3 py-2 rounded-lg text-black hover:cursor-pointer',
                                defaultTab === tab.value
                                    ? 'bg-primary text-white'
                                    : 'bg-white ',
                            ]"
                            @click="defaultTab = tab.value"
                        >
                            <i :class="['pi', tab.icon]"></i>
                            <p>{{ tab.title }}</p>
                        </div>
                    </div>
                    <!-- Right side -->
                    <div class="">
                        <BasicInformation
                            :user="user"
                            v-if="defaultTab === 'basic_information'"
                        />
                        <WorkExperience
                            :user="user"
                            v-if="defaultTab === 'work_experience'"
                        />
                        <Education
                            :user="user"
                            v-if="defaultTab === 'education'"
                        />
                        <Skills
                            :user="user"
                            :skills="skills"
                            v-if="defaultTab === 'skills'"
                        />
                        <Documents
                            :user="user"
                            v-if="defaultTab === 'documents'"
                        />
                        <SocialLinks
                            :user="user"
                            v-if="defaultTab === 'social_links'"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
