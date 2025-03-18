<script setup>
const props = defineProps({
    skill: Object,
});
</script>

<template>
    <div
        class="bg-gray-100 py-1 px-3 text-center flex items-center rounded-full"
    >
        <p class="text-sm font-semibold">{{ skill.name }}</p>
    </div>
</template>
