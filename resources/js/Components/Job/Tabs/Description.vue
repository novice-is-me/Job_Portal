<script setup>
const props = defineProps({
    job: Object,
});
</script>

<template>
    <div class="flex gap-y-4 flex-col p-3">
        <div class="space-y-2">
            <h1 class="font-[Poppins] text-lg font-semibold text-black">
                About the role
            </h1>
            <p>
                {{ job.about_role }}
            </p>
        </div>
        <div class="space-y-2">
            <h1 class="font-[Poppins] text-lg font-semibold text-black">
                Responsibilities
            </h1>
            <ul class="list-disc list-inside">
                <li>{{ job.responsibilities }}</li>
            </ul>
        </div>
        <div class="space-y-2">
            <h1 class="font-[Poppins] text-lg font-semibold text-black">
                Benefits
            </h1>
            <ul class="list-disc list-inside">
                <li>
                    {{ job.company.benefits }}
                </li>
            </ul>
        </div>
    </div>
</template>
