<script setup>
import { useForm } from "@inertiajs/vue3";
import { InputText, Select, Button, useToast } from "primevue";
import { watch, ref } from "vue";

const props = defineProps({
    companies: Object,
    user: Object,
    recruiterCompany: Object,
});

const user = props.user;
const toast = useToast();
const isAlreadyRecruiter = ref(props.recruiterCompany);

const form = useForm({
    full_name: user.name ?? "",
    phone: user.phone ?? "",
    email: user.email ?? "",
    selectedCompany: props.recruiterCompany ?? "",
});

const selectedIndustry = ref("");
const selectedSize = ref("");

// Watch for selected company changes
watch(
    () => form.selectedCompany,
    (newCompany) => {
        if (newCompany) {
            selectedIndustry.value = newCompany.industry?.name ?? "";
            selectedSize.value = newCompany.no_employees ?? "";
        } else {
            selectedIndustry.value = "";
            selectedSize.value = "";
        }
    }
);

// Setting the selected company of user recruiter if they have one
form.selectedCompany =
    props.companies.find(
        (company) => company.id === props.recruiterCompany.company_id
    ) ?? "";

if (form.selectedCompany) {
    selectedIndustry.value = form.selectedCompany.industry?.name ?? "";
    selectedSize.value = form.selectedCompany.no_employees ?? "";
}

const submit = () => {
    console.log("kkk");

    if (!form.selectedCompany) {
        toast.add({
            severity: "error",
            summary: "Error",
            detail: "Please select a company",
            life: 3000,
        });
        return;
    }
    form.post(route("recruiter.submit"), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Application submitted successfully",
                life: 3000,
            });
        },
        onError: (errors) => {
            console.log(errors);
        },
    });
};
</script>

<template>
    <div class="bg-white p-4 rounded-lg space-y-4">
        <div>
            <h1 class="font-[Poppins] font-bold text-2xl">
                Recruiter Application
            </h1>
            <p class="text-secondary">
                Fill out the form below to apply as a recruiter on our platform
            </p>
        </div>
        <div class="space-y-4">
            <div class="space-y-4">
                <p class="font-[Poppins] text-xl">Personal Information</p>
                <div class="space-y-2">
                    <label for="full_name" class="font-semibold"
                        >Full Name</label
                    >
                    <InputText
                        id="full_name"
                        v-model="form.full_name"
                        class="w-full"
                    />
                </div>
                <div class="space-y-2">
                    <label for="email" class="font-semibold"
                        >Email Address</label
                    >
                    <InputText id="email" v-model="form.email" class="w-full" />
                </div>
                <div class="space-y-2">
                    <label for="phone" class="font-semibold">Phone</label>
                    <InputText id="phone" v-model="form.phone" class="w-full" />
                </div>
            </div>
            <div class="space-y-4">
                <p class="font-[Poppins] text-xl">Company Information</p>
                <div class="space-y-2 flex flex-col">
                    <label for="company" class="font-semibold"
                        >Company Name</label
                    >
                    <Select
                        id="company"
                        :options="companies"
                        optionLabel="name"
                        v-model="form.selectedCompany"
                    />
                </div>

                <div
                    v-if="form.selectedCompany"
                    class="grid grid-cols-1 md:grid-cols-2 gap-4"
                >
                    <div class="space-y-2">
                        <label for="" class="font-semibold">Industry</label>
                        <InputText
                            id="industry"
                            v-model="selectedIndustry"
                            class="w-full"
                            disabled
                        />
                    </div>
                    <div class="space-y-2">
                        <label for="" class="font-semibold">Company Size</label>
                        <InputText
                            id="company_size"
                            v-model="selectedSize"
                            class="w-full"
                            disabled
                        />
                    </div>
                </div>
            </div>
            <Button
                class="w-full"
                @click="submit"
                :disabled="isAlreadyRecruiter"
                >Submit Application</Button
            >
        </div>
    </div>
</template>
