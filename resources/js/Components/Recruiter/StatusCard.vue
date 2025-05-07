<script setup>
import { ref } from "vue";

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    count: {
        type: Number,
        required: true,
    },
    icon: {
        type: String,
    },
    color: {
        type: String,
    },
    text: {
        type: String,
    },
});
</script>

<template>
    <div
        class="flex items-center justify-between p-4 bg-white shadow-md rounded-lg mb-4"
    >
        <div>
            <p class="font-semibold text-lg">{{ title }}</p>
            <p>{{ count }}</p>
        </div>
        <i :class="[icon, color, 'p-2 rounded-lg', text]"></i>
    </div>
</template>
