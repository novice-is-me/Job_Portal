<script setup>
import { ref } from "vue";
import WorkComponent from "./WorkComponent.vue";
import { Button } from "primevue";

// Store multiple work experiences
const workExperiences = ref([]);

// Add a new work experience
const addWork = () => {
    workExperiences.value.push({
        id: Date.now(), // Unique ID
        position: "",
        company: "",
        startDate: "",
        endDate: "",
    });
};

// Update the specific work experience data
const updateWork = (index, updatedData) => {
    workExperiences.value[index] = updatedData;
};

// Remove a work experience (optional)
const removeWork = (index) => {
    workExperiences.value.splice(index, 1);
};

// Save all work experiences (example)
const saveWorkExperiences = () => {
    console.log("Saved Work Experiences:", workExperiences.value);
};
</script>

<template>
    <div class="bg-white rounded-lg p-5 divide-y-2 divide-gray-100">
        <div class="space-y-6">
            <div>
                <h1 class="font-[Poppins] font-semibold text-2xl">
                    Work Experience
                </h1>
                <p class="text-sm text-secondary">
                    Add your work history to showcase your professional
                    experience
                </p>
            </div>
            <div>
                <Button class="mb-4" @click="addWork">
                    <i class="pi pi-plus"></i>
                    Add Work
                </Button>

                <!-- Render WorkComponent dynamically -->
                <div v-for="(work, index) in workExperiences" :key="work.id">
                    <WorkComponent
                        :workData="work"
                        @updateWork="updateWork(index, $event)"
                        @removeWork="removeWork(index)"
                    />
                </div>

                <div class="flex justify-end gap-x-4 mt-4">
                    <Button>Cancel</Button>
                    <Button @click="saveWorkExperiences">Save</Button>
                </div>
            </div>
        </div>
    </div>
</template>
