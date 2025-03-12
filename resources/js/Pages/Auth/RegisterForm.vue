<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Button, RadioButton } from "primevue";
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
            <p class="pt-4">
                Create an account to start your job search journey
            </p>
            <div class="flex flex-wrap gap-4">
                <div class="flex-1 flex flex-col gap-1">
                    <label class="font-semibold" for="email">First Name</label>
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        label="Email"
                        required
                    />
                </div>
                <div class="flex-1 flex flex-col gap-1">
                    <label class="font-semibold" for="email">Last Name</label>
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        label="Email"
                        required
                    />
                </div>
            </div>
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
                <label class="font-semibold" for="password">Password</label>

                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    label="Password"
                    required
                />
            </div>
            <div class="">
                <p>I am a</p>
                <div class="flex gap-4 mt-2">
                    <div
                        class="flex gap-x-2 w-full border border-blue-500 p-2 rounded-md"
                    >
                        <RadioButton
                            id="job_seeker"
                            v-model="form.remember"
                            label="Job Seeker"
                            value="job_seeker"
                        />
                        <label for="job_seeker" class="font-semibold"
                            >Job Seeker</label
                        >
                    </div>
                    <div
                        class="flex gap-x-2 w-full border border-blue-500 p-2 rounded-md"
                    >
                        <RadioButton
                            id="recruiter"
                            v-model="form.remember"
                            label="Remember me"
                            value="recruiter"
                        />
                        <label for="recruiter" class="font-semibold"
                            >Recruiter</label
                        >
                    </div>
                </div>
                <div class="flex items-center gap-x-2 mt-4">
                    <Checkbox
                        id="terms_policy"
                        v-model:checked="form.remember"
                        label="Terms and Policy"
                    />
                    <label for="terms_policy"
                        >I agree to the terms of service and privacy
                        policy</label
                    >
                </div>
            </div>
            <Button
                class="w-full bg-primary rounded-md text-white py-2"
                type="submit"
            >
                Create Account
            </Button>
        </form>
        <!-- Oauth login -->
        <div class="mt-4">
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
