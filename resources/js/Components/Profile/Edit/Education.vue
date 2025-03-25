<script setup>
import EducationComponent from "./EducationComponent.vue";
import { Button } from "primevue";
import { ref } from "vue";

let education = ref([{ id: 1 }]); // Start with an array containing one object
let educationCounter = ref(2); // Start from 2 since the first entry has id 1

const addEducation = () => {
    education.value.push({ id: educationCounter.value });
    educationCounter.value++; // Increment counter
};
const removeEducation = (index) => {
    education.value.splice(index, 1);
};
</script>

<template>
    <div class="bg-white rounded-lg p-5 space-y-4">
        <div class="space-y-6">
            <div>
                <h1 class="font-[Poppins] font-semibold text-2xl">Education</h1>
                <p class="text-sm text-secondary">
                    Add your educational background and qualifications
                </p>
            </div>
        </div>
        <div class="space-y-6">
            <div v-for="(educ, index) in education" :key="index">
                <EducationComponent
                    :index="index + 1"
                    @removeEducation="removeEducation(index)"
                />
            </div>
            <div class="">
                <Button @click="addEducation" class="w-full"
                    >Add Education</Button
                >
            </div>
        </div>
        <div class="flex gap-x-4 justify-end">
            <Button>Cancel</Button>
            <Button>Save</Button>
        </div>
    </div>
</template>
