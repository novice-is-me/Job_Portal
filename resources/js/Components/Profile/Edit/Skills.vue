<script setup>
import { ref, computed } from "vue";
import { Button, AutoComplete } from "primevue";
import axios from "axios";

const props = defineProps({
    user: Object,
    skills: Array, // Skills passed from the parent
});

const skills = ref([...props.skills]); // Create a local reactive copy of skills
const selectedSkill = ref(""); // Holds the current input for AutoComplete
const selectedSkills = ref(
    props.user.skills.length > 0
        ? props.user.skills.map((skill) => skill.skill_id) // If user has skills, store their IDs
        : []
); // If no skills, store an empty array

const filteredSkills = ref([...skills.value]); // Filtered list for suggestions
const showAddButton = ref(false);

// Function to filter skills based on user input
const search = (event) => {
    console.log("Searching for skills:", event.query);
    setTimeout(() => {
        if (!event.query || !event.query.trim()) {
            // If there's no input, reset the filtered list
            filteredSkills.value = skills.value.map((skill) => skill.name);
        } else {
            filteredSkills.value = skills.value
                .filter((skill) =>
                    skill.name.toLowerCase().includes(event.query.toLowerCase())
                )
                .map((skill) => skill.name);
        }

        // If there are no matching skills and input is not empty, show the add button
        if (
            filteredSkills.value.length === 0 &&
            event.query.trim().length > 0
        ) {
            showAddButton.value = true;
        } else {
            showAddButton.value = false;
        }
    }, 100);
};

// Function to add a skill when selected
const addSkill = (event) => {
    if (event && event.value) {
        const selectedSkillObj = skills.value.find(
            (skill) => skill.name === event.value
        );
        if (
            selectedSkillObj &&
            !selectedSkills.value.includes(selectedSkillObj.id)
        ) {
            selectedSkills.value.push(selectedSkillObj.id); // Store the skill ID
        }
    }
    selectedSkill.value = ""; // Clear input after selection
};

// Remove a skill from the list
const removeSkill = (index) => {
    selectedSkills.value.splice(index, 1);
};

// Function to add a new skill to the backend and update the skills list
const addNewSkill = async () => {
    console.log("Adding new skill:", selectedSkill.value);

    // Store the selected skill name before clearing it
    const newSkillName = selectedSkill.value;

    try {
        // Send the new skill to the backend
        const response = await axios.post("/profile/edit/add-skill", {
            name: newSkillName,
        });

        // Clear input after adding
        selectedSkill.value = "";

        console.log("New skill added successfully:", response.data);

        // Manually add the new skill to the skills list (assuming the response contains the newly added skill)
        const newSkill = {
            id: props.skills.length + 1, // Assuming the response contains the new skill's ID
            name: newSkillName, // Use the stored skill name here
        };

        console.log("New skill object:", newSkill);

        // Add the new skill to the local skills list
        skills.value.push(newSkill);

        // Add the new skill to selectedSkills (to ensure it's selected)
        selectedSkills.value.push(newSkill.id);

        // Update filtered skills (for the suggestions list)
        filteredSkills.value = skills.value.map((skill) => skill.name);
    } catch (error) {
        console.error("Error adding new skill:", error);
    }
};

// Save function to handle sending the selected skills to the server
const save = async () => {
    console.log("Saving skills:", selectedSkills.value);

    try {
        const response = await axios.post(
            `/profile/edit/skills/${props.user.id}`, // Ensure props.user.id is the correct user ID
            {
                skills: selectedSkills.value, // Pass the selected skill IDs to the request
            }
        );
        console.log("Skills saved successfully:", selectedSkills.value);
    } catch (error) {
        console.error("Error saving skills:", error);
    }
};

// Function to clear input and selected skills
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
                        v-for="(skillId, index) in selectedSkills"
                        :key="index"
                        class="bg-gray-100 px-2 py-1 rounded-full text-sm flex gap-x-2 items-center"
                    >
                        <span class="font-semibold">
                            {{
                                skills.find((skill) => skill.id === skillId)
                                    ?.name
                            }}
                            <!-- Display skill name -->
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
                        field="name"
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
