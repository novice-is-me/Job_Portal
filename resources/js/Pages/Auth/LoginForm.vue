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
    <div>
        <form @submit.prevent="submit" class="flex flex-col gap-4">
            <p class="pt-4">Enter your credentials to access your account</p>
            <div class="flex flex-col gap-1">
                <label class="font-semibold" for="email">Email</label>
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    label="Email"
                    required
                />
            </div>
            <div class="flex flex-col gap-1">
                <div class="flex justify-between">
                    <label class="font-semibold" for="password">Password</label>
                    <a
                        id="forgot-password"
                        href="#"
                        class="font-semibold text-blue-500"
                    >
                        Forgot Password
                    </a>
                </div>
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    label="Password"
                    required
                />
            </div>
            <div class="flex items-center gap-2">
                <Checkbox
                    id="remember_me"
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
            <div class="flex items-center justify-center gap-4 pt-4">
                <div class="border-2 w-full border-gray-200"></div>
                <p class="uppercase whitespace-nowrap">Or continue with</p>
                <div class="border-2 w-full border-gray-200"></div>
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
</template>
