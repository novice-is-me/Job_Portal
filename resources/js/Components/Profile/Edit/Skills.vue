<script setup>
import { ref, computed, watch } from "vue";
import { Button, AutoComplete } from "primevue";

const props = defineProps({
    user: Object,
    skills: Array,
});

// Convert skills list properly
const skills = computed(() => props.skills.map((skill) => skill.name));

const selectedSkill = ref(""); // Holds the current input for AutoComplete
const selectedSkills = ref([]); // Stores added skills
const filteredSkills = ref([]);
const showAddButton = ref(false);

// Function to filter skills based on user input
const search = (event) => {
    console.log("Searching for skills:", event.query);
    setTimeout(() => {
        if (!event.query.trim().length) {
            filteredSkills.value = [...skills.value]; // Show all skills if input is empty
        } else {
            filteredSkills.value = skills.value.filter(
                (skill) =>
                    skill.toLowerCase().includes(event.query.toLowerCase()) // Correct filtering logic
            );
        }

        // If there are no matching skills and input is not empty, show the add button
        if (
            filteredSkills.value.length === 0 &&
            event.query.trim().length > 0
        ) {
            showAddButton.value = true;
        }
    }, 100);
};

// Function to add a skill when selected
const addSkill = (event) => {
    if (event && event.value && !selectedSkills.value.includes(event.value)) {
        selectedSkills.value.push(event.value);
    }
    selectedSkill.value = ""; // Clear input after selection
};

// Remove a skill from the list
const removeSkill = (index) => {
    selectedSkills.value.splice(index, 1);
};

const save = () => {
    console.log("Saving skills:", selectedSkills.value);
};

watch(selectedSkills.value, (newSkills) => {
    console.log("Updated skills:", newSkills);
});

const addNewSkill = () => {
    selectedSkills.value.push(selectedSkill.value);
    selectedSkill.value = ""; // Clear input after adding
};

const clear = () => {
    selectedSkill.value = ""; // Clear input
    selectedSkills.value = []; // Clear selected skills
    showAddButton.value = false; // Hide add button
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
            <div class="flex flex-col gap-y-4 w-full">
                <p>Your Skills</p>
                <div
                    class="border border-gray-200 p-2 rounded-md flex flex-wrap gap-x-2 min-h-[40px]"
                >
                    <div
                        v-for="(skill, index) in selectedSkills"
                        :key="index"
                        class="bg-gray-100 px-2 py-1 rounded-full text-sm flex gap-x-2 items-center"
                    >
                        <span class="font-semibold">
                            {{ skill }}
                        </span>
                        <i
                            @click="removeSkill(index)"
                            class="pi pi-times cursor-pointer"
                        ></i>
                    </div>
                </div>

                <!-- AutoComplete Input -->
                <div class="flex gap-x-2 items-center">
                    <AutoComplete
                        v-model="selectedSkill"
                        :suggestions="filteredSkills"
                        @complete="search"
                        @item-select="addSkill"
                        placeholder="Add a skill"
                        class="w-full"
                    />
                    <Button v-if="showAddButton" @click="addNewSkill"
                        >Add</Button
                    >
                </div>
            </div>
        </div>
        <div class="flex gap-x-4 justify-end">
            <Button label="Cancel" @click="clear" />
            <Button label="Save" @click="save" />
        </div>
    </div>
</template>

<style scoped>
:deep(.p-inputtext) {
    width: 100% !important;
}
</style>
