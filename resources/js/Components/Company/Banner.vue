<script setup>
import { InputText, Button } from "primevue";
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
                    type="email"
                    placeholder="Enter your email address"
                    class="w-full"
                />
                <Button>Subscribe</Button>
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
