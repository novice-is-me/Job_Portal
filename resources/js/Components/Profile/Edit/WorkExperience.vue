<script setup>
import { computed, ref, watch } from "vue";
import WorkComponent from "./WorkComponent.vue";
import { Button, useToast } from "primevue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    user: Object,
});

const toast = useToast();
// Save all work experiences (example)
const saveWorkExperiences = () => {
    console.log("Saved Work Experiences:", form.work_experiences);

    form.post(route("profile.updateWorkExp"), {
        preserveScroll: false,
        onSuccess: (res) => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Work Updated Succesfully",
                life: 3000,
            });
        },
    });
};

const form = useForm({
    work_experiences: props.user?.work_experiences?.length
        ? [...props.user.work_experiences] // Get the two way bind data
        : [
              {
                  id: Date.now(),
                  job_title: "",
                  company: "",
                  location: "",
                  start_date: "",
                  end_date: "",
                  is_current_job: false,
              },
          ],
});

console.log(form.work_experiences);

const addWork = () => {
    form.work_experiences.push({
        id: Date.now(),
        job_title: "",
        company: "",
        location: "",
        start_date: "",
        end_date: "",
        is_current_job: false,
    });
};

const removeWork = (index) => {
    form.work_experiences = form.work_experiences.filter(
        (work, i) => i !== index
    );

    toast.add({
        severity: "success",
        summary: "Success",
        detail: "Work Removed Succesfully",
        life: 3000,
    });
};

watch(
    () => props.user?.work_experiences,
    (newWorkExperiences) => {
        if (newWorkExperiences) {
            form.work_experiences = [...newWorkExperiences]; // Clone to maintain reactivity
        }
    },
    { deep: true, immediate: true }
);

const startDate = computed(() => form.work_experiences.start_date);

const formatDate = (date) => {
    if (!date) return null;
    return new Date(date).toISOString().split("T")[0]; // Format to YYYY-MM-DD
};

// Ensure dates are always formatted before submitting
watch(
    () => form.work_experiences,
    (newWorkExperiences) => {
        newWorkExperiences.forEach((work, index) => {
            if (work.start_date) {
                form.work_experiences[index].start_date = formatDate(
                    work.start_date
                );
            }
            if (work.end_date) {
                form.work_experiences[index].end_date = formatDate(
                    work.end_date
                );
            }
        });
    },
    { deep: true }
);
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
                <div
                    v-for="(work, index) in form.work_experiences"
                    :key="work.id"
                    class="border-b border-gray-200 mb-4 pb-2"
                >
                    <WorkComponent :index="index" :form="work" />

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
