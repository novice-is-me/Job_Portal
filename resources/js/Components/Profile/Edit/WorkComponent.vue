<script setup>
import { defineProps, defineEmits, ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import { DatePicker, InputText, ToggleSwitch } from "primevue";

// Props & Emit
const props = defineProps(["workData"]);
const emit = defineEmits(["updateWork", "removeWork"]);

// Form state
const checked = ref(props.workData.end_date === "");

// Initialize form with existing data
const form = useForm({ ...props.workData });

// Watch for changes and emit updates
watch(
    form,
    () => {
        emit("updateWork", { ...form });
    },
    { deep: true }
);

// Watch checked toggle and clear end_date when "Currently working" is enabled
watch(checked, (newValue) => {
    if (newValue) {
        form.end_date = "";
    }
});
</script>

<template>
    <div class="space-y-4 pb-4 border-b border-gray-200">
        <div class="grid grid-cols-2 gap-y-3 gap-x-4">
            <div class="flex flex-col space-y-2">
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

        <!-- Remove Button -->
        <button @click="$emit('removeWork')" class="text-red-500 mt-2">
            Remove Work
        </button>
    </div>
</template>
