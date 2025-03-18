<script setup>
import { Avatar } from "primevue";
</script>

<template>
    <div class="bg-white p-4 rounded-lg space-y-6 flex flex-col">
        <h1 class="font-[Poppins] text-lg font-semibold">Recruiter</h1>
        <div class="flex items-center gap-x-4">
            <Avatar size="large" shape="circle" icon="pi pi-user" />
            <div>
                <p class="font-semibold">Sarah Johnson</p>
                <p class="text-secondary">Talent Acquisition Manager</p>
            </div>
        </div>
        <p class="text-secondary">
            Feel free to reach out if you have any questions about this position
            or the application process.
        </p>
        <a
            href="#"
            class="border border-gray-200 px-3 py-2 rounded-md text-center"
            >Contact Recruiter</a
        >
    </div>
</template>
