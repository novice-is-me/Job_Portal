<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    data: Object,
    links: Object,
});

console.log(props.links);
console.log(props.data);
</script>

<template>
    <div v-if="data.to" class="flex justify-between items-center">
        <div class="text-secondary text-sm">
            <p>
                Showing {{ data.from }} to {{ data.to }} of
                {{ data.total }} results
            </p>
        </div>

        <div class="flex gap-2">
            <template v-for="(link, index) in links" :key="index">
                <Link
                    v-if="link.url"
                    :href="link.url"
                    v-html="link.label"
                    class="px-4 py-2 border rounded-md"
                    :class="{
                        'bg-primary text-white': link.active,
                        'bg-gray-200 text-black': !link.active,
                    }"
                />
            </template>
        </div>
    </div>
</template>
