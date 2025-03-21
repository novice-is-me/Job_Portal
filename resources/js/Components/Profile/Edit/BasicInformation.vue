<script setup>
import { useForm } from "@inertiajs/vue3";
import { Textarea, InputText, Button } from "primevue";

const form = useForm({
    full_name: "",
    profession: "",
    location: "",
    summary: "",
    age: "",
    phone: "",
    email: "",
});
</script>

<template>
    <div class="bg-white rounded-lg p-5 divide-y-2 divide-gray-100">
        <div class="space-y-6 pb-6">
            <div>
                <h1 class="font-[Poppins] font-semibold text-2xl">
                    Basic Information
                </h1>
                <p class="text-sm text-secondary">
                    Update your personal information
                </p>
            </div>
            <div class="flex gap-x-3">
                <div class="relative">
                    <div class="bg-gray-400 rounded-full h-24 w-24"></div>
                    <i
                        class="pi pi-camera absolute p-2 rounded-full bg-gray-100 right-[10px] bottom-0"
                    ></i>
                </div>
                <div class="">
                    <p class="font-semibold">Profile Photo</p>
                    <p class="text-secondary">
                        Upload a clear, professional photo to help employers
                        recognize you.
                    </p>
                    <a
                        class="border border-gray-200 mt-2 inline-block px-3 py-1 rounded-md font-medium hover:cursor-pointer hover:bg-gray-200"
                        >Upload a new photo</a
                    >
                </div>
            </div>
        </div>
        <!-- Edit Form -->
        <div class="pt-4">
            <div class="grid grid-cols-2 gap-4">
                <div class="flex flex-col gap-y-2">
                    <label for="full_name" class="font-medium">Full Name</label>
                    <InputText
                        id="full_name"
                        type="text"
                        v-model="form.full_name"
                    />
                </div>
                <div class="flex flex-col gap-y-2">
                    <label for="email" class="font-medium">Email</label>
                    <InputText id="email" type="text" v-model="form.email" />
                </div>
                <div class="flex flex-col gap-y-2">
                    <label for="profession" class="font-medium"
                        >Professional Headline</label
                    >
                    <InputText
                        id="profession"
                        type="text"
                        v-model="form.profession"
                    />
                </div>
                <div class="flex flex-col gap-y-2">
                    <label for="age" class="font-medium">Age</label>
                    <InputText id="age" type="text" v-model="form.age" />
                </div>
                <div class="flex flex-col gap-y-2">
                    <label for="phone" class="font-medium">Phone Number</label>
                    <InputText id="phone" type="number" v-model="form.phone" />
                </div>
                <div class="flex flex-col gap-y-2">
                    <label for="location" class="font-medium">Location</label>
                    <InputText
                        id="location"
                        type="text"
                        v-model="form.location"
                    />
                </div>
            </div>
            <div class="flex flex-col gap-y-2 mt-4">
                <label>Tell about yourself</label>
                <Textarea
                    v-model="form.summary"
                    rows="5"
                    autoResize
                    placeholder="Write a short summary about yourself"
                />
            </div>
        </div>
        <div class="mt-4 flex justify-end gap-x-4">
            <Button>Cancel</Button>
            <Button>Save All Changes</Button>
        </div>
    </div>
</template>
