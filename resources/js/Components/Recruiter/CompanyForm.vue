<script setup>
import { InputText } from "primevue";

const props = defineProps({
    form: Object,
    value: String,
});

console.log(props.form);
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
        <InputText
            v-model="form.name"
            :placeholder="value === 'value' ? 'Value title' : 'Benefit Title'"
        />
        <InputText
            v-model="form.description"
            :placeholder="
                value === 'value' ? 'Value description' : 'Benefit Description'
            "
        />
    </div>
</template>
