<script setup>
const props = defineProps({
    status: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div>
        <p
            :class="[
                'px-2 py-1 rounded-full text-xs font-semibold',
                status === 'active'
                    ? 'text-green-900 bg-green-200'
                    : 'text-yellow-900 bg-yellow-200',
            ]"
        >
            {{ status === "active" ? "Active" : "Urgent" }}
        </p>
    </div>
</template>
