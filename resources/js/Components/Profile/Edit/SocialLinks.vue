<script setup>
import { useForm } from "@inertiajs/vue3";
import { InputText, Button, useToast } from "primevue";
import { ref } from "vue";

const props = defineProps({
    user: Object,
});

const user = ref(props.user);
const toast = useToast();

const form = useForm({
    personal_website: user.value.website || "",
    linkedin: user.value.linkedin || "",
    github: user.value.github || "",
    portfolio: user.value.portfolio || "",
});

const save = () => {
    form.post(route("profile.updateSocial"), {
        preserveScroll: false,
        onSuccess: (res) => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Links Updated Successfully",
                life: 3000,
            });
        },
        onError: (errors) => {
            console.error("Form submission failed", errors);
        },
    });
};
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
                    <InputText class="w-full" v-model="form.personal_website" />
                </div>
                <a
                    :href="user.website"
                    target="_blank"
                    class="text-header pl-2"
                    >{{ user.website || "" }}</a
                >
            </div>
            <div class="space-y-2">
                <label for="linkedin">Linked In</label>
                <div class="flex gap-x-2 items-center">
                    <i class="pi pi-linkedin"></i>
                    <InputText class="w-full" v-model="form.linkedin" />
                </div>
                <a
                    :href="user.linkedin"
                    target="_blank"
                    class="text-header pl-2"
                    >{{ user.linkedin || "" }}</a
                >
            </div>
            <div class="space-y-2">
                <label for="github">Github</label>
                <div class="flex gap-x-2 items-center">
                    <i class="pi pi-github"></i>
                    <InputText class="w-full" v-model="form.github" />
                </div>
                <a
                    :href="user.github"
                    target="_blank"
                    class="text-header pl-2"
                    >{{ user.github || "" }}</a
                >
            </div>
            <div class="space-y-2">
                <label for="github">Portfolio</label>
                <div class="flex gap-x-2 items-center">
                    <i class="pi pi-github"></i>
                    <InputText class="w-full" v-model="form.portfolio" />
                </div>
                <a
                    :href="user.portfolio"
                    target="_blank"
                    class="text-header pl-2"
                    >{{ user.portfolio || "" }}</a
                >
                <p v-if="!user.portfolio" class="text-secondary text-sm">
                    Add a link to your online portfolio or a specific project
                    you'd like to showcase
                </p>
            </div>
        </div>
        <div class="flex gap-x-4 justify-end">
            <Button>Cancel</Button>
            <Button
                @click="save"
                :disabled="
                    !form.personal_website &&
                    !form.linkedin &&
                    !form.github &&
                    !form.portfolio
                "
                >Save</Button
            >
        </div>
    </div>
</template>
