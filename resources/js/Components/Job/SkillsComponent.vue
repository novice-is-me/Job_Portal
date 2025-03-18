<script setup>
import { data } from "autoprefixer";

const props = defineProps({
    skill: String,
});
</script>

<template>
    <div
        class="bg-gray-100 py-1 px-3 text-center flex items-center rounded-full"
    >
        <p class="text-sm font-semibold">{{ skill }}</p>
    </div>
</template>
