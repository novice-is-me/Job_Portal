<script setup>
import { ref } from "vue";
import SkillsComponent from "./SkillsComponent.vue";

const skills = ref([
    "PHP",
    "Laravel",
    "Vue.js",
    "Tailwind CSS",
    "Mysql",
    "Javascript",
    "Docker",
]);
</script>

<template>
    <div class="bg-white p-4 rounded-lg space-y-2">
        <h1 class="font-[Poppins] text-lg font-semibold">Skills</h1>
        <div class="flex flex-wrap gap-2">
            <div v-for="(skill, index) in skills" :key="index" class="">
                <SkillsComponent :skill="skill" />
            </div>
        </div>
    </div>
</template>
