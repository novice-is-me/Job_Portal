<script setup>
import { ref } from "vue";

const props = defineProps({
    user: Object,
});

const user = ref(props.user);
</script>

<template>
    <div class="bg-white p-6 rounded-lg space-y-4">
        <div class="flex justify-between items-center">
            <h1 class="font-[Poppins] font-semibold text-xl">
                Contact Information
            </h1>
        </div>
        <div class="space-y-3">
            <div class="flex gap-x-4 items-center">
                <i class="pi pi-envelope"></i>
                <div>
                    <p>Email</p>
                    <p>{{ user.email || "" }}</p>
                </div>
            </div>
            <div class="flex gap-x-4 items-center">
                <i class="pi pi-phone"></i>
                <div>
                    <p>Phone</p>
                    <p>{{ user.phone || "" }}</p>
                </div>
            </div>
            <div class="flex gap-x-4 items-center">
                <i class="pi pi-map-marker"></i>
                <div>
                    <p>Address</p>
                    <p>{{ user.address }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
