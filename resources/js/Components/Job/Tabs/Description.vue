<script setup>
const props = defineProps({
    job: Object,
});

console.log(props.job);
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
        <div v-if="job.responsibilities.length > 0" class="space-y-2">
            <h1 class="font-[Poppins] text-lg font-semibold text-black">
                Responsibilities
            </h1>
            <ul
                v-for="responsibility in job.responsibilities"
                :key="responsibility.id"
                class="list-disc list-inside"
            >
                <li>{{ responsibility.description }}</li>
            </ul>
        </div>
        <div v-if="job.requirements.length > 0" class="space-y-2">
            <h1 class="font-[Poppins] text-lg font-semibold text-black">
                Requirements
            </h1>
            <ul
                v-for="requirement in job.requirements"
                :key="requirement.id"
                class="list-disc list-inside"
            >
                <li>
                    {{ requirement.description }}
                </li>
            </ul>
        </div>
        <div v-if="job.company.benefits.length > 0" class="space-y-2">
            <h1 class="font-[Poppins] text-lg font-semibold text-black">
                Benefits
            </h1>
            <ul
                v-for="benefit in job.company.benefits"
                class="list-disc list-inside"
            >
                <li>
                    {{ benefit.description }}
                </li>
            </ul>
        </div>
    </div>
</template>
