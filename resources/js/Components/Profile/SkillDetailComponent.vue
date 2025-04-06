<script setup>
import SkillsComponent from "../Job/SkillsComponent.vue";
import { ref } from "vue";

const props = defineProps({
    user: Object,
});

const user = ref(props.user);
</script>

<template>
    <div class="bg-white p-6 rounded-lg space-y-4">
        <div class="flex justify-between items-center">
            <h1 class="font-[Poppins] font-semibold text-xl">Skills</h1>
            <i class="pi pi-pen-to-square"></i>
        </div>
        <div class="flex gap-2 flex-wrap">
            <div v-for="skill in user.skills" :key="skill">
                <SkillsComponent :skill="skill.skill" />
            </div>
        </div>
    </div>
</template>
