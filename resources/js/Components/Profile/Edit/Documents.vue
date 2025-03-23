<script setup>
import { Button } from "primevue";
</script>

<template>
    <div class="bg-white rounded-lg p-5 space-y-4">
        <div class="space-y-6">
            <div>
                <h1 class="font-[Poppins] font-semibold text-2xl">Documents</h1>
                <p class="text-sm text-secondary">
                    Upload your resume, cover letters, and portfolio documents
                </p>
            </div>
        </div>
        <div>
            <div
                class="border border-gray-200 p-2 rounded-md flex flex-wrap gap-x-2"
            >
                <div
                    class="bg-gray-100 px-2 py-1 rounded-full text-sm flex gap-x-2 items-center"
                ></div>
            </div>
            <div>
                <input type="file" />
                <i class="pi pi-plus"></i>
            </div>
        </div>
    </div>
</template>
