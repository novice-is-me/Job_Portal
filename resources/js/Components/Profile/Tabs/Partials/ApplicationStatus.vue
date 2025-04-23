<script setup>
const props = defineProps({
    status: String,
});
</script>
<template>
    <div>
        <div
            v-if="status === 'Interview'"
            class="bg-blue-200 text-blue-600 px-3 rounded-full"
        >
            <p class="text-[11px] font-semibold">Interview</p>
        </div>
        <div v-if="status === 'Reviewed'">
            <p class="text-[11px] text-green-600 font-semibold">Reviewed</p>
        </div>
        <div v-if="status === 'Rejected'">
            <p class="text-[11px] text-red-600 font-semibold">Rejected</p>
        </div>
        <div v-if="status === 'Pending'">
            <p class="text-[11px] text-yellow-600 font-semibold">Pending</p>
        </div>
    </div>
</template>
