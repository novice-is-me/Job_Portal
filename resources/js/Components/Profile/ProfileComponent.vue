<script setup>
import { useForm } from "@inertiajs/vue3";
import { Avatar, ProgressBar, InputText, Button } from "primevue";
import { ref } from "vue";

const props = defineProps({
    user: Object,
});

const isEdit = ref(false);
const user = ref(props.user);
console.log(user.value);

const toggleEditProfile = () => {
    isEdit.value = !isEdit.value;
};

const form = useForm({
    name: props.user.name || "",
    title: props.user.headline || "",
    location: props.user.address || "",
});

const updateProfile = () => {
    console.log("Updating profile...");
};
</script>

<template>
    <div class="bg-white p-6 rounded-lg space-y-4">
        <div class="flex justify-between items-center">
            <h1 class="font-[Poppins] font-semibold text-2xl">Profile</h1>
            <i
                @click="toggleEditProfile"
                class="pi pi-pen-to-square hover:cursor-pointer"
            ></i>
        </div>
        <div v-if="isEdit">
            <div class="flex flex-col justify-center items-center gap-y-4">
                <Avatar size="xlarge" shape="circle" icon="pi pi-user" />
                <div class="flex flex-col gap-y-3 items-start w-full">
                    <div class="flex flex-col gap-y-1 w-full">
                        <label for="full_name" class="font-medium"
                            >Full Name</label
                        >
                        <InputText v-model="form.name" />
                    </div>
                    <div class="flex flex-col gap-y-1 w-full">
                        <label for="professional_title" class="font-medium"
                            >Professional Title</label
                        >
                        <InputText v-model="form.title" />
                    </div>
                    <div class="flex flex-col gap-y-1 w-full">
                        <label for="location" class="font-medium"
                            >Location</label
                        >
                        <InputText v-model="form.location" />
                    </div>

                    <div class="flex justify-end gap-x-4 w-full">
                        <Button @click="toggleEditProfile">Cancel</Button>
                        <Button @click="updateProfile">Save</Button>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="!isEdit">
            <div
                class="flex flex-col justify-center items-center gap-y-4 border-b border-gray-200 pb-4"
            >
                <Avatar size="xlarge" shape="circle" icon="pi pi-user" />
                <div class="text-center space-y-2">
                    <p class="font-semibold text-xl font-[Poppins]">
                        {{ user.name }}
                    </p>
                    <p class="text-sm">{{ user.headline || "" }}</p>
                    <div class="flex items-center gap-x-2 text-sm">
                        <i class="pi pi-map-marker"></i>
                        <p>{{ user.address || "" }}</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-y-2 pb-2 pt-4">
                <div class="flex justify-between items-center">
                    <p>Profile Completion</p>
                    <p class="font-semibold">85%</p>
                </div>
                <ProgressBar class="text-sm" style="height: 15px" :value="85" />
            </div>
        </div>
    </div>
</template>
