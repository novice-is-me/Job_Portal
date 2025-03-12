<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Button, RadioButton } from "primevue";
import { ref, watch } from "vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    name: "",
    email: "",
    password: "",
    user_type: "",
    // remember: false,
});

const acceptTerms = ref(false);
const acceptTermsError = ref("");

const register = () => {
    if (!acceptTerms.value) {
        acceptTermsError.value = true; // Show error only if unchecked
    } else {
        acceptTermsError.value = false; // Remove error if checked
        form.post(route("register"), {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();
                acceptTerms.value = false; // Reset checkbox
            },
            onError: (errors) => {
                console.log(errors);
            },
        });
    }
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
        <form @submit.prevent="register" class="flex flex-col gap-4">
            <p class="pt-4">
                Create an account to start your job search journey
            </p>
            <div class="flex flex-col gap-1">
                <label class="font-semibold" for="email">Name</label>
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    label="name"
                />
                <InputError :message="form.errors.name" />
            </div>
            <div class="flex flex-col gap-1">
                <label class="font-semibold" for="email">Email</label>
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    label="Email"
                />
                <InputError :message="form.errors.email" />
            </div>
            <div class="flex flex-col gap-1">
                <label class="font-semibold" for="password">Password</label>
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    label="Password"
                />
                <InputError :message="form.errors.password" />
            </div>
            <div class="">
                <p>I am a</p>
                <div class="flex gap-4 mt-2">
                    <div
                        class="flex gap-x-2 w-full border border-blue-500 p-2 rounded-md"
                    >
                        <RadioButton
                            id="user_type"
                            v-model="form.user_type"
                            label="Job Seeker"
                            value="1"
                        />
                        <label for="job_seeker" class="font-semibold"
                            >Job Seeker</label
                        >
                    </div>
                    <div
                        class="flex gap-x-2 w-full border border-blue-500 p-2 rounded-md"
                    >
                        <RadioButton
                            id="user_type"
                            v-model="form.user_type"
                            label="Remember me"
                            value="2"
                        />
                        <label for="recruiter" class="font-semibold"
                            >Recruiter</label
                        >
                    </div>
                </div>
                <InputError :message="form.errors.user_type" />
            </div>
            <div class="flex items-center gap-x-2">
                <Checkbox
                    id="terms_policy"
                    v-model:checked="acceptTerms"
                    label="Terms and Policy"
                />
                <label
                    for="terms_policy"
                    :class="[acceptTermsError ? 'text-red-500' : 'text-black']"
                    >I agree to the terms of service and privacy policy</label
                >
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
