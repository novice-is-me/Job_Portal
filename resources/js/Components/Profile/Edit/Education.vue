<script setup>
import { useForm } from "@inertiajs/vue3";
import EducationComponent from "./EducationComponent.vue";
import { Button } from "primevue";
import { ref } from "vue";

const props = defineProps({
    user: Object,
});

const addEducation = () => {
    form.educations.push({
        id: Date.now(),
        school: "",
        degree: "",
        address: "",
        start_date: "",
        end_date: "",
    });
};
const removeEducation = (index) => {
    form.educations = form.educations.filter((educ, i) => i !== index);
};

// add a form
const form = useForm({
    // If the user has educations, bind them in fields, otherwise create a new one
    educations: props.user?.educations?.length
        ? [...props.user.educations] // This is for two way binding
        : [
              {
                  id: Date.now(),
                  school: "",
                  degree: "",
                  address: "",
                  start_date: "",
                  end_date: "",
              },
          ],
});

const saveEducations = () => {
    form.post(route("profile.updateEducation"), {
        preserveScroll: false,
        onSuccess: (res) => {
            console.log("Success");
        },
    });
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
            <div v-for="(form, index) in form.educations" :key="index">
                <EducationComponent
                    :form="form"
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
            <Button @click="saveEducations">Save</Button>
        </div>
    </div>
</template>
