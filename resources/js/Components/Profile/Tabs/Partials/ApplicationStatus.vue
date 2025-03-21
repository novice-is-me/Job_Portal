<script setup>
const props = defineProps({
    status: String,
});
</script>
<template>
    <div>
        <div
            v-if="status === 'Interview'"
            class="bg-blue-200 text-blue-700 px-3 rounded-full"
        >
            <p class="text-[11px] font-semibold">Interview</p>
        </div>
        <div v-if="status === 'Reviewed'">
            <p class="text-[11px] font-semibold">Reviewed</p>
        </div>
        <div v-if="status === 'Rejected'">
            <p class="text-[11px] font-semibold">Rejected</p>
        </div>
        <div v-if="status === 'Pending'">
            <p class="text-[11px] font-semibold">Pending</p>
        </div>
    </div>
</template>
