<script setup>
import { InputText } from "primevue";

const props = defineProps({
    index: Number,
    form: Object,
});

const emit = defineEmits(["removeEducation"]);
</script>

<template>
    <div class="pb-4 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <p class="font-semibold">Education {{ index }}</p>
            <i
                @click="$emit('removeEducation')"
                class="pi pi-trash text-red-500"
            ></i>
        </div>
        <div class="flex flex-col space-y-2 mt-2">
            <label for="degree">Degree</label>
            <InputText id="degree" v-model="degree" />
        </div>
        <div class="grid grid-cols-2 gap-y-3 gap-x-4">
            <div class="flex flex-col space-y-2 mt-2">
                <label for="school">School</label>
                <InputText id="school" v-model="school" />
            </div>
            <div class="flex flex-col space-y-2 mt-2">
                <label for="location">Location</label>
                <InputText id="location" v-model="start_date" />
            </div>
            <div class="flex flex-col space-y-2 mt-2">
                <label for="start_year">Start Year</label>
                <InputText id="start_year" v-model="start_date" />
            </div>
            <div class="flex flex-col space-y-2 mt-2">
                <label for="end_year">End Year (or expected)</label>
                <InputText id="end_year" v-model="end_date" />
            </div>
        </div>
    </div>
</template>
