<script setup>
import { useForm } from "@inertiajs/vue3";
import { InputText, Button } from "primevue";

const form = useForm({
    personal_website: "",
    linkedin: "",
    github: "",
    portfolio: "",
});
</script>

<template>
    <div class="bg-white rounded-lg p-5 space-y-4">
        <div class="space-y-6">
            <div>
                <h1 class="font-[Poppins] font-semibold text-2xl">
                    Social Links
                </h1>
                <p class="text-sm text-secondary">
                    Add links to your portfolio and social profiles
                </p>
            </div>
        </div>
        <div class="space-y-6">
            <div class="space-y-2">
                <label for="personal_website">Personal Website</label>
                <div class="flex gap-x-2 items-center">
                    <i class="pi pi-globe"></i>
                    <InputText class="w-full" />
                </div>
            </div>
            <div class="space-y-2">
                <label for="linkedin">Linked In</label>
                <div class="flex gap-x-2 items-center">
                    <i class="pi pi-linkedin"></i>
                    <InputText class="w-full" v-model="form.linkedin" />
                </div>
            </div>
            <div class="space-y-2">
                <label for="github">Github</label>
                <div class="flex gap-x-2 items-center">
                    <i class="pi pi-github"></i>
                    <InputText class="w-full" v-model="form.github" />
                </div>
            </div>
            <div class="space-y-2">
                <label for="github">Portfolio</label>
                <div class="flex gap-x-2 items-center">
                    <i class="pi pi-github"></i>
                    <InputText class="w-full" v-model="form.portfolio" />
                </div>
                <p class="text-secondary text-sm">
                    Add a link to your online portfolio or a specific project
                    you'd like to showcase
                </p>
            </div>
        </div>
        <div class="flex gap-x-4 justify-end">
            <Button>Cancel</Button>
            <Button>Save</Button>
        </div>
    </div>
</template>
