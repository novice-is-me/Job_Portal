<script setup>
import { Avatar } from "primevue";
import CategoriesComponent from "../Dashboard/Partials/CategoriesComponent.vue";
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
                    <p class="text-lg font-semibold">techCorp.inc</p>
                    <p class="text-secondary text-sm">Batangas city</p>
                </div>
            </div>
            <div>
                <CategoriesComponent
                    :people="5000"
                    :category="'Engineering'"
                    :value="'companies'"
                    :location="'Manila'"
                />
            </div>
            <!-- sentence -->
            <div>
                <p>
                    Leading technology company specializing in cloud-based
                    solutions for businesses of all sizes.
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
