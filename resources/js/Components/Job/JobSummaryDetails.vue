<script setup>
import { Button } from "primevue";
</script>

<template>
    <div class="bg-white p-4 rounded-lg space-y-6 flex flex-col">
        <h1 class="font-[Poppins] text-lg font-semibold">Job Summary</h1>
        <div class="space-y-6 border-b border-gray-200 pb-4">
            <div class="flex justify-between items-center gap-x-4">
                <div class="flex items-center gap-x-2">
                    <i class="pi pi-dollar"></i>
                    <p>Salary</p>
                </div>
                <p class="font-semibold">$90,000 - $120,000</p>
            </div>
            <div class="flex justify-between items-center gap-x-4">
                <div class="flex items-center gap-x-2">
                    <i class="pi pi-briefcase"></i>
                    <p>Job Type</p>
                </div>
                <p class="font-semibold">Full Time</p>
            </div>
            <div class="flex justify-between items-center gap-x-4">
                <div class="flex items-center gap-x-2">
                    <i class="pi pi-map-marker"></i>
                    <p>Location</p>
                </div>
                <p class="font-semibold">Remote</p>
            </div>
            <div class="flex justify-between items-center gap-x-4">
                <div class="flex items-center gap-x-2">
                    <i class="pi pi-graduation-cap"></i>
                    <p>Experience</p>
                </div>
                <p class="font-semibold">5+ years</p>
            </div>
        </div>
        <Button>Apply Now</Button>
    </div>
</template>
