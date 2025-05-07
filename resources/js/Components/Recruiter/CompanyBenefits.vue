<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import { Button } from "primevue";
import CompanyForm from "./CompanyForm.vue";

const props = defineProps({
    company: Object,
});
const isEdit = ref(false);

const form = useForm({
    company_benefits: props.company.length
        ? [...props.company.benefits]
        : [
              {
                  id: Date.now(),
                  name: "",
                  description: "",
              },
          ],
});

const editBenefits = () => {
    isEdit.value = !isEdit.value;
};

const addForm = () => {
    form.company_benefits.push({
        id: Date.now(),
        name: "",
        description: "",
    });
};

const save = () => {
    form.post(
        route("dashboard.recruiter.submit.benefits", {
            company_id: props.company.id,
        }),
        {
            preserveScroll: false,
            onSuccess: (res) => {
                isEdit.value = false;
                form.company_benefits = res.props.company.benefits;
            },
        }
    );
};

watch(
    () => props.company.benefits,
    (newValues) => {
        if (newValues.length > 0) {
            form.company_benefits = [...newValues];
        }
    },
    { deep: true, immediate: true }
);
</script>

<template>
    <div class="bg-white p-4 rounded-lg space-y-4 shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <p class="font-[Poppins] font-bold text-lg">Company Benefits</p>
                <p>Perks and benefits offered to employees</p>
            </div>
            <i
                class="pi pi-pencil border p-2 rounded-md text-blue-700 bg-blue-100 hover:cursor-pointer"
                @click="editBenefits"
            ></i>
        </div>

        <div v-if="!isEdit">
            <div
                v-if="company.benefits.length > 0"
                v-for="benefit in form.company_benefits"
                :key="benefit.id"
            >
                <p class="font-semibold">{{ benefit.name }}</p>
                <ul class="list-disc list-inside text-secondary">
                    <li>{{ benefit.description }}</li>
                </ul>
            </div>
            <div v-else class="text-center">
                <p class="font-semibold">No benefits added yet</p>
                <p class="text-secondary">
                    Add benefits to your company to attract the right candidates
                </p>
            </div>
        </div>
        <!-- Edit Form -->
        <div v-else class="space-y-4">
            <Button @click="addForm">Add +</Button>
            <div
                v-for="(value, index) in form.company_benefits"
                :key="index"
                class="flex items-center justify-between gap-x-4"
            >
                <CompanyForm :form="value" :index="index" :value="'benefits'" />
                <i
                    class="pi pi-trash text-red-500 hover:cursor-pointer"
                    @click="form.company_benefits.splice(index, 1)"
                />
            </div>
            <Button @click="save" class="w-full">Save</Button>
        </div>
    </div>
</template>
