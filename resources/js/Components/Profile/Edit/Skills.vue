<script setup>
import { InputText } from "primevue";
import { ref } from "vue";

const skills = ref(["HTML", "CSS"]);

const removeIndex = (index) => {
    skills.value.splice(index, 1);
};
</script>

<template>
    <div class="bg-white rounded-lg p-5 space-y-4">
        <div class="space-y-6">
            <div>
                <h1 class="font-[Poppins] font-semibold text-2xl">Skills</h1>
                <p class="text-sm text-secondary">
                    Add skills that showcase your expertise to employers
                </p>
            </div>
            <div class="flex flex-col gap-y-4">
                <p>Your Skills</p>
                <div
                    class="border border-gray-200 p-2 rounded-md flex flex-wrap gap-x-2"
                >
                    <div
                        v-for="(skill, index) in skills"
                        :key="index"
                        class="bg-gray-100 px-2 py-1 rounded-full text-sm flex gap-x-2 items-center"
                    >
                        <span class="font-semibold">
                            {{ skill }}
                        </span>
                        <i @click="removeIndex(index)" class="pi pi-times"></i>
                    </div>
                </div>
                <InputText placeholder="Add a skill" />
            </div>
        </div>
    </div>
</template>
