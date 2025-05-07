<script setup>
import { ref, watch } from "vue";
import { InputText, Button } from "primevue";
import CompanyForm from "./CompanyForm.vue";
import { router, useForm } from "@inertiajs/vue3";

const props = defineProps({
    company: Object,
});

const isEdit = ref(false);
console.log(isEdit.value);
const form = useForm({
    company_values: props.company.length
        ? [...props.company.values]
        : [
              {
                  id: Date.now(),
                  name: "",
                  description: "",
              },
          ],
});

const editValues = () => {
    isEdit.value = !isEdit.value;
};

const addForm = () => {
    form.company_values.push({
        id: Date.now(),
        name: "",
        description: "",
    });
};

const save = () => {
    form.post(
        route("dashboard.recruiter.submit.values", {
            company_id: props.company.id,
        }),
        {
            preserveScroll: false,
            onSuccess: (res) => {
                isEdit.value = false;
                form.company_values = res.props.company.values;
            },
        }
    );
};

watch(
    () => props.company.values,
    (newValues) => {
        if (newValues.length > 0) {
            form.company_values = [...newValues];
        }
    },
    { deep: true, immediate: true }
);
</script>

<template>
    <div class="bg-white p-4 rounded-lg space-y-4 shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <p class="font-[Poppins] font-bold text-lg">Company Values</p>
                <p>What your company stands for</p>
            </div>
            <i
                class="pi pi-pencil border p-2 rounded-md text-blue-700 bg-blue-100 hover:cursor-pointer"
                @click="editValues"
            ></i>
        </div>
        <div v-if="!isEdit">
            <div
                v-if="company.values.length > 0"
                v-for="value in form.company_values"
                :key="value.id"
            >
                <p class="font-semibold">{{ value.name }}</p>
                <ul class="list-disc list-inside text-secondary">
                    <li>{{ value.description }}</li>
                </ul>
            </div>
            <div v-else>
                <p class="font-semibold">No values added yet</p>
                <p class="text-secondary">
                    Add values to your company to attract the right candidates
                </p>
            </div>
        </div>
        <!-- Edit form -->
        <div v-else class="space-y-4">
            <Button @click="addForm">Add +</Button>
            <div
                v-for="(value, index) in form.company_values"
                :key="index"
                class="flex items-center justify-between gap-x-4"
            >
                <CompanyForm :form="value" :index="index" :value="'value'" />
                <i
                    class="pi pi-trash text-red-500 hover:cursor-pointer"
                    @click="form.company_values.splice(index, 1)"
                />
            </div>
            <Button @click="save" class="w-full">Save</Button>
        </div>
    </div>
</template>
