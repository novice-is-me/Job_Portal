<script setup>
import { ref } from "vue";
import FileComponent from "../FileComponent.vue";

const props = defineProps({
    user: Object,
});

const user = ref(props.user);
const resumeFile = ref(
    props.user.resume ? props.user.resume.split("/").pop() : null
); // Extract the file name from the URL if it exists

const coverLetterFile = ref(
    props.user.cover_letter ? props.user.cover_letter.split("/").pop() : null
); // Extract the file name from the URL if it exists
</script>

<template>
    <div class="space-y-6">
        <!-- Resume -->
        <div class="bg-white p-5 rounded-lg space-y-4">
            <div>
                <h1 class="text-2xl font-[Poppins] font-semibold">
                    Resume & CV
                </h1>
                <p class="text-secondary">
                    Upload and manage your resume and CV documents
                </p>
            </div>
            <div class="">
                <!-- Component -->
                <FileComponent
                    :user="user"
                    :file="resumeFile"
                    :type="'resume'"
                />
            </div>
        </div>
        <!-- Cover Letters -->
        <div class="bg-white p-5 rounded-lg space-y-4">
            <div>
                <h1 class="text-2xl font-[Poppins] font-semibold">
                    Cover Letters
                </h1>
                <p class="text-secondary">Manage your cover letter templates</p>
            </div>
            <div class="">
                <!-- Component -->
                <FileComponent
                    :file="coverLetterFile"
                    :user="user"
                    :type="'coverLetter'"
                />
            </div>
        </div>
    </div>
</template>
