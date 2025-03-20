<script setup>
import { Button } from "primevue";
</script>

<template>
    <div class="space-y-6">
        <div
            class="bg-[#f8fafc] rounded-lg p-5 flex justify-between items-center"
        >
            <div class="flex gap-x-2 items-center">
                <i
                    class="pi pi-file border bg-blue-50 p-2 rounded-lg text-blue-500"
                    style="font-size: 1.7rem"
                ></i>
                <div>
                    <p>Emily_Johnson_Resume.pdf</p>
                    <p>Uploaded on May 15, 2023 • 2.4 MB</p>
                </div>
            </div>
            <div class="flex gap-x-6">
                <a href="">
                    <i class="pi pi-eye"></i>
                </a>
                <a href="">
                    <i class="pi pi-download"></i>
                </a>
                <a href="">
                    <i class="pi pi-trash"></i>
                </a>
            </div>
        </div>
        <div class="flex justify-end">
            <Button>
                <i class="pi pi-upload"></i>
                Upload new resume
            </Button>
        </div>
    </div>
</template>
