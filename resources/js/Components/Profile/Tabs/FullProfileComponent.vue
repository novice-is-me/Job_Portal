<script setup>
import EducationComponent from "./Partials/EducationComponent.vue";
import WorkExperience from "./Partials/WorkExperience.vue";

const props = defineProps({
    user: Object,
});

console.log(props.user);
</script>

<template>
    <div class="space-y-6">
        <!-- Professional Summary -->
        <div class="bg-white p-6 rounded-lg space-y-4">
            <h1 class="font-[Poppins] text-xl font-semibold">
                Professional Summary
            </h1>
            <p>
                {{ user.introduction }}
            </p>
        </div>
        <!-- Work Experience -->
        <div class="bg-white p-6 rounded-lg space-y-4">
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
            v-for="education in user.educations"
            :key="education.id"
            class="bg-white p-6 rounded-lg space-y-4"
        >
            <EducationComponent :education="education" />
        </div>
        <!-- Certifications -->
        <div class="bg-white p-6 rounded-lg space-y-4">
            <h1 class="font-[Poppins] text-xl font-semibold">Certifications</h1>
            <div class="flex gap-x-3 items-start">
                <i
                    class="fa-solid fa-award border p-2 rounded-lg bg-blue-100 text-blue-700"
                    style="font-size: 1.25rem"
                ></i>
                <div>
                    <p class="font-semibold font-[Poppins]">
                        Google UX Design Professional Certificate
                    </p>
                    <p>Issued May 2020</p>
                </div>
            </div>
            <!-- Another -->
            <div class="flex gap-x-3 items-start">
                <i
                    class="fa-solid fa-award border p-2 rounded-lg bg-blue-100 text-blue-700"
                    style="font-size: 1.25rem"
                ></i>
                <div>
                    <p class="font-semibold font-[Poppins]">
                        Certified Usability Analyst (CUA)
                    </p>
                    <p>Issued May 2020</p>
                </div>
            </div>
        </div>
        <!-- Portfolio and Links -->
        <div class="bg-white p-6 rounded-lg space-y-4">
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
</template>
