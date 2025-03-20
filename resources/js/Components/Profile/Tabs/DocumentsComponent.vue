<script setup>
import { Button } from "primevue";
import FileComponent from "../FileComponent.vue";
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
                <FileComponent />
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
                <FileComponent />
            </div>
        </div>
        <!-- Portfolio & Additional Documents -->
        <div class="bg-white p-5 rounded-lg space-y-4">
            <div>
                <h1 class="text-2xl font-[Poppins] font-semibold">
                    Portfolio & Additional Documents
                </h1>
                <p class="text-secondary">
                    Upload portfolio samples and other supporting documentss
                </p>
            </div>
            <div class="">
                <!-- Component -->
                <FileComponent />
            </div>
        </div>
    </div>
</template>
