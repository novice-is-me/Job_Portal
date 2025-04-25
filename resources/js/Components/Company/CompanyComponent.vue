<script setup>
import { Avatar } from "primevue";
import CategoriesComponent from "../Dashboard/Partials/CategoriesComponent.vue";
import { ref } from "vue";

const props = defineProps({
    company: {
        type: Object,
        required: true,
    },
});

console.log("Child received company:", props.company); // here is undefined
</script>

<template>
    <div
        class="border border-gray-200 p-4 rounded-lg space-y-3 hover:border-blue-500 cursor-pointer bg-white h-full flex flex-col"
    >
        <div class="flex flex-col gap-4">
            <div class="flex gap-x-4">
                <Avatar
                    size="large"
                    shape="circle"
                    icon="pi pi-user"
                    class=""
                />
                <div>
                    <p class="text-lg font-semibold">
                        {{ company.name }}
                    </p>
                    <p class="text-secondary text-sm">
                        {{ company.address }}
                    </p>
                </div>
            </div>
            <div>
                <CategoriesComponent
                    :people="company.no_employees"
                    :category="company.category"
                    :value="'companies'"
                    :location="company.address"
                />
            </div>
            <!-- sentence -->
            <div>
                <p>
                    {{ company.description }}
                </p>
            </div>
            <!-- footer -->
            <div class="flex justify-between items-center">
                <div class="px-3 rounded-full bg-blue-100">
                    <p class="text-blue-700 text-sm font-semibold">
                        8 open positions
                    </p>
                </div>
                <div class="border border-gray-300 px-3 py-1 rounded-md">
                    <p class="font-semibold">View</p>
                </div>
            </div>
        </div>
    </div>
</template>
