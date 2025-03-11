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
            <div class="flex flex-col justify-center bg-white shadow-lg p-6">
                <!-- Fix: Ensure icon and text are in a row -->
                <div class="flex items-center gap-2">
                    <i
                        class="pi pi-briefcase text-header"
                        style="font-size: 1.5rem"
                    ></i>
                    <h2 class="text-2xl font-bold">JobConnect</h2>
                </div>
                <div class="border border-green-300 mt-10">
                    <!-- The tab options -->
                    <div class="flex justify-evenly p-1 bg-gray-200">
                        <Button
                            class="border border-red-400 w-full py-2 rounded-none"
                            >Login</Button
                        >
                        <Button class="border border-yellow-400 w-full"
                            >Register</Button
                        >
                    </div>
                    <!-- Rendered data -->
                    <div v-if="isLogin">
                        <form
                            @submit.prevent="submit"
                            class="flex flex-col gap-4"
                        >
                            <p class="pt-4">
                                Enter your credentials to access your account
                            </p>
                            <div class="flex flex-col gap-1">
                                <label class="font-semibold" for="email"
                                    >Email</label
                                >
                                <TextInput
                                    v-model="form.email"
                                    type="email"
                                    label="Email"
                                    required
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <div class="flex justify-between">
                                    <label class="font-semibold" for="password"
                                        >Password</label
                                    >
                                    <p class="font-semibold text-blue-500">
                                        Forgot Password
                                    </p>
                                </div>
                                <TextInput
                                    v-model="form.password"
                                    type="password"
                                    label="Password"
                                    required
                                />
                            </div>
                            <div class="flex items-center gap-2">
                                <Checkbox
                                    v-model:checked="form.remember"
                                    label="Remember me"
                                />
                                <label for="remember_me" class="font-semibold"
                                    >Remember me</label
                                >
                            </div>
                            <Button
                                class="w-full bg-primary rounded-md text-white py-2"
                                type="submit"
                            >
                                Log in
                            </Button>
                        </form>
                        <!-- Oauth login -->
                        <div class="mt-8">
                            <div
                                class="flex items-center justify-center gap-4 pt-4"
                            >
                                <div
                                    class="border-2 w-full border-gray-200"
                                ></div>
                                <p class="uppercase whitespace-nowrap">
                                    Or continue with
                                </p>
                                <div
                                    class="border-2 w-full border-gray-200"
                                ></div>
                            </div>
                            <!-- Google -->
                            <div
                                class="flex justify-evenly gap-4 py-4 hover:cursor-pointer"
                                @click="googleLogin"
                            >
                                <div
                                    class="flex justify-center gap-4 border border-gray-200 py-3 px-6 rounded-md"
                                >
                                    <img
                                        src="../../../../public/images/google.png"
                                        alt=""
                                        class="w-6 h-6"
                                    />
                                    <p>Google</p>
                                </div>
                                <!-- Facebook? -->
                                <div
                                    class="flex justify-center gap-4 border border-gray-200 py-3 px-6 rounded-md hover:cursor-pointer"
                                    @click="facebookLogin"
                                >
                                    <img
                                        src="../../../../public/images/facebook.png"
                                        alt=""
                                        class="w-6 h-6"
                                    />
                                    <p>Facebook</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
