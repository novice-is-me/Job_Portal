<script setup>
import { ref } from "vue";

const props = defineProps({
    education: Object,
});

const education = ref(props.education);
</script>
<template>
    <div class="bg-white rounded-lg space-y-4">
        <h1 class="font-[Poppins] text-xl font-semibold">Education</h1>
        <div class="flex gap-x-3 items-start">
            <i
                class="pi pi-graduation-cap border p-2 rounded-lg bg-blue-100 text-blue-700"
                style="font-size: 1.25em"
            ></i>
            <div>
                <p class="text-lg font-semibold">
                    {{ education.degree || "" }}
                </p>
                <p class="text-blue-700">{{ education.school || "" }}</p>
                <p>{{ education.start_date }} - {{ education.end_date }}</p>
            </div>
        </div>
    </div>
</template>
