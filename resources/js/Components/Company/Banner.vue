<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import axios from "axios";
import { InputText, Button, useToast } from "primevue";

const page = usePage();
const userId = page.props.auth.user.id;
const toast = useToast();

const form = useForm({
    email: "",
});

const subscribe = async () => {
    if (!form.email) {
        toast.add({
            severity: "error",
            summary: "Error",
            detail: "Email is required",
            life: 3000,
        });
    }

    if (!form.email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
        toast.add({
            severity: "error",
            summary: "Error",
            detail: "Email is not valid",
            life: 3000,
        });
        return;
    }

    form.post(route("email.subscribe", userId), {
        onSuccess: () => {
            form.reset();
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "You have successfully subscribed to our newsletter",
                life: 3000,
            });
        },
        onError: (errors) => {
            console.log(errors);
        },
    });
};
</script>

<template>
    <div
        class="border border-blue-300 bg-blue-100 px-5 py-10 rounded-md flex items-center"
    >
        <div class="space-y-4">
            <div class="space-y-2">
                <h1 class="text-2xl font-[Poppins] font-bold">
                    Stay Updated on Top Companies
                </h1>
                <p class="text-secondary">
                    Get weekly updates on new companies, job openings, and
                    industry insights delivered straight to your inbox.
                </p>
            </div>
            <div class="flex gap-x-2">
                <InputText
                    v-model="form.email"
                    type="email"
                    placeholder="Enter your email address"
                    class="w-full"
                />
                <Button @click="subscribe">Subscribe</Button>
            </div>
        </div>
        <div class="hidden md:block mx-auto">
            >
            <img
                src="../../../../public/images/announcement.png"
                alt=""
                class="w-[150px] object-cover"
            />
        </div>
    </div>
</template>
