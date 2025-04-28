<script setup>
const props = defineProps({
    company: Object,
});
</script>

<template>
    <div class="space-y-4 divide-y-2 divide-gray-200 p-3">
        <div class="space-y-4">
            <p class="font-[Poppins] text-xl font-semibold text-black">
                About {{ company.name }}
            </p>
            <p>
                {{ company.description }}
            </p>
        </div>
        <div v-if="props.company.values.length > 0" class="space-y-4 pt-4">
            <p class="font-[Poppins] text-xl font-semibold text-black">
                Company Values
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-4">
                <div v-for="(value, index) in company.values" :key="index">
                    <div class="border border-gray-300 px-3 py-1 rounded-md">
                        <p class="font-bold text-black">{{ value.name }}</p>
                        <p>
                            {{ value.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="props.company.benefits.length > 0" class="space-y-4 pt-4">
            <p class="font-[Poppins] text-xl font-semibold text-black">
                Benefits And Perks
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-4">
                <div v-for="benefit in company.benefits" :key="benefit.id">
                    <div
                        class="border border-gray-300 px-3 py-1 rounded-md flex gap-x-3"
                    >
                        <i class="pi pi-trophy pt-2 text-blue-700"></i>
                        <div>
                            <p class="font-bold text-black">
                                {{ benefit.name }}
                            </p>
                            <p>
                                {{ benefit.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
