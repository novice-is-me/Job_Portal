<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Tabs, TabList, Tab, TabPanel, TabPanels } from "primevue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};

import { ref } from "vue";

const tabs = ref([
    { title: "Tab 1", content: "Tab 1 Content", value: "0" },
    { title: "Tab 2", content: "Tab 2 Content", value: "1" },
    { title: "Tab 3", content: "Tab 3 Content", value: "2" },
]);
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />
        <div class="grid grid-cols-1 h-screen md:grid-cols-2">
            <!-- Left Side (Image & Text) -->
            <div
                class="flex flex-col items-center justify-center p-20 bg-gray-100"
            >
                <img
                    src="/images/background.jpg"
                    class="w-full h-full object-cover"
                    alt="Background Image"
                />
                <div class="text-center flex flex-col mt-4 gap-y-3">
                    <h1 class="text-3xl font-bold text-header">
                        JobConnect Portal
                    </h1>
                    <p class="text-lg">
                        Find your dream job or the perfect candidate
                    </p>
                </div>
            </div>

            <!-- Right Side (Login Form) -->
            <div class="flex flex-col bg-white shadow-lg p-6">
                <!-- Fix: Ensure icon and text are in a row -->
                <div class="flex items-center gap-2">
                    <i
                        class="pi pi-briefcase text-header"
                        style="font-size: 1.5rem"
                    ></i>
                    <h2 class="text-2xl font-bold">JobConnect</h2>
                </div>
                <div>
                    <div class="card">
                        <Tabs value="0">
                            <TabList>
                                <Tab
                                    v-for="tab in tabs"
                                    :key="tab.title"
                                    :value="tab.value"
                                    >{{ tab.title }}</Tab
                                >
                            </TabList>
                            <TabPanels>
                                <TabPanel
                                    v-for="tab in tabs"
                                    :key="tab.content"
                                    :value="tab.value"
                                >
                                    <p class="m-0">{{ tab.content }}</p>
                                </TabPanel>
                            </TabPanels>
                        </Tabs>
                    </div>
                    <!-- Your login form goes here -->
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
