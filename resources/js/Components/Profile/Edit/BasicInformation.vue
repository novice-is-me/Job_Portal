<script setup>
import InputError from "@/Components/InputError.vue";
import { useForm } from "@inertiajs/vue3";
import { Textarea, InputText, Button, useToast } from "primevue";
import { ref } from "vue";

const prop = defineProps({
    user: Object,
});

const user = prop.user;
const toast = useToast();
const fileInput = ref(null);
const selectedFile = ref(null);
const previewUrl = ref(null);
console.log(user);

const form = useForm({
    full_name: user.name || "",
    profession: user.headline || "",
    location: user.address || "",
    summary: user.introduction || "",
    age: user.age || "",
    phone: user.phone || "",
    email: user.email || "",
    profile_icon: user.profile_icon || null,
});

console.log(fileInput.value);
const uploadProfileIcon = () => {
    fileInput.value.click();
};

const handleFileChange = (e) => {
    const file = e.target.files[0];

    if (file) {
        selectedFile.value = file;
        previewUrl.value = URL.createObjectURL(file);
        form.profile_icon = file;
    }
};

const cancel = () => {
    form.reset();
};

const submit = () => {
    form.post(route("profile.updateBasicInformation"), {
        preserveScroll: false,
        onSuccess: (res) => {
            console.log("Profile updated successfully");
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Profile Update Succesfully",
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
                    <div
                        class="bg-gray-400 rounded-full overflow-hidden w-24 h-24"
                    >
                        <img
                            :src="
                                previewUrl ? previewUrl : user.profile_picture
                            "
                            alt=""
                        />
                    </div>
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
                    <div>
                        <input
                            type="file"
                            accept="image/*"
                            class="hidden"
                            ref="fileInput"
                            @change="(e) => handleFileChange(e)"
                        />
                        <label
                            class="border border-gray-200 mt-2 inline-block px-3 py-1 rounded-md font-medium hover:cursor-pointer hover:bg-gray-200"
                            @click="uploadProfileIcon"
                            >Upload Image</label
                        >
                    </div>
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
                    <InputError :message="form.errors.full_name" />
                </div>
                <div class="flex flex-col gap-y-2">
                    <label for="email" class="font-medium">Email</label>
                    <InputText id="email" type="text" v-model="form.email" />
                    <InputError :message="form.errors.email" />
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
                    <InputError :message="form.errors.profession" />
                </div>
                <div class="flex flex-col gap-y-2">
                    <label for="age" class="font-medium">Age</label>
                    <InputText id="age" type="text" v-model="form.age" />
                    <InputError :message="form.errors.age" />
                </div>
                <div class="flex flex-col gap-y-2">
                    <label for="phone" class="font-medium">Phone Number</label>
                    <InputText id="phone" type="number" v-model="form.phone" />
                    <InputError :message="form.errors.phone" />
                </div>
                <div class="flex flex-col gap-y-2">
                    <label for="location" class="font-medium">Location</label>
                    <InputText
                        id="location"
                        type="text"
                        v-model="form.location"
                    />
                    <InputError :message="form.errors.location" />
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
            <Button @click="cancel">Cancel</Button>
            <Button @click="submit">Save</Button>
        </div>
    </div>
</template>
