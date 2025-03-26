<script setup>
import { ref } from "vue";
import WorkComponent from "./WorkComponent.vue";
import { Button } from "primevue";
import { useForm } from "@inertiajs/vue3";

// Store it as an array
const workNumber = ref([{ id: 1 }]);

// Save all work experiences (example)
const saveWorkExperiences = () => {
    console.log("Saved Work Experiences:", form);

    form.post(route("profile.updateWorkExp"), {
        preserveScroll: false,
        onSucess: (res) => {
            console.log("Success");
            console.log(workExperiences.value);
        },
    });
};

const removeWork = (index) => {
    return workNumber.value.splice(index, 1);
};

const addWork = () => {
    return workNumber.value.push({ id: Date.now() });
};

const form = useForm({
    id: "",
    job_title: "",
    company: "",
    location: "",
    start_date: "",
    end_date: "",
});
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
                <div v-for="(work, index) in workNumber" :key="work.id">
                    <WorkComponent :index="index" :form="form" />

                    <!-- Remove Button -->
                    <button
                        @click="removeWork(index)"
                        class="text-red-500 mt-2"
                    >
                        Remove Work
                    </button>
                </div>

                <div class="flex justify-end gap-x-4 mt-4">
                    <Button>Cancel</Button>
                    <Button @click="saveWorkExperiences">Save</Button>
                </div>
            </div>
        </div>
    </div>
</template>
