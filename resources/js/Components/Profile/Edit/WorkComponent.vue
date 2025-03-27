<script setup>
import { defineProps, defineEmits, ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import { DatePicker, InputText, ToggleSwitch } from "primevue";

// Define emits is for events
const emit = defineEmits(["removeWork"]);

const props = defineProps({
    index: Number,
    form: Object,
});

const checked = ref(true);
</script>

<template>
    <div class="space-y-4 pb-4 border-b border-gray-200">
        <div class="grid grid-cols-2 gap-y-3 gap-x-4">
            <div class="flex flex-col space-y-2 mt-2">
                <label for="job_title">Job Title</label>
                <InputText id="job_title" v-model="form.job_title" />
            </div>
            <div class="flex flex-col space-y-2">
                <label for="company">Company</label>
                <InputText id="company" v-model="form.company" />
            </div>
            <div class="flex flex-col space-y-2">
                <label for="location">Location</label>
                <InputText id="location" v-model="form.location" />
            </div>
        </div>

        <div class="flex items-center gap-x-4">
            <ToggleSwitch v-model="checked" />
            <p>I currently work here</p>
        </div>

        <div class="grid grid-cols-2 gap-y-3 gap-x-4">
            <div class="flex flex-col space-y-2 w-full">
                <label for="start_date">Start Date</label>
                <DatePicker id="start_date" v-model="form.start_date" />
            </div>
            <div v-if="!checked" class="flex flex-col space-y-2">
                <label for="end_date">End Date</label>
                <DatePicker id="end_date" v-model="form.end_date" />
            </div>
        </div>
    </div>
</template>
