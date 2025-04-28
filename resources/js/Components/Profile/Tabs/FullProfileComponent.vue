<script setup>
import EducationComponent from "./Partials/EducationComponent.vue";
import WorkExperience from "./Partials/WorkExperience.vue";

const props = defineProps({
    user: Object,
});

console.log(props.user);
</script>

<template>
    <div
        v-if="
            user.work_experiences.length > 0 ||
            user.introduction ||
            user.educations.length > 0 ||
            user.website ||
            user.github ||
            user.linkedin ||
            user.portfolio
        "
        class="space-y-6"
    >
        <!-- Professional Summary -->
        <div v-if="user.introduction" class="bg-white p-6 rounded-lg space-y-4">
            <h1 class="font-[Poppins] text-xl font-semibold">
                Professional Summary
            </h1>
            <p>
                {{ user.introduction }}
            </p>
        </div>
        <!-- Work Experience -->
        <div
            v-if="user.work_experiences.length > 0"
            class="bg-white p-6 rounded-lg space-y-4"
        >
            <h1 class="font-[Poppins] text-xl font-semibold">
                Work Experience
            </h1>
            <div
                v-for="workExp in user.work_experiences"
                :key="workExp.id"
                class=""
            >
                <WorkExperience :workExp="workExp" />
            </div>
        </div>
        <!-- Education -->
        <div
            v-if="user.educations.length > 0"
            v-for="education in user.educations"
            :key="education.id"
            class="bg-white p-6 rounded-lg space-y-4"
        >
            <EducationComponent :education="education" />
        </div>
        <!-- Portfolio and Links -->
        <div
            v-if="
                user.website || user.github || user.linkedin || user.portfolio
            "
            class="bg-white p-6 rounded-lg space-y-4"
        >
            <h1 class="font-[Poppins] text-xl font-semibold">
                Portfolio & Links
            </h1>
            <div class="space-y-4">
                <div
                    v-if="user.website"
                    class="flex gap-x-3 items-center justify-between"
                >
                    <div class="flex gap-x-2 items-center">
                        <i class="pi pi-globe"></i>
                        <p>Personal Website</p>
                    </div>
                    <a
                        :href="user.website"
                        target="_blank"
                        class="flex gap-x-2 items-center border px-3 py-1 rounded-lg"
                    >
                        <i
                            class="pi pi-external-link"
                            style="font-size: 0.8rem"
                        ></i>
                        <p>Visit</p>
                    </a>
                </div>
                <div
                    v-if="user.github"
                    class="flex gap-x-3 items-center justify-between"
                >
                    <div class="flex gap-x-2 items-center">
                        <i class="pi pi-github"></i>
                        <p>Github</p>
                    </div>
                    <a
                        :href="user.github"
                        target="_blank"
                        class="flex gap-x-2 items-center border px-3 py-1 rounded-lg"
                    >
                        <i
                            class="pi pi-external-link"
                            style="font-size: 0.8rem"
                        ></i>
                        <p>Visit</p>
                    </a>
                </div>
                <div
                    v-if="user.linkedin"
                    class="flex gap-x-3 items-center justify-between"
                >
                    <div class="flex gap-x-2 items-center">
                        <i class="pi pi-linkedin"></i>
                        <p>Linkedin</p>
                    </div>
                    <a
                        :href="user.linkedin"
                        target="_blank"
                        class="flex gap-x-2 items-center border px-3 py-1 rounded-lg"
                    >
                        <i
                            class="pi pi-external-link"
                            style="font-size: 0.8rem"
                        ></i>
                        <p>Visit</p>
                    </a>
                </div>
                <div
                    v-if="user.portfolio"
                    class="flex gap-x-3 items-center justify-between"
                >
                    <div class="flex gap-x-2 items-center">
                        <i class="pi pi-file"></i>
                        <p>Portfolio</p>
                    </div>
                    <a
                        :href="user.portfolio"
                        target="_blank"
                        class="flex gap-x-2 items-center border px-3 py-1 rounded-lg"
                    >
                        <i
                            class="pi pi-external-link"
                            style="font-size: 0.8rem"
                        ></i>
                        <p>Visit</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div
        v-else
        class="bg-white p-4 rounded-lg space-y-4 flex justify-between items-center"
    >
        <h1 class="font-[Poppins] text-xl font-semibold">
            No Information Available
        </h1>
        <a
            :href="route('profile.edit')"
            class="text-center border border-gray-200 px-3 py-2 rounded-md"
        >
            Edit Profile
        </a>
    </div>
</template>
