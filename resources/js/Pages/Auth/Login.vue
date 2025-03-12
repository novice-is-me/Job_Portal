<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Button } from "primevue";
import { ref } from "vue";
import LoginForm from "./LoginForm.vue";
import RegisterForm from "./RegisterForm.vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const isLogin = ref(true);
const isRegister = ref(false);

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

const googleLogin = () => {
    console.log("Google login");
};

const facebookLogin = () => {
    console.log("Facebook login");
};

const toggleLoginView = () => {
    isLogin.value = true;
    isRegister.value = false;
};

const toggleRegisterView = () => {
    isLogin.value = false;
    isRegister.value = true;
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />
        <div class="grid grid-cols-1 h-screen md:grid-cols-2">
            <!-- Left Side (Image & Text) -->
            <div class="flex flex-col justify-center p-20 bg-gray-100">
                <img
                    src="/images/background.jpg"
                    class="w-full object-cover"
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
            <div class="flex flex-col bg-white shadow-lg p-6 overflow-auto">
                <!-- Fix: Ensure icon and text are in a row -->
                <div class="flex items-center gap-2">
                    <i
                        class="pi pi-briefcase text-header"
                        style="font-size: 1.5rem"
                    ></i>
                    <h2 class="text-2xl font-bold">JobConnect</h2>
                </div>
                <div class="mt-10">
                    <!-- The tab options -->
                    <div
                        class="flex justify-evenly p-1 bg-gray-200 text-center"
                    >
                        <a
                            @click="toggleLoginView"
                            :class="[
                                'border w-full py-2 rounded-md hover:cursor-pointer',
                                isLogin ? 'bg-white' : 'bg-transparent',
                            ]"
                            >Login</a
                        >
                        <a
                            @click="toggleRegisterView"
                            :class="[
                                'border w-full py-2 rounded-md hover:cursor-pointer',
                                isRegister ? 'bg-white' : 'bg-transparent',
                            ]"
                            >Register</a
                        >
                    </div>
                    <!-- Rendered data -->
                    <div v-if="isLogin">
                        <LoginForm />
                    </div>
                    <div v-if="isRegister">
                        <RegisterForm />
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
