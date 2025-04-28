<script setup>
import { Link } from "@inertiajs/vue3";
import { Avatar, Button } from "primevue";

const props = defineProps({
    companies: Object,
});

console.log(props.companies);
</script>

<template>
    <div class="bg-white p-4 rounded-lg space-y-2">
        <p class="font-[Poppins] text-xl font-semibold text-black">
            Similar Companies
        </p>
        <div
            v-for="company in companies"
            :key="company.id"
            class="flex justify-between items-center p-4 border-b border-gray-200"
        >
            <div class="flex items-center gap-x-4">
                <Avatar
                    size="large"
                    shape="circle"
                    icon="pi pi-user"
                    class="mx-auto"
                />
                <div>
                    <p>DesignHub Co.</p>
                    <p>Technology</p>
                </div>
            </div>
            <Button :as="Link">View</Button>
        </div>
    </div>
</template>
